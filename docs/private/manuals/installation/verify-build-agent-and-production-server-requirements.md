# Verify Build Agent And Production Server Requirements

## Goal

Describe what software, PHP extensions, and system tools are required for `rozliczPWS`, and provide a practical checklist for verifying that both the Jenkins build agent and the production server are ready.

## Requirements

- SSH access to the Jenkins build agent host or container
- SSH access to the production server
- Debian or Ubuntu-like package manager assumptions for the install examples below

If your distribution is different, keep the same package categories and adapt the package names.

## Steps

1. Verify the Jenkins build agent requirements.

The `docker-builder` agent must have:
- `git`
- `php`
- `composer`
- `node`
- `npm`
- `ssh`
- `rsync`

The build agent PHP runtime should be at least `8.0.2`, with one consistent CLI version installed.

Required PHP extensions on the build agent:
- `mbstring`
- `pdo_sqlite`
- `sqlite3`
- `xml`
- `curl`
- `bcmath`
- `zip`

Practical Laravel baseline extensions to have available:
- `ctype`
- `fileinfo`
- `json`
- `openssl`
- `pdo`
- `tokenizer`

2. Install missing build-agent packages if needed.

Example for Ubuntu or Debian with PHP 8.2:

```bash
sudo apt update
sudo apt install -y git unzip rsync openssh-client curl
sudo apt install -y php8.2-cli php8.2-mbstring php8.2-sqlite3 php8.2-xml php8.2-curl php8.2-bcmath php8.2-zip
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs composer
```

If your server uses PHP 8.1 instead of 8.2, replace the package suffix consistently.

3. Verify the production server requirements.

The production server must have:
- working web server configuration for `<deploy-path>/public`
- `php` CLI
- `composer`
- `ssh` server access
- `rsync` available for incoming deploys

Required PHP extensions on the production server:
- `mbstring`
- `pdo_mysql`
- `xml`
- `curl`
- `bcmath`
- `zip`

Practical Laravel baseline extensions to have available:
- `ctype`
- `fileinfo`
- `json`
- `openssl`
- `pdo`
- `tokenizer`

4. Install missing production-server packages if needed.

Example for Ubuntu or Debian with PHP 8.2:

```bash
sudo apt update
sudo apt install -y rsync unzip openssh-server
sudo apt install -y php8.2-fpm php8.2-cli php8.2-mbstring php8.2-mysql php8.2-xml php8.2-curl php8.2-bcmath php8.2-zip composer
```

5. Verify application-specific production prerequisites.

Confirm these items on the production server:
- application path exists: `<deploy-path>`
- environment file exists: `<deploy-path>/.env`
- database configured in `.env` points to the production database `<production-database>`
- deploy user exists and is ready for SSH-based deploys
- writable directories exist:
  - `<deploy-path>/storage`
  - `<deploy-path>/bootstrap/cache`

For the deploy-user and SSH-key setup, use:

- `docs/private/manuals/installation/create-deploy-user-and-jenkins-ssh-key.md`

6. Run the verification commands on the build agent.

```bash
php -v
composer --version
node -v
npm -v
ssh -V
rsync --version | head -n 1
php -m | grep -E 'mbstring|pdo_sqlite|sqlite3|xml|curl|bcmath|zip'
```

7. Run the verification commands on the production server.

```bash
php -v
composer --version
rsync --version | head -n 1
php -m | grep -E 'mbstring|pdo_mysql|xml|curl|bcmath|zip'
test -d <deploy-path> && echo "app dir ok"
test -f <deploy-path>/.env && echo ".env ok"
test -d <deploy-path>/storage && echo "storage ok"
test -d <deploy-path>/bootstrap/cache && echo "bootstrap cache ok"
```

Important:
- `php -v` only verifies the CLI version used by Composer and Artisan
- the web server runtime for `<production-domain>` must also use a compatible PHP version
- if CLI is PHP 8.2 but the site still runs through PHP-FPM 8.1, the deploy may succeed but the application will fail at runtime
- verify the PHP version assigned to the site in the hosting panel or by a temporary web-exposed PHP version check

8. Run repository-level checks after dependencies are ready.

On the build agent workspace or on a compatible test machine:

```bash
composer install --no-interaction --prefer-dist --no-progress
npm ci
php artisan test
npm run production
```

## Verification

- The build agent has all required tools and PHP extensions
- The production server has the required PHP runtime and Composer
- The production `.env` exists and points to `<production-database>`
- Repository-level install, test, and build commands complete successfully

## Common problems

- Missing `pdo_sqlite` or `sqlite3` on the builder breaks tests
- Missing `pdo_mysql` on production breaks database access after deploy
- Missing `composer` on production breaks the remote deploy step
- Wrong PHP CLI version causes Composer or Laravel runtime issues
- Missing write permissions on `storage` or `bootstrap/cache` breaks Laravel after deploy

## Rollback / cleanup

- Remove only packages you installed by mistake; do not remove PHP extensions blindly from a working server
- If verification fails after a package upgrade, restore the previous package set or PHP version before running the pipeline again
