# Jenkins Release Process

## Goal

Describe the production release flow executed by `Jenkinsfile`, including deploy prerequisites for the in-place SSH deployment model.

## Requirements

- Jenkins installed and configured
- Jenkins credentials: `deploy-ssh-key`, `deploy-host`, `deploy-user`
- Target server prepared at `<deploy-path>`
- Production `.env` file already present on the server

## Steps

1. Prepare the target server directories.

```bash
sudo mkdir -p <deploy-path>/storage
sudo mkdir -p <deploy-path>/bootstrap/cache
```

2. Ensure the production environment file exists at `<deploy-path>/.env`.

3. Ensure production settings include at least:
- `APP_ENV=production`
- `APP_DEBUG=false`
- working database, cache, and mail configuration
- database name set to `<production-database>`

4. Run the pipeline from Jenkins.
   The main stages are:
- checkout
- validate agent tooling
- `composer install --no-interaction --prefer-dist`
- `npm ci`
- `php artisan test`
- `npm run production`
- deploy in the Jenkins job configured for `*/master`

If you use the footer version label in the UI, update it in:

```text
resources/js/app.js
```

before the production build, because the displayed version string is currently maintained manually in the frontend source.

5. During deploy, Jenkins:
- syncs repository files directly into `<deploy-path>`,
- keeps `.env`, `storage`, and runtime directories on the server,
- excludes host-managed files such as `public/.user.ini`,
- runs `composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction`,
- clears old Laravel caches,
- runs migrations and Laravel cache commands,
- leaves the application in the same in-place directory structure served by the web server.

## Post-deploy checklist

Run this short check after each production deploy:

1. Open the production homepage and confirm it loads without a PHP fatal error.
2. Confirm the site still uses PHP `8.2` in `<hosting-panel>` for `<production-domain>`.
3. Verify the main calculator flow loads and basic calculations still work.
4. Confirm database-backed actions still work after migrations.
5. If something is broken, inspect the Jenkins build log first, then check Laravel logs on the server.

## Verification

- `php artisan test` passes in CI before deploy
- `<deploy-path>/public` is served by the web server
- The application responds on the production URL after deploy

## Common problems

- Missing `<deploy-path>/.env` aborts the deploy stage by design.
- Incorrect permissions on `storage` or `bootstrap/cache` can break Laravel after deploy.
- If the Jenkins job is pointed at a different branch than `*/master`, deploy behavior will no longer match the current repository workflow.

## Rollback / cleanup

- There is no automated rollback in this pipeline version.
- If a deploy breaks production, restore the previous application state manually from server backup or by redeploying a known-good commit.

```bash
cd <deploy-path>
php artisan optimize:clear
```
