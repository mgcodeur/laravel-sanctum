## About
This package is made to facilitate the implementation of member management with laravel sanctum

## Installation step

 1. `composer require mgcodeur/laravel-sanctum`
 2. `php artisan mg-sanctum:install` 
 3. `php artisan queue:table`
 4. in your .env change set QUEUE_CONNECTION section to
```javascript
QUEUE_CONNECTION=database
```
 5. `php artisan migrate`
 6. add `first_name` and `last_name` to fillable property
 7. use `Manageable` trait in yout User or Custom Auth Model
 8. add `LaravelSanctum::getAuthModel()::observe(\Mgcodeur\LaravelSanctum\Observers\Api\Auth\UserObserver::class);` in the boot method of EventServiceProvider
 9. in your .env configure this section
```javascript
MAIL_MAILER=your_mailer
MAIL_HOST=your_smtp_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=your_mail_encryption
MAIL_FROM_ADDRESS=your_mail_from_address
MAIL_FROM_NAME="${APP_NAME}"
```
 12.  If you want use swagger you must add this in Http/Controller.php
 ```javascript
 /**
* @OA\Info(
* version="your api version ex: 1.0.0",
* title="Your app Api Documentation",
* description="A little description",
* @OA\Contact(
* email="youremail@xxx.xx"
* )
* )
*/
```
 14. `php artisan l5-swagger:generate`
 15. `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
 16. Uncomment this line in `config/l5-swagger.php`
````javascript
'sanctum'  => [ // Unique name of security
'type'  =>  'apiKey',  // Valid values are "basic", "apiKey" or "oauth2".
'description'  =>  'Enter token in format (Bearer <token>)',
'name'  =>  'Authorization',  // The name of the header or query parameter to be used.
'in'  =>  'header',  // The location of the API key. Valid values are "query" or "header".
],
````
 18. `php artisan l5-swagger:generate`
