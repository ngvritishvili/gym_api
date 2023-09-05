# Event

---

- [Roll](#roll)
- [Roll User](#roll-user)


<a name="roll"></a>
## Get winning ticket
### GET api/events/roll/{event_id}/ticket
On this endpoint Super admin can get winning ticket random user
for specific event.

#### Fields
* ``
#### Response
* `winner`



<a name="roll-user"></a>
## Roll User for Event
### GET api/events/roll/{event_id}
On this endpoint auth user can register for event with requirements.
that means if user did enough steps for some period or burned enough calories
he gets ticket for today. there is limit now only one ticket for a day.

#### Fields
* `type` - Mandatory, String, (steps, calories)
* `hours_period` - Mandatory, Integer
* `steps` - Mandatory, Integer

#### Response
* `message`


