## Brouillons | Draft (Under development)

### À propos
- Ce package est construit afin de faciliter, la mise en place d'un espace membre avec gestion de rôle & permissions avec laravel (en utilisant laravel sanctum).
- Version Api configurable via un dashboard
- Api (Login, Register, Update Profile & avatar, CRUD roles + permissions)

### Installation
- composer install
- php artisan mg-sanctum:install
- php artisan queue:table
- in env 

````javascript
QUEUE_CONNECTION=database
````
- php artisan migrate

### Étape à ne pas oublier
- Ajouter first_name & last_name parmi les champs fillable
- use Manageable trait in auth model

### Email verification
- Mettre YourUserModel::observe(\Mgcodeur\LaravelSanctum\Observers\Api\Auth\UserObserver::class) in the boot method of EventServiceProvider (remplacer YourModelUser par votre Auth model)

- configure your mail informations

````javascript
MAIL_MAILER=your_mailer
MAIL_HOST=your_smtp_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=your_mail_encryption
MAIL_FROM_ADDRESS=your_mail_from_address
MAIL_FROM_NAME="${APP_NAME}"

````

### Si on veut utiliser l5-swagger
- Ajouter @OAInfo() au controlleur de base, si on veut utiliser l5 swagger et générer la documentation
- php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
- php artisan l5-swagger:generate
- décommenter cette ligne dans config/l5-swagger.php section securityDefinitions & dans securitySchemes


````javascript
'sanctum' => [ // Unique name of security
    'type' => 'apiKey', // Valid values are "basic", "apiKey" or "oauth2".
    'description' => 'Enter token in format (Bearer <token>)',
    'name' => 'Authorization', // The name of the header or query parameter to be used.
    'in' => 'header', // The location of the API key. Valid values are "query" or "header".
],
````