# Authorization

---

- [Registration](#registration)
- [Login](#login)
- [Logout](#logout)
- [Veify Email](#verify-email)
- [Get Token](#get_token)
- [Get Refresh Token](#refresh_token)

<a name="registration"></a>
## Registration
### POST api/register
This endpoint is used to register user in the system.
email verification link will be sent to user. 


#### Fields
* `username` string, mandatory, unique
* `email` string, mandatory, unique
* `password` string, mandatory , max:64, min:8, mixed case + numbers
* `password_confirmation` string, mandatory (must be identical to password”)


#### Response
* `user`

<a name="login"></a>
## Login
### POST api/login
This endpoint is used for user authorization

#### Fields
* `login` string, mandatory (should be email)
* `password` string, mandatory
#### Response
* `user`
* `id`
* `username`
* `email`
* `access_token` 
* `refresh_token` not in social login.

<a name="logout"></a>
## Logout
### POST api/logout
This endpoint is used for logging out from system

<a name="verify-email"></a>
### Email
### api/email/verify/{id}/{hash}
endpoint is used for email verification.
user is automatically redirected to FE url after verification

#### Response
* `status` success
* `access_token` token

<a name="get_token"></a>
### Get token
### oauth/token
endpoint give token and refresh token by credential's
#### Fields
* `grant_type` password
* `client_id` client_id
* `client_secret` client_secret
* `username` "exampleuser@gym.com"
* `password` "examplePassword"
* `scope` *

#### Response

<a name="refresh_token"></a>
### Refresh token
### oauth/token
endpoint give token and refresh token by credential's
#### Fields
* `grant_type` refresh_token
* `client_id` client_id
* `client_secret` client_secret
* `refresh_token` "def502003ff030468....."

#### Response

# Social login

<a name="social-login"></a>
## Login With Token
### POST api/auth/social/callback
This endpoint is used for user authorization with facebook, gmail, twitter or github

#### Fields
* `social_type` string, mandatory (like: google, facebook, twitter)
* `access_token` token, mandatory
#### Response
* `user`
* `id`
* `username`
* `email`
* `access_token`
* `refresh_token` not in social login.

### Get Google Token
* `Example URL` : ""https://accounts.google.com/o/oauth2/v2/auth?client_id=816091102818-gbopsrpbts4tqtq080ba4vp4j9qo6p7e.apps.googleusercontent.com&redirect_uri=http://localhost:8000/api/auth/social/callback&response_type=token&scope=https://www.googleapis.com/auth/userinfo.email"

#### For this URI here are params you need to generate token
* `client_id` = (example: 816091102818-gbopsrpbts4tqtq080ba4vp4j9qo6p7e.apps.googleusercontent.com)
* `redirect_uri` = (example: http://localhost:8000/api/auth/social/callback)
* `response_type` = token
* `scope` = https://www.googleapis.com/auth/userinfo.email   (this scope enough to register user)
#### end with this token on this endpoint : api/auth/social/callback  I will register user.
