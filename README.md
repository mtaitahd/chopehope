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
php artisan serve
```

## First production setup

Configure the production database in `.env`, deploy the files, then run:

```sh
php artisan migrate --force
php artisan storage:link
php artisan chf:staff-create --role=admin
```

The account command asks interactively for the first administrator's name, email and password. Run it with `--role=manager` to create a manager from the server terminal. Admins can also create and suspend managers in the portal.
