## Brouillons

### À propos 
- Ce package est construit afin de faciliter, la mise en place d'un espace membre avec gestion de rôle & permissions avec laravel (en utilisant laravel sanctum).
- Version Api configurable via un dashboard
- Api (Login, Register, Update Profile & avatar, CRUD roles + permissions)

### Installation
- À remplir

### Étape à ne pas oublier
- Ajouter first_name & last_name parmi les champs fillable
- use Manageable trait in auth model


### Si on veut utiliser l5-swagger
- Ajouter @OAInfo() au controlleur de base, si on veut utiliser l5 swagger et générer la documentation
- php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
- php artisan l5-swagger:generate
- décommenter cette ligne dans config/l5-swagger.php section securityDefinitions & dans securitySchemes

``php
'sanctum' => [ // Unique name of security
    'type' => 'apiKey', // Valid values are "basic", "apiKey" or "oauth2".
    'description' => 'Enter token in format (Bearer <token>)',
    'name' => 'Authorization', // The name of the header or query parameter to be used.
    'in' => 'header', // The location of the API key. Valid values are "query" or "header".
],
``
