## Welcome to Library API

<b> description : </b> This api provide a data to use in your application, 
its all about the api that manage the book, genre and collection data.

<br> <br> in this documentation, you will found all the what you need to use it, so let's start

<br>
<h1>
    Structure of the Endpoint :
</h1>

<p> first of all, let's talk about the authentication,
to be authenticated you have to send data of the user to this end point:
<br>

```
/api/auth/login
```
</p>

if the email and password exist you will receive a json data like this exexmple :
 
````
{
    "status": "success",
    "user": {
        "id": 2,
        "name": "simple user",
        "email": "user@library.com",
        "email_verified_at": null,
        "created_at": "2023-03-23T23:11:12.000000Z",
        "updated_at": "2023-03-23T23:11:12.000000Z"
    },
    "authorisation": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2Nzk4Mzc2ODMsImV4cCI6MTY3OTg0ODQ4MywibmJmIjoxNjc5ODM3NjgzLCJqdGkiOiJFQmV6eE55VVZSUnlUdzRVIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.bEddgSWae_0tDAVKRqVC2q0m1JhKUwdeWDWLbn6kIgc",
        "type": "bearer"
    }
}

````
with the status and the data of the user, and then the JWT token 

After been authenticated you have to send the Token for each call request to the api. as a bearer token, 
the log out is easier, call this endpoint and pass the token as we said before and then you  will be loged out

```
auth/logout
```
after finishing the authentication part let move on the others parts.


# Book, Genre, Collection

to call those endpoint we have the same structure,

## Get Data
to get data you call this endpoint by the verb GET
call the endpoint by the name of the class for example:
```
/Book
```
### result 


```
{
    "status": "success",
    "message": "fetching books is successful",
    "data": [
        {
            "id": 1,
            "title": "The Catcher in the Rye",
            "author": "J.D. Salinger",
            "isbn": "978-0316769488",
            "number_pages": 224,
            "location": "Fiction section",
            "status": "medium",
            "content": "You're not the first person who was ever confused and frightened and even sickened by human behavior.",
            "collection_id": 1,
            "genre_id": 1,
            "user_id": 1,
            "created_at": "2023-03-23T23:54:28.000000Z",
            "updated_at": "2023-03-23T23:54:28.000000Z"
        },
        ...
    ]
}
```


and to get one row, you call this one by the GEt verb too


```
/Book/1
```
### result


```
{
    "status": "success",
    "message": "getting book by id is successfully",
    "book": {
        "id": 1,
        "title": "The Catcher in the Rye",
        "author": "J.D. Salinger",
        "isbn": "978-0316769488",
        "number_pages": 224,
        "location": "Fiction section",
        "status": "medium",
        "content": "You're not the first person who was ever confused and frightened and even sickened by human behavior.",
        "collection_id": 1,
        "genre_id": 1,
        "user_id": 1,
        "created_at": "2023-03-23T23:54:28.000000Z",
        "updated_at": "2023-03-23T23:54:28.000000Z",
        "genre": {
            "id": 1,
            "name": "descriptif 2",
            "created_at": "2023-03-23T23:54:04.000000Z",
            "updated_at": "2023-03-23T23:54:04.000000Z"
        },
        "collection": {
            "id": 1,
            "name": "collection 2",
            "created_at": "2023-03-23T23:53:52.000000Z",
            "updated_at": "2023-03-23T23:53:52.000000Z"
        }
    }
}
```

## Update Row
to update a row you can use this endpoint By the verb PUT or PATCH
and sending the data in the body, the filed aren't requires in this part

````
/Book
````
by sending body like this 
````
{
    "title": "The Catcher in the Rye",
    "author": "J.D. Salinger",
    "isbn": "978-0316769488",
    "number_pages": 224,
    "location": "Fiction section",
    "status": "medium",
    "content": "You're not the first person who was ever confused and frightened and even sickened by human behavior.",
    "collection_id": 1,
    "genre_id": 1
    
}
````

## Result: 

```` 
{
    "status": "success",
    "message": "updating book is successful",
    "book": {
        "id": 1,
        "title": "The Catcher in the Rye",
        "author": "J.D. Salinger",
        "isbn": "978-0316769488",
        "number_pages": 224,
        "location": "Fiction section",
        "status": "medium",
        "content": "You're not the first person who was ever confused and frightened and even sickened by human behavior.",
        "collection_id": 1,
        "genre_id": 1,
        "user_id": 1,
        "created_at": "2023-03-23T23:54:28.000000Z",
        "updated_at": "2023-03-23T23:54:28.000000Z",
        "genre": {
            "id": 1,
            "name": "descriptif 2",
            "created_at": "2023-03-23T23:54:04.000000Z",
            "updated_at": "2023-03-23T23:54:04.000000Z"
        },
        "collection": {
            "id": 1,
            "name": "collection 2",
            "created_at": "2023-03-23T23:53:52.000000Z",
            "updated_at": "2023-03-23T23:53:52.000000Z"
        }
    }
}
````

## DELETE
send this endpoint and by providing the id of th row wan to be deleted 

````  
/book/1
````

## Result
### Success
```` 
 {
    "status": "success",
    "message": "Deleting book is successful"
}
````
### Error
If error is occurred this response sent
```` 
 {
    "status": "error",
    "message": "error is occurred when deleting book, try again"
} 
````

<h2>  Roles </h2>  
this part is all about the roles that the api provided, <b>User, Receitioneste, and Admin</b>

<h3> User :</h3>
The user has one permission in this api is te view all the Book exist, 

<h3> Reciptionest :</h3>
The reciptionest has many permission in this app, fiest one is to manage the book entity
mean that he can read add update and delete books , also he can view the genres and the collections

<h3> Admin </h3>
tha admin has permission to red the book and CRUD the genres and the collections, also he can assign and revoke the 
role to the users, and the permissions to the roles


