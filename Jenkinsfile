pipeline {
    agent {
        docker {
            image 'php:8.2-fpm'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    environment {
        APP_ENV = 'testing'
        DB_CONNECTION = 'mysql'
        DB_HOST = 'mysql'
        DB_DATABASE = 'laravel'
        DB_USERNAME = 'root'
        DB_PASSWORD = 'password'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Setup') {
            steps {
                sh 'apt-get update && apt-get install -y git unzip'
                sh 'docker-php-ext-install pdo pdo_mysql'
                sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
                sh 'php composer-setup.php'
                sh 'php -r "unlink(\'composer-setup.php\');"'
                sh 'mv composer.phar /usr/local/bin/composer'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Tests') {
            steps {
                sh 'php artisan config:clear'
                sh 'php artisan test'
            }
        }

        stage('Build') {
            steps {
                sh 'php artisan optimize'
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("laravel-app:${env.BUILD_ID}")
                }
            }
        }
    }

    post {
        always {
            echo 'Pipeline completed'
        }
        success {
            echo 'Pipeline succeeded!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
