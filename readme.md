# rozliczPWS.pl

`rozliczPWS.pl` is a Laravel web app for calculating domestic and foreign business trip settlements.
It helps prepare trip summary data and reimbursement totals based on user input.

## Features
- Domestic trip calculator (travel summary + settlement breakdown)
- Foreign trip calculator (allowance and cost summary)
- Contact form with backend validation and safe mail flow (`replyTo` user email)
- Automated test suite (feature + unit tests)

## Tech Stack
- PHP 8 / Laravel 9
- Blade templates + jQuery
- Laravel Mix (Webpack) for assets
- SQLite/MySQL (environment dependent)
- Jenkins (Docker) for CI/CD

## Local Setup
1. Install dependencies.

```bash
composer install
npm ci
```

2. Configure environment.

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure database in `.env`, then run migrations.

```bash
php artisan migrate
```

4. Build frontend assets.

```bash
npm run dev
```

5. Start the application.

```bash
php artisan serve
```

## Testing
Run all tests:

```bash
php artisan test
```

## Frontend Production Build

```bash
npm run production
```

## Deployment (Jenkins)
- Pipeline definition: `Jenkinsfile`
- Release guide: `docs/release_manual.md`
- Update policy: `docs/update_manual.md`
- Step-by-step Jenkins startup/config: `docs/jenkins_setup_procedure.md`
- Developer guide: `docs/dev_manual.md`

Deployment is branch-gated (`main`) and uses a release symlink strategy with rollback support.

## Security Notes
- Keep secrets out of the repository.
- Store credentials in Jenkins Credentials and server `.env` files.
- Use production-safe settings:
- `APP_ENV=production`
- `APP_DEBUG=false`

## Screenshots
Screenshots used in help pages are available in `public/images/`.
