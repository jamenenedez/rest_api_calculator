# Rest API Calculator
Rest API Calculator is a simple API for math operations. You can do addition, subtraction, multiplication, division, square root, free form and a random string generation. It uses credit for perform each operation and if the user’s balance isn’t enough to cover the request cost the request is denied.

## Requirements
<ol>
    <li>composer</li>
    <li>PHP 7/8</li>
    <li>MySQL 5.7/8</li>
</ol>

### Service Management
GET
### Request Services
    api/v1/services
### Request Service
    api/v1/service/{id}

POST
### Add Service
    api/v1/service

PUT
### Update Service 
    api/v1/service/{id}

DELETE
### Delete Service
    api/v1/service/{id}

## Examples

### Get Services  
  #### Request: 
    api/v1/services
  #### Response:
  ```JavaScript
    [
        {
            "id": "1",
            "uuid": "fad1efc1-b8da-3480-a308-f8697e3e204d",
            "type": "random_string",
            "cost": "3",
            "status": "active"
        },
        {
            "id": "2",
            "uuid": "b77b58c8-92b6-395d-9819-3e19241d5d09",
            "type": "division",
            "cost": "3",
            "status": "active"
        },
        {
            "id": "3",
            "uuid": "2cb96814-6f3f-36ec-b219-e6fedbcec756",
            "type": "subtraction",
            "cost": "2",
            "status": "active"
        },
        {
            "id": "4",
            "uuid": "839258fc-0f2b-35d1-8764-50fa044913f7",
            "type": "free_form",
            "cost": "5",
            "status": "active"
        },
        {
            "id": "5",
            "uuid": "5c2f54a8-b578-3b80-a845-3a4213187dee",
            "type": "square_root",
            "cost": "4",
            "status": "active"
        },
        {
            "id": "6",
            "uuid": "3b38ac99-bd31-34e8-a180-e8f4b351f4c1",
            "type": "multiplication",
            "cost": "2",
            "status": "active"
        },
        {
            "id": "7",
            "uuid": "83b619af-4a2b-3338-bc26-0d23d53c97b4",
            "type": "addition",
            "cost": "1",
            "status": "active"
        }
    ]
 ```

### Get Service  
  #### Request: 
    api/v1/service/{id}
  #### Response:
  ```JavaScript
    {
        "id": "1",
        "uuid": "fad1efc1-b8da-3480-a308-f8697e3e204d",
        "type": "random_string",
        "cost": "3",
        "status": "active"
    }
 ```

### Add Service
  
  #### Request: 
  ```JavaScript
    api/v1/service

    {
        "type": "random_string",
        "cost": "3",
        "status": "active"
    }  
  ```

  #### Success Response:
  ```JavaScript
    {
        "notice": {
            "text: : "Service Added"
        }         
    }  
  ```
  
  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Update Service  
  #### Request: 
  ```JavaScript
  api/v1/service
  {
      "id": "7",
      "type": "random_string",
      "cost": "3",
      "status": "active"
  }
  ```

  #### Success Response:
  ```JavaScript
    {
        "notice": {
            "text: : "Service Updated"
        }         
    }
  ```

  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Delete Service
  ```JavaScript
    api/v1/service

    {
        "id": "7"
    }
  ```
  Success Response:
  ```JavaScript          
    {
        "notice": {
            "text: : "Service Deleted"
        }         
    }
  ```
  Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }   
  ```
# User Management
GET
### Request Users
    api/v1/users
### Request User
    api/v1/user/{id}

POST
### Add User
    api/v1/user

PUT
### Update User
    api/v1/user/{id}

DELETE
### Delete User
    api/v1/user/{id}

## Examples

### Get Users
  #### Request: 
    api/v1/users
  #### Response:
  ```JavaScript
    [
        {
            "id": "8",
            "uuid": "166245d2-76bf-3993-9fcb-b912fef3f944",
            "username": "lakin.garrick",
            "password": "f9fb7e3982881cc0be2a5e8e07cd27dec45f109a00532d7bbf438cca02dbbcf9",
            "role": "admin",
            "balance": "50",
            "status": "active"
        },
        {
            "id": "9",
            "uuid": "e25b255b-065e-30bc-9be8-af8e64619b34",
            "username": "viva.hilpert",
            "password": "cc2438eb1985e01ccaa1bd6e3b690b39179a84f140674c78b810975501eedbbc",
            "role": "admin",
            "balance": "50",
            "status": "active"
        },
        {
            "id": "10",
            "uuid": "67cf2ba5-b323-384d-8b33-e0e56cc6129a",
            "username": "ashlee.russel",
            "password": "5af141749a26bc63ad18e52b50ed61cf8b9137da8b66d68862bb09ef3c75d1ab",
            "role": "user",
            "balance": "50",
            "status": "active"
        }
    ]
 ```

### Get User  
  #### Request: 
    api/v1/user/{id}
  #### Response:
  ```JavaScript
    {
        "id": "10",
        "uuid": "67cf2ba5-b323-384d-8b33-e0e56cc6129a",
        "username": "ashlee.russel",
        "password": "5af141749a26bc63ad18e52b50ed61cf8b9137da8b66d68862bb09ef3c75d1ab",
        "role": "user",
        "balance": "50",
        "status": "active"
    }
 ```

### Add User
  
  #### Request: 
  ```JavaScript
    api/v1/user

    {        
        "username": "ashlee.russel",
        "password": "5af141749a26bc63ad18e52b50ed61cf8b9137da8b66d68862bb09ef3c75d1ab",
        "role": "user",
        "balance": "50",
        "status": "active"
    } 
  ```

  #### Success Response:
  ```JavaScript
    {
        "notice": {
            "text: : "User Added"
        }         
    }  
  ```
  
  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Update User  
  #### Request: 
  ```JavaScript
  api/v1/user
  
  {        
    "username": "ashlee.russel",
    "password": "5af141749a26bc63ad18e52b50ed61cf8b9137da8b66d68862bb09ef3c75d1ab",
    "role": "user",
    "balance": "50",
    "status": "active"
  }
  ```

  #### Success Response:
  ```JavaScript
    {
        "notice": {
            "text: : "Service Updated"
        }         
    }
  ```

  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Delete User
  ```JavaScript
    api/v1/user

    {
        "id": "7"
    }
  ```
  Success Response:
  ```JavaScript          
    {
        "notice": {
            "text: : "Service Deleted"
        }         
    }
  ```
  Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }   
  ```

