# Password Reset

---

- [Forgot Password](#forgot-password)
- [Email](#email-reset)

<a name="forgot-password"></a>
## Forgot Password
### POST api/forgot-password
On this endpoint user specifies login email to reset password from

#### Fields
* `login` - string, mandatory email

<a name="email-reset"></a>
## Reset password via email
### POST api/email/reset-password
Reset password via email

#### Fields
* `email` email, mandatory
* `token` string, mandatory
* `password` string, mandatory , max:64, min:8, mixed case + numbers
* `password_confirmation` string, mandatory (must be identical to password”)

