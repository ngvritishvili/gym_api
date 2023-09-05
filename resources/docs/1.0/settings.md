# Event

---

- [Set Up Steps](#step-setting)
- [Set Up Calories](#calories-setting)



<a name="step-setting"></a>
## Step Settings (Only Super Amdin can change)
### GET api/step/settings
On this endpoint admin can change settings for steps and time combination.

#### Fields
* `steps` - Mandatory, Integer
* `hours_period` - Mandatory, Integer

#### Response
* `message`


<a name="calories-setting"></a>
## Step Settings (Only Super Amdin can change)
### GET api/calorie/settings
On this endpoint admin can change settings for calories and time combination.

#### Fields
* `calories` - Mandatory, Integer
* `hours_period` - Mandatory, Integer

#### Response
* `message`
