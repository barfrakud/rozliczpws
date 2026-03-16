# rozliczPWS

`rozliczPWS` is a Laravel 9 application for preparing domestic and foreign business trip settlements.
This repository is a public portfolio version focused on application structure, validation, tests, and CI/CD workflow.

## Features

- Domestic trip summary and settlement flow backed by Laravel validation and service logic
- Foreign trip calculator handled in the browser with country-based rates
- Contact form that stores messages and sends mail using a safe `replyTo` setup
- PHPUnit feature and unit tests for the safer backend paths
- Jenkins pipeline for build, test, and SSH-based deployment

## Stack

- PHP 8.2
- Laravel 9
- Blade, Bootstrap, jQuery
- Laravel Mix
- SQLite or MySQL
- Jenkins running in Docker

## Quick Start

Install dependencies:

```bash
composer install
npm ci
```

Create the local environment file and application key:

```bash
cp .env.example .env
php artisan key:generate
```

Configure the database in `.env`, then run:

```bash
php artisan migrate
php artisan test
npm run production
```

Start the local app:

```bash
php artisan serve
```

## Environment Notes

The repository keeps real secrets out of version control.
Use `.env.example` as the starting point for local setup and keep production values outside the repository.

Notable application-specific variables:

- `APP_DISPLAY_NAME`
- `APP_FACEBOOK_URL`
- `GOOGLE_ANALYTICS_ID`
- `MAIL_DESTINATION`
- `RECAPTCHA_SITE_KEY`
- `RECAPTCHA_SECRET_KEY`
- `RECAPTCHA_SKIP_IP`

## CI/CD Summary

The pipeline is defined in `Jenkinsfile`.
It installs PHP and Node dependencies, runs tests, builds production assets, and deploys over SSH.
Deployment is intentionally simple and in-place, with server-managed files such as `.env`, `storage`, and `bootstrap/cache` kept outside the repository workflow.

## Documentation

Public project docs are available in `docs/public/`:

- `docs/public/overview.md`
- `docs/public/architecture.md`
- `docs/public/setup.md`
- `docs/public/ci-cd.md`
- `docs/public/deployment.md`
- `docs/public/usage.md`

## Security

- Do not commit `.env`, database dumps, logs, or generated framework cache files.
- Keep deployment credentials in Jenkins or the target server, not in repository files.
- Use `APP_ENV=production` and `APP_DEBUG=false` in production.
