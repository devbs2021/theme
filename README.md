## About Theme

AdminLTE V3 theme is nicely modified for laravel application. It includes all the necessary assets of adminlte v3

## Following are the features

Some of specific features are listed below

- Easy to use
- Easy to Customize
- Can develop futher plugins

## Key Components

- Authentication with Authorization
- User Management
- Site Setting
- Plugin Enable/Disblae
- Header and Footer Menus
- Testimonials
- Subscription with bulk E-mail
- Basic CMS for any type of conent such as privay policy,about us, etc.

## Usage

### Authentication

It will provide HasPermission Traits, you must have to include in the User Model

```php
use Spatie\Permission\Traits\HasRoles; 

class User extends Model{
    use HasRole;

}

```

## Theme package has following in-built permissions

```php
        [
            'user_create',
            'user_edit',
            'user_delete',
            'user_menu',
            'user_view',
            'user_update',
            'role_create',
            'role_edit',
            'role_delete',
            'role_menu',
            'role_view',
            'role_update',
            'testimonial_create',
            'testimonial_edit',
            'testimonial_delete',
            'testimonial_menu',
            'testimonial_view',
            'testimonial_update',
            'page_create',
            'page_edit',
            'page_delete',
            'page_menu',
            'page_view',
            'page_update',
            'subscription_create',
            'subscription_edit',
            'subscription_delete',
            'subscription_menu',
            'subscription_view',
            'subscription_update',
            'menu_create',
            'menu_edit',
            'menu_delete',
            'menu_menu',
            'menu_view',
            'menu_update',
            'faq_create',
            'faq_edit',
            'faq_delete',
            'faq_menu',
            'faq_view',
            'faq_update',
            'message_create',
            'message_edit',
            'message_delete',
            'message_menu',
            'message_view',
            'message_update',
            'site_setting',
            'company_profile',
            'config',
            'css'
                            ]
```

### It provide Theme Facade class which can perform follwoing

#### Usage

```php
use Theme;

//Site related Content

Theme::siteSetup();

//CMS by slug
Theme::getCMSBySlug($slug);

//Header Menu, it will include child menus
Theme::getHeaderMenu();

//Footer Menu,it will include child menus
Theme::getFooterMenu();

//Testimonials
Theme::testimonials();

//Subscription Creation
//requst must have valid email
Theme::createSubscription($request)

```

## Publish Assets


It will publish all the assets and theme.php config file
where you can register new plugins

## Setup
In conosle run following commands sequentially
```cli
> composer install
> npm install
```
This command will install and update  all the dependencies.

```cli
> php artisan vendor:publish --provider="DevbShrestha\Theme\ThemeServiceProvider"
> php artisan vendor:publish --provider="Yajra\DataTables\ButtonsServiceProvider"
> php artisan migrate
> php artisan storage:link
```
## Seeder
Generate Admin Credentials

```cli
> php artisan db:seed --class="DevbShrestha\Theme\Seeders\AdminSeeder" 
```

## Run APP
The app will run on http://localhost:3000
```cli
> php artisan serve
> npm run watch
```

## Admin Credentials
```
Email:- super@super.com
Password:- P@ssword
```
