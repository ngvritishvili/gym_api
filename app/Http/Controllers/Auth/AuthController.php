<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Auth\RegisterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerifyRequest;
use App\Http\Requests\Auth\PhoneVerificationRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\CustomerProfileResource;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
    }
    /**
     * Registration for customers & sellers.
     *
     * @param  RegisterRequest  $request
     * @return array
     */
    public function register(
        RegisterRequest $request
    ): array {

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user->assignRole('Customer');

        $user->sendEmailVerificationNotification();

        return [
            'user' => CustomerProfileResource::make($user)
        ];
    }

    /**
     * Login method for customers & sellers.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = RegisterHelper::requestKey($request)->except('login', 'remember');

        if (!Auth::attempt(
            $credentials,
            $request->has('remember')
        )) {
            return response()->json(['message' => 'Incorrect Credentials'], 422);
        }

        $user = Auth::user();



        if ($user->isCustomer() && Str::contains(url()->current(), ['admin.']))
        {
            return response()->json(['message' => 'Invalid Credentials'], 422);
        }

        $login = RegisterHelper::getKey($request->login);

        $request->request->add(
            [
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'username' => $credentials[$login],
                'password' => $credentials['password'],
                'scope' => '*',
            ]
        );

        $tokenRequest = $request->create(
            config('app.url').'/oauth/token',
            'post'
        );

        $instance = json_decode(Route::dispatch($tokenRequest)->getContent());

        return response()->json(
            [
                'user' => CustomerProfileResource::make($user),
                'access_token' => $instance->access_token,
                'refresh_token' => $instance->refresh_token,
            ]
        );
    }

    /**
     * here comes email click route and after verification link with user, email_verification_at fills.
     * @param  EmailVerifyRequest  $request
     * @return Redirector|Application|RedirectResponse
     */
    public function verifyEmail(EmailVerifyRequest $request): Redirector|Application|RedirectResponse
    {
        $request->fulfillEmail();

        return redirect(config('mail.verification'));
    }

    /**
     * Verify user phone number.
     * @param  PhoneVerificationRequest  $request
     * @return JsonResponse
     */
    public function verifyPhone(PhoneVerificationRequest $request): JsonResponse
    {
        $request->fulfillPhone();

        return response()->json(['status' => 'success']);
    }

    /**
     * Send Password reset link to user.
     * @param  Request  $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function passwordReset(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        $requestKey = RegisterHelper::requestKey($request);

        return $requestKey->exists('email') ?
            $this->sendEmailResetLink($requestKey) : $this->sendPhoneResetCode($requestKey);
    }

    /**
     * Send Password reset link to user.
     * @param  Request  $request
     * @return JsonResponse
     */
    private function sendEmailResetLink(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['email' => __($status)]);
        }

        return response()->json(['status' => __($status)]);
    }

    /**
     * Generate phone code and send to user to reset password.
     * @param  Request  $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function sendPhoneResetCode(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'Incorrect credentials'], 401);
        }

        $user->generatePhoneCode();

        return response(['phone' => $request->phone]);
    }

    /**
     * Update password with phone number.
     * @param  UpdatePasswordRequest  $request
     */
    public function updatePasswordFromPhone(UpdatePasswordRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user->otp && ($user->otp->code == $request->code)) {
            $user->update(
                [
                    'password' => bcrypt($request->password),
                ]
            );

            $user->otp->delete();

            return \response()->json(['status' => true, 'message' => 'success']);
        }

        return response()->json(['status' => false, 'message' => 'Failed, please try again']);
    }

    /**
     * Update password from mail link.
     */
    public function updatePasswordFromLink(ResetPasswordRequest $request): Response|Application|ResponseFactory
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(
                    [
                        'password' => Hash::make($password)
                    ]
                )->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return response(['status' => 'Problem occurred during operation'], 422);
        }

        return response(['status' => 'success']);
    }

    /**
     * Check if otp is correct
     */
    public function checkOtp(Request $request): JsonResponse
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user->otp && ($user->otp->code == $request->code)) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Otp code is correct',
                ]
            );
        }

        return response()->json(
            [
                'status' => false,
                'message' => 'Otp code is not correct',
            ],
            401
        );
    }

    /**
     * Revoke current user token that causes log out
     *
     * @return array
     */
    #[ArrayShape(['status' => "mixed"])]
    public function logout(): array
    {
        return [
            'status' => Auth::user()
                ->token()
                ->revoke()
        ];
    }

    /**
     * Callback from social network.
     * @param  Request  $request
     * @return JsonResponse
     */
    public function socialCallback(Request $request): JsonResponse
    {
        try {
            $user = Socialite::driver($request->social_type)->userFromToken($request->access_token);

            if (!$user->getEmail()) {
                return \response()->json(
                    ['message' => 'you have to specify email address in your facebook account to sign in GymApp!'],
                    401);
            }

            $user = User::firstOrCreate(
                [
                    'email' => $user->getEmail()
                ],
                [
                    'email' => $user->getEmail(),
                    'password' => bcrypt(Str::random(24)),
                    'username' => $user?->user['given_name'] ?? '',
                ]
            );

            $user->markEmailAsVerified();

            Auth::login($user, true);

            return \response()->json(
                [
                    'status' => CustomerProfileResource::make($user),
                    'token' => $user->createToken('Api auth')->accessToken
                ]
            );
        } catch (\Exception $exception) {
            return \response()->json(['message' => $exception->getMessage()],501);
        }
    }

    public function success()
    {
        return view('success');
    }
}
