# Event

---

- [Settings](#setting)
- [Set Up Steps](#step-setting)
- [Set Up Calories](#calories-setting)



<a name="setting"></a>
## Settings all
### GET api/settings
On this endpoint anyone can see params.

#### Fields
* ``

#### Response
* `settings`


<a name="step-setting"></a>
## Step Settings (Only Super Amdin can change)
### POST api/step/settings
On this endpoint admin can change settings for steps and time combination.

#### Fields
* `steps` - Mandatory, Integer
* `hours_period` - Mandatory, Integer

#### Response
* `message`


<a name="calories-setting"></a>
## Calories Settings (Only Super Amdin can change)
### POST api/calorie/settings
On this endpoint admin can change settings for calories and time combination.

#### Fields
* `calories` - Mandatory, Integer
* `hours_period` - Mandatory, Integer

#### Response
* `message`
