# Update Manual

## 1. Update policy
All production updates must go through Jenkins pipeline. Do not update dependencies directly on production server.

Never run directly on production:
- `composer update`
- `npm update`
- `npm audit fix --force`

## 2. Safe update workflow
1. Create branch from `main`.
2. Update dependencies locally (if required).

```bash
composer update
npm update
```

3. Run local verification.

```bash
php artisan test
npm run production
```

4. Commit code and lockfiles (`composer.lock`, `package-lock.json`).
5. Open PR and merge into `main`.
6. Jenkins webhook triggers pipeline.
7. Validate deployment on production URL.

## 3. Jenkins CI commands baseline
CI stage commands (from pipeline):

```bash
composer install --no-interaction --prefer-dist
npm ci
npm run production
php artisan test
```

Deploy stage commands (server-side):

```bash
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 4. Jenkins Docker operational notes
- Jenkins container must use persistent volume: `jenkins_home`.
- Restart policy should remain `always`.
- Webhook endpoint should be reachable from GitHub.

## 5. Credentials and secrets policy
Secrets must exist only in Jenkins Credentials and server `.env`.

Required credential IDs:
- `deploy-ssh-key`
- `deploy-host`
- `deploy-user`

## 6. Rollback policy
If deployment is unhealthy:
1. Run Jenkins pipeline with `RUN_ROLLBACK=true`.
2. Verify application health.
3. Investigate failing release before next deploy.

Rollback switches symlink from `current` to `previous` and refreshes Laravel caches.
