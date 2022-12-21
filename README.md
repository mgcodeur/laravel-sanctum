## Draft

## About
This package is made to facilitate the implementation of member management with laravel sanctum

## Installation step && Usage

 1. `composer require mgcodeur/laravel-sanctum`
 2. `php artisan mg-sanctum:install` 
 3. use `Manageable` and `Verifiable` trait in your User or Custom Auth Model
 4. add `email_verified_at`, `avatar` to fillable in your User or Custom Auth Model
 5. in your .env change set QUEUE_CONNECTION section to
```javascript
QUEUE_CONNECTION=database
```
## jobs and commands and events and email config
 1. `php artisan queue:table` 
 2. `php artisan migrate`
 3. add `LaravelSanctum::getAuthModel()::observe(\Mgcodeur\LaravelSanctum\Observers\Api\Auth\UserObserver::class);` in the boot method of EventServiceProvider
 4. in your .env configure this section
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
## Swagger
 1. If you want to use swagger you must add this in Http/Controller.php
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
 1. `php artisan l5-swagger:generate`
 2. `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
 3. Uncomment this line in `config/l5-swagger.php`

````php
'sanctum'  => [ // Unique name of security
    'type'  =>  'apiKey',  // Valid values are "basic", "apiKey" or "oauth2".
    'description'  =>  'Enter token in format (Bearer <token>)',
    'name'  =>  'Authorization',  // The name of the header or query parameter to be used.
    'in'  =>  'header',  // The location of the API key. Valid values are "query" or "header".
],
````

 1. `php artisan l5-swagger:generate`

## Socialite
 1. to use socialite you must add this in config/services.php

```php
'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT'),
],
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT')
],
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => env('GITHUB_REDIRECT')
],
```
### Upload

1. add this into config/filesystem
````php
'avatar' => [ // this filesystem is for user avatar module
    'driver' => 'local', // your driver
    'root' => storage_path('app/public/avatars'), 
    'url' => env('APP_URL').'/storage/avatars', //url jusqu'au dossier
    'visibility' => 'public', // visibility of folder
    'throw' => false,
],
````
