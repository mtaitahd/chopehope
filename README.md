# Children's Hope Foundation website

This is the first Laravel homepage for Children's Hope Foundation (CHF). It uses the supplied CHF logo and the three supplied hero images. The navigation items link to sections on the homepage so the menu works while the remaining site pages are planned.

## Local setup

The project targets Laravel 12 and PHP 8.2. After network access to Packagist is available, install the framework dependencies and start the local server:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan serve
```

Then open the local address printed by Artisan. The page styles and scripts are served directly from `public/`; no separate frontend build is needed for this homepage.

## Image files

Place replacement photos in `public/images/` and update the corresponding references in `resources/views/home.blade.php`. The originals supplied for this first pass are kept at the project root.
