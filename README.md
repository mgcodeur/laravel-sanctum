## Brouillons

### À propos 
- Ce package est construit afin de faciliter, la mise en place d'un espace membre avec gestion de rôle & permissions avec laravel (en utilisant laravel sanctum).
- Version Api configurable via un dashboard
- Api (Login, Register, Update Profile & avatar, CRUD roles + permissions)

### Installation
- À remplir

### Étape à ne pas oublier
- Ajouter @OAInfo() au controlleur de base, si on veut utiliser l5 swagger et générer la documentation
- php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
- php artisan l5-swagger:generate
- Ajouter first_name & last_name parmi les champs fillable
- use Manageable trait in auth model
