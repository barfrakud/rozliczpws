# Local Development Workflow

## Goal

Provide the day-to-day maintainer workflow for local setup, development, verification, and dependency updates.

## Requirements

- PHP 8 with required Laravel extensions
- Composer
- Node.js and npm
- Configured database connection in `.env`

## Steps

1. Install dependencies.

```bash
composer install
npm ci
```

2. Create `.env`, generate the app key, and configure database and mail settings.

```bash
cp .env.example .env
php artisan key:generate
```

3. Run migrations.

```bash
php artisan migrate
```

4. Start development services in separate terminals.

```bash
php artisan serve
npm run dev
```

5. Before opening a PR or merging a change, verify:

```bash
php artisan test
npm run production
```

6. For dependency updates, work on a branch, commit lockfiles together with code changes, and never update dependencies directly on production.

## Verification

- `php artisan test`
- `npm run production`
- Manual smoke check of `/`, `/krajowa`, `/zagraniczna`, and `/kontakt`

## Common problems

- Missing or invalid `.env` values can break migrations, mail, or tests.
- If assets look stale, rerun `npm run dev` or `npm run production`.
- If framework caches cause confusion, clear them with `php artisan optimize:clear`.

## Rollback / cleanup

- Clear cached framework state:

```bash
php artisan optimize:clear
```

- Discard unfinished dependency-update branches instead of applying risky hotfixes on `master`.
