<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class SettingController extends Controller
{

    public function index()
    {
        try {
            $step = DB::table('step_controll')->get();
            $calories = DB::table('calorie_controll')->get();

            return response()->json([
                $calories->merge($step),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function setupSteps(Request $request)
    {
        $this->checkAdmin();
        try {
            DB::table('step_controll')->updateOrInsert(
                [
                    'id' => 1
                ],
                [
                    'step' => $request->steps,
                    'hours_period' => $request->hours_period,
                    'updated_at' => now(),
                ]);

            return response()->json([
                'message' => 'Successfully updated!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function setupCalories(Request $request)
    {
        $this->checkAdmin();
        try {
            DB::table('calorie_controll')->updateOrInsert(
                [
                    'id' => 1
                ], [
                'calories' => $request->calories,
                'hours_period' => $request->hours_period,
                'updated_at' => now(),
            ]);

            return response()->json([
                'message' => 'Successfully updated!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function checkAdmin()
    {
        Gate::allowIf(Auth::user()->isSuperAdmin());
    }
}
