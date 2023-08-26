# Forgot Password

- [Forgot Password](#forgot-password)
- [Reset password with email](#email-reset)
- [Reset password with phone](#phone-reset)
- [Check OTP](#check-otp)
- [Resend OTP](#resend-otp)

---

<a name="forgot-password"></a>

## Forgot Password

### POST api/forgot-password

This endpoint is used to submit login to reset password

#### Fields
* `login` - string, mandatory

#### Response

* `status`
  * `case email`
  * `status & reset password link sent to your email`
  * `case phone`
  * `status & generates code and sends to users phone`


<a name="email-reset"></a>

## Email password reset

### POST api/email/reset-password

This endpoint is used to reset password from link

#### Fields

* `email` - string, email, mandatory
* `password` - string, mandatory
* `password_confirmation` - string, mandatory
* `token` - string, mandatory

#### Response

* `status`

<a name="phone-reset"></a>

## Phone Password Reset

### POST api/phone/reset-password

This endpoint is used to reset password with phone

#### Fields

* `phone` - number, mandatory
* `code` - string, mandatory
* `password` - string, mandatory
* `password-confirmation` - string, mandatory

#### Response

* `status`
  

<a name="check-otp"></a>

## Check OTP

### POST api/phone/check-otp

This endpoint is used to check if OTP is valid

#### Fields

* `phone` - number, mandatory
* `code` - string, mandatory

#### Response

* `status`

<a name="resend-otp"></a>

## Resend OTP

### POST api/phone/resend-otp

This endpoint is used to resend OTP code

#### Fields

* `phone` - number, mandatory

#### Response

* `status`


