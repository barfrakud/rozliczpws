# Release Manual (Production)

## 1. Purpose
This document describes how to run production releases through Jenkins in Docker.
The repository does not contain secrets. All sensitive values must be configured on server/Jenkins side.

## 2. Prerequisites
- Linux server with Docker and Docker Compose (or plain Docker) installed.
- SSH access from Jenkins container host to deployment host.
- Target app path prepared: `/var/www/rozliczpws`.
- Domain and web server (Nginx/Apache) already pointing to `/var/www/rozliczpws/current/public`.

## 3. Start Jenkins in Docker

```bash
docker volume create jenkins_home

docker run -d \
  --name jenkins \
  --restart always \
  -p 8080:8080 \
  -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  jenkins/jenkins:lts
```

Get initial admin password:

```bash
docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword
```

Open Jenkins UI: `http://<server-ip>:8080`.

## 4. Jenkins UI setup procedure
1. Install suggested plugins.
2. Ensure these plugins are installed:
- Pipeline
- Git
- SSH Agent
- Credentials Binding
3. Create admin user.

## 5. Create Jenkins credentials (required)
Create the following credentials in **Manage Jenkins -> Credentials**:

- `deploy-ssh-key` (type: SSH Username with private key)
  - purpose: SSH connection for deploy/rollback commands.
- `deploy-host` (type: Secret text)
  - purpose: deployment server hostname/IP.
- `deploy-user` (type: Secret text)
  - purpose: deploy user on target server.

Do not store private keys, tokens, or `.env` values in repository.

## 6. Prepare target server directories
Run once on deployment server:

```bash
sudo mkdir -p /var/www/rozliczpws/releases
sudo mkdir -p /var/www/rozliczpws/shared/storage
sudo mkdir -p /var/www/rozliczpws/shared/bootstrap/cache
```

Create production `.env` file:

```bash
sudo nano /var/www/rozliczpws/shared/.env
```

Set at least:
- `APP_ENV=production`
- `APP_DEBUG=false`
- production DB credentials
- production mail credentials

## 7. Create Jenkins pipeline job
1. New Item -> Pipeline.
2. Configure Git repository URL.
3. Branch source: `main`.
4. Pipeline script from SCM: `Jenkinsfile`.
5. Save and run build.

## 8. Configure GitHub webhook
In GitHub repository settings:
- Add webhook URL: `http://<jenkins-host>:8080/github-webhook/`
- Content type: `application/json`
- Event: push events

## 9. Pipeline behavior
The `Jenkinsfile` executes:
1. Checkout
2. `composer install --no-interaction --prefer-dist`
3. `npm ci`
4. `npm run production`
5. `php artisan test`
6. Deploy stage on `main` branch (unless rollback mode enabled)

Deploy stage:
- syncs files to `/var/www/rozliczpws/releases/<build_number>`
- links shared `.env`
- links shared `storage`
- installs production dependencies:
  `composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction`
- runs migration + caches
- switches `current` symlink to new release
- stores previous release in `previous` symlink for rollback

## 10. Rollback procedure
Rollback is controlled by pipeline parameter:
- set `RUN_ROLLBACK=true`
- run pipeline on `main`

Rollback stage:
- switches `current` symlink to `previous`
- rebuilds Laravel caches

Manual rollback equivalent:

```bash
ln -sfn "$(readlink -f /var/www/rozliczpws/previous)" /var/www/rozliczpws/current
cd /var/www/rozliczpws/current
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 11. Production hardening checklist
- `APP_ENV=production`
- `APP_DEBUG=false`
- HTTPS enabled (redirect HTTP -> HTTPS)
- trusted proxies configured correctly (if behind reverse proxy)
- log rotation enabled
- regular DB backups enabled
- monitoring baseline enabled (HTTP health, disk, DB availability)
