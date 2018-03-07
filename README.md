# Dixpose Version 0.1

## API Implementatio Guide
1. Parameters Required
2. Authentication
3. REST API endpoints

### Parameters
When you a get request to url/api/v1/collections
You will receive all the pending collections

| Request            | url                         | method  | Parameters                              |
| ------------------ |:---------------------------:| -------:|:----------------------------------------|
| all collections    | url/api/v1/collections      | get     | returns json data                       |
| Single Collection  | url/api/v1/collections/id   | get     | returns json data of a single collection|
| Update a Collection| url/api/v1/collections/id   | put     | collection, bins, status                |

Field | Values
--------- | ----------
collection | collection_id(integer) eg. 'collection' => 1
bins |  bin ids' eg.bins => [1,4,5,4]
status | 'status' => 'Collected'



### Authentication
1. OAuth Authentication
*Password Grant Authentication

You can create a new client from  http://domain.com/admin/dashboarb

Once you have created a password grant client, you may request an access token by issuing a  POST request to the httt://url/oauth/token route with the user's email address and password and theNewProvider. 

**NB: theNewProvider key has 4 predifined values. [users, customer_api, driver_api, supervisor_api].**


Mobile App | theNewProvider
--------- | ----------
Driver App | driver_api
Supervisor App | supervisor_api
Customer App | customer_api
Manager App | users

**This is to be used only when building a Mobile App that requires Access to the API to use as a Driver or Supervisor etc**

```javascript
//using GuzzleHttp Client in Php
$http = new GuzzleHttp\Client;

$response = $http->post('http://dixpose.com/oauth/token', [
    'form_params' => [
        'grant_type' => 'password',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'username' => 'danny@dixpose.com',
        'password' => 'my-password',
        'theNewProvider' => 'driver_api'
        'scope' => '',
    ],
]);

return json_decode((string) $response->getBody(), true);
```
If the request is successful, you will receive an **access_token** and  **refresh_token** in the JSON response from the server:
You can then use that to send request to fetch collections and update collections securelly. The access_token will be what Drivers app will
send to the server for authentication



Get all pending collections
```javascript
axios.get('/api/v1/collections'),
  headers: {
    Authorization: 'Bearer {access_token}'
  },
    .then(response => {
        console.log(response.data);
    });
```
update a single collection
```javascript
axios.put('/api/v1/collection/' + collection_Id),
  headers: {
    Authorization: 'Bearer {access_token}'
  },
    .then(response => {
        console.log(response.data);
    })
    .catch (response => {
        // List errors on response...
    });
```

2. Basic Auth
```javascript
  var session_url = 'http://url/api/v1/collections'
  var username = 'user';
  var password = 'password';
  var credentials = btoa(username + ':' + password);
  var BasicAuth = 'Basic ' + credentials;
  axios.post(sesion_url,{
    headers: {'Authorization': +BasicAuth}
  }).then(function(response){
    console.log('Authenticated');
  })
  .catch(function (error){
    console.log('Error on Authentication');
  });
```
**NB: The Api works only when an authenticated user access it**

3. REST Endpionts

* OAuth 2 Authentication: http://url/oauth/token
* Get all Customer Collections: http://url/api/v1/collections
* Get a single Customer Collection: http://url/api/v1/collections/{id}
* Update customer collection: http://url/api/v1/collections{id}


