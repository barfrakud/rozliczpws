pipeline {
    agent {
        label 'docker-builder'
    }

    options {
        timestamps()
        buildDiscarder(logRotator(numToKeepStr: '20'))
        disableConcurrentBuilds()
        skipDefaultCheckout(true)
    }

    environment {
        COMPOSER_ALLOW_SUPERUSER = '1'
        DEPLOY_PATH = '/www/wwwroot/rozliczpws.pl'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Validate Agent Tooling') {
            steps {
                sh '''#!/usr/bin/env bash
set -euo pipefail
for tool in php composer npm ssh rsync; do
    if ! command -v "$tool" >/dev/null 2>&1; then
        echo "Missing required tool on build agent: $tool" >&2
        exit 1
    fi
done

echo "Using PHP binary: $(command -v php)"
php -v | head -n 1

if ! php -r '
$required = ["mbstring", "pdo_sqlite", "sqlite3"];
$missing = [];
foreach ($required as $extension) {
    if (!extension_loaded($extension)) {
        $missing[] = $extension;
    }
}
if ($missing) {
    fwrite(STDERR, "Missing required PHP extension(s) on build agent: " . implode(", ", $missing) . PHP_EOL);
    exit(1);
}
'; then
    echo "php --ini output:" >&2
    php --ini >&2 || true
    echo "php -m output:" >&2
    php -m >&2 || true
    exit 1
fi
'''
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --no-progress'
            }
        }

        stage('Install Node Dependencies') {
            steps {
                sh 'npm ci'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Build Production Assets') {
            steps {
                sh 'npm run production'
            }
        }

        stage('Deploy') {
            steps {
                sshagent(credentials: ['deploy-ssh-key']) {
                    withCredentials([
                        string(credentialsId: 'deploy-host', variable: 'DEPLOY_HOST'),
                        string(credentialsId: 'deploy-user', variable: 'DEPLOY_USER'),
                    ]) {
                        sh '''#!/usr/bin/env bash
set -euo pipefail
ssh_opts=(
  -o BatchMode=yes
  -o StrictHostKeyChecking=accept-new
)

ssh "${ssh_opts[@]}" "$DEPLOY_USER@$DEPLOY_HOST" "mkdir -p '$DEPLOY_PATH' '$DEPLOY_PATH/storage' '$DEPLOY_PATH/bootstrap/cache'"
ssh "${ssh_opts[@]}" "$DEPLOY_USER@$DEPLOY_HOST" "if [ ! -f '$DEPLOY_PATH/.env' ]; then echo 'Missing $DEPLOY_PATH/.env'; exit 1; fi"

rsync -az --delete --omit-dir-times --no-perms \
  -e "ssh ${ssh_opts[*]}" \
  --exclude=".git" \
  --exclude=".github" \
  --exclude=".env" \
  --exclude=".env.testing" \
  --exclude="public/.user.ini" \
  --exclude="node_modules" \
  --exclude="vendor" \
  --exclude="tests" \
  --exclude="storage/" \
  --exclude="bootstrap/cache/" \
  ./ "$DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH/"

ssh "${ssh_opts[@]}" "$DEPLOY_USER@$DEPLOY_HOST" "
    set -euo pipefail
    cd '$DEPLOY_PATH'
    composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
    php artisan optimize:clear
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
"
'''
                    }
                }
            }
        }
    }
}
