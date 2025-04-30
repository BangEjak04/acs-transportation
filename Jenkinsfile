pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'laravelsail/php82-composer:latest'
    }

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/BangEjak04/acs-transportation.git'
            }
        }

        stage('Build & Test with Docker') {
            steps {
                sh """
                docker run --rm \
                    -v \$PWD:/app \
                    -w /app \
                    ${DOCKER_IMAGE} \
                    bash -c '
                        cp .env.example .env
                        composer install
                        php artisan key:generate
                        php artisan config:clear
                        php artisan test
                    '
                """
            }
        }
    }
}
