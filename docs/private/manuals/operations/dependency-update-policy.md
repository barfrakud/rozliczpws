# Dependency Update Policy

## Goal

Define a safe workflow for updating PHP and JavaScript dependencies without performing risky changes on production.

## Requirements

- Local development environment working
- Branch created from `master`
- Ability to run tests and production asset build locally

## Steps

1. Never update dependencies directly on production.

Do not run on production:
- `composer update`
- `npm update`
- `npm audit fix --force`

2. On a local branch, inspect outdated packages.

```bash
composer outdated
npm outdated
```

3. Apply the smallest reasonable update set.

```bash
composer update
npm update
```

4. For framework-only or major updates, pin the intended version explicitly and follow Laravel upgrade notes.

5. Verify locally:

```bash
php artisan optimize:clear
php artisan test
npm run production
```

6. Commit `composer.lock` and `package-lock.json` with the code changes, merge to `master`, and let Jenkins handle production deployment.

## Verification

- Tests pass
- Production asset build passes
- Smoke checks on `/`, `/krajowa`, `/zagraniczna`, and `/kontakt`

## Common problems

- Large dependency jumps can break legacy jQuery-based frontend code.
- Updating Laravel without reading the official upgrade guide increases risk of runtime failures.
- Forgetting lockfiles makes builds non-reproducible.

## Rollback / cleanup

- Revert the dependency-change commit or redeploy a known-good commit through Jenkins.
- If local caches are suspect, rerun:

```bash
php artisan optimize:clear
```
