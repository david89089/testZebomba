## Setting

``PHP 8.2``

`composer install`

`cp .env.example .env`

`php artisan key:generate`

`php artisan sail:install (Select MySQL)`

`sail up -d `

`sail artisan migrate`

`Add to env file: SECRET_KEY=977fea8deca4c2c2330544cf2e388284`

`sail artisan optimize`

## Route

`localhost/api/user-auth`

Example Request: 

`localhost/api/user-auth?access_token=07b38cd0e778340eb40b25e005476ce8&id=1&first_name=Иван&last_name=Иванов&city=Москва&country=Россия&sig=5427b31460cd807aab7e184364960958`

Return: 
``
{
    "error": "Ошибка авторизации в приложении",
    "error_key": "signature error"
}
``
