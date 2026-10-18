# Children's Hope Foundation website

Laravel website for Children's Hope Foundation (CHF), including program pages, childhood cancer information, News & Stories pages, and a staff publishing portal.

## News & Stories

The public pages are `/news`, `/events`, and `/vacancies`. News and letters appear together on `/news`. Published items have their own detail page and can have an individual hero image.

## Staff portal

Admins and managers sign in at `/admin/login`. Both roles can draft and publish news, letters, events and vacancies. Both can edit the hero image, title and introduction on the homepage, About, programs, childhood cancer, news, events, vacancies, every individual program and every childhood cancer topic. Admins can also create and suspend manager accounts.

## Local setup

The project targets Laravel 12 and PHP 8.2. Install framework dependencies and start the local server:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

Local development uses SQLite by default. Create an empty `database/database.sqlite` file before migrating if Laravel does not offer to create it. Keep local `.env` and database files out of Git. On a new PC, `composer install` uses the committed `composer.lock` so the dependency versions match.

## Updating the live website

After pulling the approved changes from GitHub, run these commands in the application directory:

```sh
composer install --no-dev --prefer-dist --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
```

Keep the server's existing `.env` and `APP_KEY`. The content migration refreshes saved legacy banner images and hospital wording while preserving custom uploads. The new service and education programme are provided by configuration.

On the current cPanel layout, the public document root is separate from this checkout. Use cPanel's deployment action (which reads `.cpanel.yml`) or copy the updated `public/css/site.css`, `public/js/`, and `public/images/chf-*` assets into the corresponding `public_html` directories. A Git pull alone does not copy those public assets.

## First production setup

Configure the production database in `.env`, deploy the files, then run:

```sh
php artisan migrate --force
php artisan storage:link
php artisan chf:staff-create --role=admin
```

The account command asks interactively for the first administrator's name, email and password. Run it with `--role=manager` to create a manager from the server terminal. Admins can also create and suspend managers in the portal.
