---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Informations

Welcome to the generated API reference.
[Get Postman Collection](http://idrive.chapka.me/docs/collection.json)
[Get SoapUI Project File](http://idrive.chapka.me/docs/API-soapui-project.xml)

Here is the following account available for testing :
* **alistarle@gmail.com:password** (Monitor)
* **b.piquer@gmail.com:password** (Monitor)
* **alex.astier@gmail.com:password** (Student)
* **vladimir.karasouloff@gmail.com:password** (Student)
* **julien.gauttier@gmail.com:password** (Student)
* **john@gmail.com:password** (Student)
<!-- END_INFO -->

#Session routes

Routes who describes all the endpoints who are about Session
A session is a planified meeting between a monitor and a student, it can be in different state during its lifecycle :

CREATED = Just created, with only one User, monitor or student, and waiting for a subscription

PENDING = A second User ask the creator to accept his request, if he refuse, the meeting rollback to CREATED state

VALIDATED = The two user have validated the meeting, and waiting for it to begin

BEGINNED = The meeting have been triggered by the monitor, the start location is just saved

FINISHED = The meeting is finished, the monitor save the rating, the description, and the finish position is calculated
<!-- START_b47cfdb6ed179b3009bff8d7eb886a1b -->
## Create session

Create a new session in a CREATED state

> Example request:

```bash
curl -X POST "http://idrive.chapka.me/api/session" \
-H "Accept: application/json" \
    -d "sessionDate"="Tuesday, 28-Mar-17 20:28:03 UTC" \
    -d "begin"="20:28" \
    -d "end"="20:28" \
    -d "departure"="47.9167,1.9" \
    -d "arrival"="47.9167,1.9" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/session",
    "method": "POST",
    "data": {
        "sessionDate": "Tuesday, 28-Mar-17 20:28:03 UTC",
        "begin": "20:28",
        "end": "20:28",
        "departure": "47.9167,1.9",
        "arrival": "47.9167,1.9"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
      "id": 3,
      "distance": null,
      "departure": "46.76776213241735,1.6659871796874768",
      "arrival": "47.9167,1.9",
      "sessionDate": "2017-03-26",
      "begin": "11:00:00",
      "end": "12:00:00",
      "rate": null,
      "description": null,
      "status": "CREATED",
      "creator_id": 3,
      "student":       {
         "id": 3,
         "name": "Alexandre Astier",
         "email": "alex.astier@gmail.com",
         "phone": "0632591834",
         "address": "100 boulevard suchet",
         "city": "Paris",
         "cp": 75016,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 20,
         "price": 15,
         "type": "student"
      }
   }
```


### HTTP Request
`POST api/session`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sessionDate | date |  required  | Must be a date after: `Monday, 27-Mar-17 20:28:03 UTC`
    begin | date |  required  | Date format: `H:i`
    end | date |  required  | Date format: `H:i`
    departure | string |  required  | Must match this regular expression: `/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/`
    arrival | string |  required  | Must match this regular expression: `/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/`

<!-- END_b47cfdb6ed179b3009bff8d7eb886a1b -->

<!-- START_0ce63acb3f732f3f42e80a8bcbbab46b -->
## List of match

Return list of sessions who match the given session

If no parameters => Return list of potential matching

If match query parameter => Return amount of matching sessions

If unmatch query parameter => Return amount of matching sessions

> Example request:

```bash
curl -X GET "http://idrive.chapka.me/api/match/{session}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/match/{session}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
   "matching":    [
            {
         "id": 7,
         "distance": null,
         "departure": "47.9167,1.9",
         "arrival": "47.9167,1.9",
         "sessionDate": "2017-03-26",
         "begin": "11:00:00",
         "end": "12:00:00",
         "rate": null,
         "description": null,
         "status": "CREATED",
         "creator_id": 1,
         "monitor":          {
            "id": 1,
            "name": "Victor Coutellier",
            "email": "alistarle@gmail.com",
            "phone": "0632591834",
            "address": "1 rue de tours",
            "city": "Orleans",
            "cp": 45100,
            "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
            "rang_km": 10,
            "price": 12,
            "type": "monitor",
            "vehicule":             {
               "brand": "Opel",
               "model": "Zafira",
               "year": "2016"
            }
         }
      },
            {
         "id": 8,
         "distance": null,
         "departure": "47.9167,1.9",
         "arrival": "47.9167,1.9",
         "sessionDate": "2017-03-26",
         "begin": "11:00:00",
         "end": "12:00:00",
         "rate": null,
         "description": null,
         "status": "CREATED",
         "creator_id": 1,
         "monitor":          {
            "id": 1,
            "name": "Victor Coutellier",
            "email": "alistarle@gmail.com",
            "phone": "0632591834",
            "address": "1 rue de tours",
            "city": "Orleans",
            "cp": 45100,
            "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
            "rang_km": 10,
            "price": 12,
            "type": "monitor",
            "vehicule":             {
               "brand": "Opel",
               "model": "Zafira",
               "year": "2016"
            }
         }
      }
   ],
   "unmatching": [   {
      "id": 9,
      "distance": null,
      "departure": "47.9167,1.9",
      "arrival": "47.9167,1.9",
      "sessionDate": "2017-03-26",
      "begin": "11:00:00",
      "end": "12:00:00",
      "rate": null,
      "description": null,
      "status": "CREATED",
      "creator_id": 1,
      "monitor":       {
         "id": 1,
         "name": "Victor Coutellier",
         "email": "alistarle@gmail.com",
         "phone": "0632591834",
         "address": "1 rue de tours",
         "city": "Orleans",
         "cp": 45100,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 10,
         "price": 12,
         "type": "monitor",
         "vehicule":          {
            "brand": "Opel",
            "model": "Zafira",
            "year": "2016"
         }
      }
   }]
}
```

### HTTP Request
`GET api/match/{session}`

`HEAD api/match/{session}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    matching | numeric |  optional  | Number of matching result
    unmatching | numeric |  optional  | Number of unmatching result


<!-- END_0ce63acb3f732f3f42e80a8bcbbab46b -->

<!-- START_de1c03965a6fe5d1d7b6ce3a57b4a83f -->
## Update session

Update the given session ( state, description, participants, etc...)
This method check the current session state to avoid incoherence

> Example request:

```bash
curl -X PATCH "http://idrive.chapka.me/api/session/{session}" \
-H "Accept: application/json" \
    -d "departure"="47.9167,1.9" \
    -d "arrival"="47.9167,1.9" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/session/{session}",
    "method": "PATCH",
    "data": {
        "departure": "47.9167,1.9",
        "arrival": "47.9167,1.9"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
      "id": 3,
      "distance": null,
      "departure": "46.76776213241735,1.6659871796874768",
      "arrival": "47.9167,1.9",
      "sessionDate": "2017-03-26",
      "begin": "11:00:00",
      "end": "12:00:00",
      "rate": null,
      "description": null,
      "status": "PENDING",
      "creator_id": 3,
      "student":       {
         "id": 3,
         "name": "Alexandre Astier",
         "email": "alex.astier@gmail.com",
         "phone": "0632591834",
         "address": "100 boulevard suchet",
         "city": "Paris",
         "cp": 75016,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 20,
         "price": 15,
         "type": "student"
      },
      "monitor":       {
         "id": 1,
         "name": "Victor Coutellier",
         "email": "alistarle@gmail.com",
         "phone": "0632591834",
         "address": "1 rue de tours",
         "city": "Orleans",
         "cp": 45100,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 10,
         "price": 12,
         "type": "monitor",
         "vehicule":          {
            "brand": "Opel",
            "model": "Zafira",
            "year": "2016"
         }
      }
   }
```


### HTTP Request
`PATCH api/session/{session}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    session_id | numeric |  optional  | Id of the session to merge into the given one {session}
    departure | string |  optional  | Must match this regular expression: `/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/`
    arrival | string |  optional  | Must match this regular expression: `/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/`

<!-- END_de1c03965a6fe5d1d7b6ce3a57b4a83f -->

#User Routes

Routes who describes all user interaction, like registering, display profile, edit profile and rate profile
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Create User

Create a new User ( Monitor or Student )

> Example request:

```bash
curl -X POST "http://idrive.chapka.me/api/register" \
-H "Accept: application/json" \
    -d "name"="et" \
    -d "email"="milo77@example.org" \
    -d "password"="et" \
    -d "password_confirmation"="et" \
    -d "avatar"="et" \
    -d "phone"="1386754391" \
    -d "address"="et" \
    -d "cp"="66561" \
    -d "city"="et" \
    -d "range_km"="61820" \
    -d "price"="61820" \
    -d "role"="student" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/register",
    "method": "POST",
    "data": {
        "name": "et",
        "email": "milo77@example.org",
        "password": "et",
        "password_confirmation": "et",
        "avatar": "et",
        "phone": "1386754391",
        "address": "et",
        "cp": 66561,
        "city": "et",
        "range_km": 61820,
        "price": 61820,
        "role": "student"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example Student response:

```json
{
   "id": 5,
   "name": "Julien Gauttier",
   "email": "julien.gauttier@gmail.com",
   "phone": "0632591834",
   "address": "5 rue de tours",
   "city": "Orleans",
   "cp": 45100,
   "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
   "rang_km": 1000,
   "price": 100,
   "type": "student"
}
```

> Example Monitor response:

```json
{
	   "id": 2,
	   "name": "Jean-Baptiste Piquer",
	   "email": "jb.piquer@gmail.com",
	   "phone": "0632591834",
	   "address": "3 rue moliere",
	   "city": "Orleans",
	   "cp": 45000,
	   "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
	   "rang_km": 5,
	   "price": 30,
	   "type": "monitor",
	   "vehicule":    {
	      "brand": "Peugeot",
	      "model": "207",
	      "year": "2003"
	   }
}
```

### HTTP Request
`POST api/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | email |  required  | 
    password | string |  required  | Minimum: `6`
    password_confirmation | string |  required  | Must be the same as `password`
    avatar | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg)
    phone | numeric |  required  | Must have an exact length of `10`
    address | string |  required  | 
    cp | numeric |  required  | Must have an exact length of `5`
    city | string |  required  | 
    range_km | integer |  required  | 
    price | integer |  required  | 
    role | string |  required  | `monitor` or `student`

<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_2ea88ff35aa222f5582e50f39a2b35fd -->
## Get Profile

Return profile of the currently logged in user, otherwise the user given in parameters

> Example request:

```bash
curl -X GET "http://idrive.chapka.me/api/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
	   "id": 2,
	   "name": "Jean-Baptiste Piquer",
	   "email": "jb.piquer@gmail.com",
	   "phone": "0632591834",
	   "address": "3 rue moliere",
	   "city": "Orleans",
	   "cp": 45000,
	   "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
	   "rang_km": 5,
	   "price": 30,
	   "type": "monitor",
	   "vehicule":    {
	      "brand": "Peugeot",
	      "model": "207",
	      "year": "2003"
	   }
}
```

### HTTP Request
`GET api/user`

`HEAD api/user`

`GET api/user/{user}`

`HEAD api/user/{user}`


#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user | numeric | optionnal | Id of the user you want to retrieve the profile

<!-- END_2ea88ff35aa222f5582e50f39a2b35fd -->

<!-- START_0c01c2672c3869cc110476c48f24c29d -->
## Get User History

Return detailed list of session of the given user

> Example request:

```bash
curl -X GET "http://idrive.chapka.me/api/user/board" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/user/board",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
[
   {
      "id": 1,
      "distance": 24,
      "departure": "47.9167,1.9",
      "arrival": "47.9167,1.9",
      "sessionDate": "2017-03-25",
      "begin": "11:00:00",
      "end": "12:00:00",
      "rate": 4,
      "description": "Ceci est un description",
      "status": "FINISHED",
      "creator_id": 1,
      "monitor":       {
         "id": 1,
         "name": "Victor Coutellier",
         "email": "alistarle@gmail.com",
         "phone": "0632591834",
         "address": "1 rue de tours",
         "city": "Orleans",
         "cp": 45100,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 10,
         "price": 12,
         "type": "monitor",
         "vehicule":          {
            "brand": "Opel",
            "model": "Zafira",
            "year": "2016"
         }
      },
      "student":       {
         "id": 3,
         "name": "Alexandre Astier",
         "email": "alex.astier@gmail.com",
         "phone": "0632591834",
         "address": "100 boulevard suchet",
         "city": "Paris",
         "cp": 75016,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 20,
         "price": 15,
         "type": "student"
      }
   },
      {
      "id": 3,
      "distance": null,
      "departure": "46.76776213241735,1.6659871796874768",
      "arrival": "47.9167,1.9",
      "sessionDate": "2017-03-26",
      "begin": "11:00:00",
      "end": "12:00:00",
      "rate": null,
      "description": null,
      "status": "CREATED",
      "creator_id": 3,
      "student":       {
         "id": 3,
         "name": "Alexandre Astier",
         "email": "alex.astier@gmail.com",
         "phone": "0632591834",
         "address": "100 boulevard suchet",
         "city": "Paris",
         "cp": 75016,
         "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
         "rang_km": 20,
         "price": 15,
         "type": "student"
      }
   }
]
```

### HTTP Request
`GET api/user/board`

`HEAD api/user/board`

`GET api/user/{user}/board`

`HEAD api/user/{user}/board`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user | numeric | optionnal | Id of the user you want to retrieve the profile



<!-- END_0c01c2672c3869cc110476c48f24c29d -->

<!-- START_e75f2f63a5a2351c4f4d83bc65cefcf8 -->
## Update User Profile

Update the currently logged in user profile, ability to update custom field for monitor or student

> Example request:

```bash
curl -X PATCH "http://idrive.chapka.me/api/user" \
-H "Accept: application/json" \
    -d "name"="et" \
    -d "email"="zack04@example.com" \
    -d "password"="et" \
    -d "password_confirmation"="et" \
    -d "avatar"="et" \
    -d "phone"="1438272779" \
    -d "address"="et" \
    -d "cp"="68825" \
    -d "city"="et" \
    -d "range_km"="360181" \
    -d "price"="360181" \
    -d "role"="student" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/user",
    "method": "PATCH",
    "data": {
        "name": "et",
        "email": "zack04@example.com",
        "password": "et",
        "password_confirmation": "et",
        "avatar": "et",
        "phone": "1438272779",
        "address": "et",
        "cp": 68825,
        "city": "et",
        "range_km": 360181,
        "price": 360181,
        "role": "student"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
	   "id": 2,
	   "name": "Jean-Baptiste Piquer",
	   "email": "jb.piquer@gmail.com",
	   "phone": "0632591834",
	   "address": "3 rue moliere",
	   "city": "Orleans",
	   "cp": 45000,
	   "avatarUrl": "http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg",
	   "rang_km": 5,
	   "price": 30,
	   "type": "monitor",
	   "vehicule":    {
	      "brand": "Peugeot",
	      "model": "207",
	      "year": "2003"
	   }
}
```


### HTTP Request
`PATCH api/user`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | email |  required  | 
    password | string |  required  | Minimum: `6`
    password_confirmation | string |  required  | Must be the same as `password`
    avatar | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg)
    phone | numeric |  required  | Must have an exact length of `10`
    address | string |  required  | 
    cp | numeric |  required  | Must have an exact length of `5`
    city | string |  required  | 
    range_km | integer |  required  | 
    price | integer |  required  | 
    role | string |  required  | `monitor` or `student`

<!-- END_e75f2f63a5a2351c4f4d83bc65cefcf8 -->

<!-- START_49418778794fcf0119f4f23ba6ecb37b -->
## Rate Monitor

Rate the given user with the mark passed in parameters, note that the user must be a monitor

> Example request:

```bash
curl -X PATCH "http://idrive.chapka.me/api/user/{user}/rate" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://idrive.chapka.me/api/user/{user}/rate",
    "method": "PATCH",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PATCH api/user/{user}/rate`


<!-- END_49418778794fcf0119f4f23ba6ecb37b -->

