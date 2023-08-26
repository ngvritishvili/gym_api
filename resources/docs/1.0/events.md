# Event 

---

- [All Events](#all-events)
- [Show Event](#show-event)
- [Store Event](#store-event)
- [Update Event](#update-event)
- [Delete Event](#delete-event)


<a name="all-events"></a>
## All Events
### GET api/events
show all events with details

#### Fields
* `` - ,

#### Response
* ``

<a name="show-event"></a>
## Show Event
### GET api/event/{id}
Show events with id

#### Fields
* `id` - integer, mandatory

#### Response
* `name`
* `limit`
* `start_registration`
* `end_registration`
* `start_event`
* `end_event`

<a name="store-event"></a>
## Store (Create) Event
### POST api/events
On this endpoint admin can create event (only super admin)

#### Fields
* `name` - string, mandatory
* `limit` - integer, nullable
* `start_registration` - date, mandatory
* `end_registration` - date, mandatory
* `start_event` - date, mandatory
* `end_event` - date, mandatory

#### Response
* `name` 
* `limit`
* `start_registration`
* `end_registration`
* `start_event`
* `end_event`


<a name="update-event"></a>
## Update Event
### PATCH api/events
On this endpoint super admin can update event (only super admin)

#### Fields
* `name`
* `limit`
* `start_registration`
* `end_registration`
* `start_event`
* `end_event`

#### Response
##### `Updated event`

<a name="delete-event"></a>
## Delete Event
### DELETE api/events
On this endpoint super admin can delete event (Only Super Admin)

#### Fields
* `id` - id, mandatory event id

#### Response
* `status`
