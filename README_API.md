## Send mail

* **Url:**
`'/api/sendmail'`

* **Method:**
POST
* **Data:**
```
{
    "message":"Some interesting message"
}
```
* **Success Response:**
  * **Code:** 201
  * **Content:** 
```
{
    "message": "Letter successfully sent!"
}
```
* **Error Response:**
  * **Code:** 400
  * **Content:** 
```
{
    "message": "Sorry! You can't send more than one mail!"
}
```
* **Error(Validation) Response:**
  * **Code:** 400
  * **Content:** 
```
{
    "message": [
        "The message must be at least 3 characters."
    ]
}
```