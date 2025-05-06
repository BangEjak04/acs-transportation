pipeline {
    agent any

    environment {
        COMPOSER_CACHE_DIR = '.composer'
    }

    stages {
        stage('Clone Repository') {
            steps {
                echo 'Cloning Repository...'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Run Tests') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }
    }
}