# Record Management
GET
### Request records
    api/v1/records
### Request one record
    api/v1/record/{id}

POST
### Add Record. This call is where the math operations takes place.
    api/v1/record

PUT
### Update Record
    api/v1/record/{id}

DELETE
### Delete Record
    api/v1/record/{id}

## Examples

### Get Records
  #### Request: 
    api/v1/records
  #### Response:
  ```JavaScript
    [
        {
            "id": "1",
            "uuid": "cde149d5-0d62-4918-86ab-56d0185aad81",
            "service_id": "4",
            "user_id": "4",
            "cost": "5",
            "user_balance": "25",
            "service_response": "1.8",
            "date": "2021-03-25 21:39:12"
        },
        {
            "id": "2",
            "uuid": "3f96d8dc-f547-49e7-b92f-8c16c6e1e439",
            "service_id": "4",
            "user_id": "4",
            "cost": "5",
            "user_balance": "20",
            "service_response": "1.8",
            "date": "2021-03-25 21:39:26"
        }
    ]
 ```

### Get Records  
  #### Request: 
    api/v1/record/{id}
  #### Response:
  ```JavaScript
    {
        "id": "1",
        "uuid": "cde149d5-0d62-4918-86ab-56d0185aad81",
        "service_id": "4",
        "user_id": "4",
        "cost": "5",
        "user_balance": "25",
        "service_response": "1.8",
        "date": "2021-03-25 21:39:12"
    }
 ```

### Add Record
  
  #### Request: 
  ```JavaScript
    api/v1/record

    {
        "service_id": "4",
        "user_id": "4",
        "str": "(4 + 5)/5"    
    } 
  ```

  #### Success Response:
  ```JavaScript
    {
        "result": {
            "value: : "1.8"
        }         
    }  
  ```
  
  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Update Record  
  #### Request: 
  ```JavaScript
  api/v1/record
  {        
    "id": "1",
    "uuid": "cde149d5-0d62-4918-86ab-56d0185aad81",
    "service_id": "4",
    "user_id": "4",
    "cost": "5",
    "user_balance": "25",
    "service_response": "1.8",
    "date": "2021-03-25 21:39:12"
  }
  ```

  #### Success Response:
  ```JavaScript
    {
        "notice": {
            "text: : "Record Updated"
        }         
    }
  ```

  #### Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }
  ```

### Delete Service
  ```JavaScript
  Request: api/v1/record
    {
        "id": "7"
    }
  ```
  Success Response:
  ```JavaScript          
    {
        "notice": {
            "text: : "Record Deleted"
        }         
    }
  ```
  Bad Response:
  ```JavaScript
    {
        "error": {
            "text: : "Some PDO response"
        }         
    }   
  ```