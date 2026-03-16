# Setup

## Summary

Local development requires PHP, Composer, Node.js, npm, and a configured database connection.

## Architecture / Design

- PHP dependencies are managed with Composer.
- Frontend assets are compiled with Laravel Mix.
- Database and mail behavior are configured through `.env`.

## Setup or usage

- Install dependencies:

```bash
composer install
npm ci
```

- Create the local environment file and application key:

```bash
cp .env.example .env
php artisan key:generate
```

- Configure the database in `.env`, then run migrations:

```bash
php artisan migrate
```

- Review the application-specific environment keys in `.env.example`, especially:
  - `APP_DISPLAY_NAME`
  - `MAIL_DESTINATION`
  - `RECAPTCHA_SITE_KEY`
  - `RECAPTCHA_SECRET_KEY`
  - `RECAPTCHA_SKIP_IP`

- Start development services:

```bash
npm run dev
php artisan serve
```

- Verify the application:

```bash
php artisan test
npm run production
```

## Operational notes

- `.env.testing` is available for automated tests.
- Local SQLite and MySQL are both valid choices as long as `.env` matches the selected database engine.

## Key decisions

- Local setup stays intentionally simple and does not depend on Docker for day-to-day development.
