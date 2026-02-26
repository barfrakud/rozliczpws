pipeline {
    agent any

    options {
        timestamps()
    }

    parameters {
        booleanParam(
            name: 'RUN_ROLLBACK',
            defaultValue: false,
            description: 'Set to true to run rollback stage on main branch instead of deploy.'
        )
    }

    environment {
        DEPLOY_PATH = '/var/www/rozliczpws'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Install Node Dependencies') {
            steps {
                sh 'npm ci'
            }
        }

        stage('Build Production Assets') {
            steps {
                sh 'npm run production'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Optional Style Check') {
            when {
                expression {
                    fileExists('vendor/bin/pint')
                }
            }
            steps {
                sh 'vendor/bin/pint --test'
            }
        }

        stage('Deploy (main only)') {
            when {
                allOf {
                    branch 'main'
                    expression {
                        !params.RUN_ROLLBACK
                    }
                }
            }
            steps {
                sshagent(credentials: ['deploy-ssh-key']) {
                    withCredentials([
                        string(credentialsId: 'deploy-host', variable: 'DEPLOY_HOST'),
                        string(credentialsId: 'deploy-user', variable: 'DEPLOY_USER'),
                    ]) {
                        sh '''
                            set -e
                            RELEASE_DIR="$DEPLOY_PATH/releases/$BUILD_NUMBER"

                            ssh -o StrictHostKeyChecking=no "$DEPLOY_USER@$DEPLOY_HOST" "mkdir -p $DEPLOY_PATH/releases $DEPLOY_PATH/shared/storage $DEPLOY_PATH/shared/bootstrap/cache"
                            ssh -o StrictHostKeyChecking=no "$DEPLOY_USER@$DEPLOY_HOST" "if [ ! -f $DEPLOY_PATH/shared/.env ]; then echo 'Missing $DEPLOY_PATH/shared/.env'; exit 1; fi"

                            rsync -az --delete \
                              --exclude=".git" \
                              --exclude=".github" \
                              --exclude=".env" \
                              --exclude=".env.testing" \
                              --exclude="node_modules" \
                              --exclude="tests" \
                              ./ "$DEPLOY_USER@$DEPLOY_HOST:$RELEASE_DIR/"

                            ssh -o StrictHostKeyChecking=no "$DEPLOY_USER@$DEPLOY_HOST" "
                                set -e
                                if [ -L '$DEPLOY_PATH/current' ]; then
                                    ln -sfn \\$(readlink -f '$DEPLOY_PATH/current') '$DEPLOY_PATH/previous'
                                fi

                                ln -sfn '$DEPLOY_PATH/shared/.env' '$RELEASE_DIR/.env'
                                rm -rf '$RELEASE_DIR/storage'
                                ln -sfn '$DEPLOY_PATH/shared/storage' '$RELEASE_DIR/storage'

                                cd '$RELEASE_DIR'
                                composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
                                php artisan migrate --force
                                php artisan config:cache
                                php artisan route:cache
                                php artisan view:cache

                                ln -sfn '$RELEASE_DIR' '$DEPLOY_PATH/current'
                            "
                        '''
                    }
                }
            }
        }

        stage('Rollback (main only, manual flag)') {
            when {
                allOf {
                    branch 'main'
                    expression {
                        params.RUN_ROLLBACK
                    }
                }
            }
            steps {
                sshagent(credentials: ['deploy-ssh-key']) {
                    withCredentials([
                        string(credentialsId: 'deploy-host', variable: 'DEPLOY_HOST'),
                        string(credentialsId: 'deploy-user', variable: 'DEPLOY_USER'),
                    ]) {
                        sh '''
                            set -e
                            ssh -o StrictHostKeyChecking=no "$DEPLOY_USER@$DEPLOY_HOST" "
                                set -e
                                if [ ! -L '$DEPLOY_PATH/previous' ]; then
                                    echo 'No previous release found.'
                                    exit 1
                                fi

                                ln -sfn \\$(readlink -f '$DEPLOY_PATH/previous') '$DEPLOY_PATH/current'
                                cd '$DEPLOY_PATH/current'
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
