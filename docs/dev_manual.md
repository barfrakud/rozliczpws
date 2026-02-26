# Developer Manual

## 1. Purpose
This document describes local developer workflow: first run, daily run, testing, and dependency updates.

## 2. First local setup
1. Install dependencies.

```bash
composer install
npm ci
```

2. Create local environment file and app key.

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure database in `.env` and run migrations.

```bash
php artisan migrate
```

## 3. Daily development run
Run backend and frontend in separate terminals.

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

## 4. Testing and production build checks
Before opening PR:

```bash
php artisan test
npm run production
```

## 5. Updating Laravel and PHP dependencies (dev only)
1. Create branch from `main`.
2. Check outdated packages.

```bash
composer outdated
```

3. Update dependencies.

```bash
composer update
```

Framework-only update:

```bash
composer update laravel/framework --with-all-dependencies
```

Major Laravel upgrade (example target):

```bash
composer require laravel/framework:^<target_major>.0 --with-all-dependencies
```

After major version change, follow official Laravel upgrade guide for that version.

## 6. Updating JS dependencies with npm (dev only)
1. Check outdated packages.

```bash
npm outdated
```

2. Update non-breaking versions.

```bash
npm update
```

3. Optional major updates.

```bash
npx npm-check-updates -u
npm install
```

## 7. Verification after updates
Run:

```bash
php artisan optimize:clear
php artisan test
npm run production
```

Then verify key pages manually:
- `/`
- `/krajowa`
- `/zagraniczna`
- `/kontakt`

## 8. Commit rules
- Keep updates in small PRs.
- Commit lockfiles with code changes:
  - `composer.lock`
  - `package-lock.json`
- Do not run `composer update` or `npm update` directly on production.
