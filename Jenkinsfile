pipeline {
    agent {
        docker {
            image 'php:8.2-fpm'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    environment {
        APP_NAME = 'laravel-app'
        DB_HOST = 'db'
        DB_DATABASE = 'laravel'
        DB_USERNAME = 'root'
        DB_PASSWORD = 'password'
    }

    stages {
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

        stage('Deploy') {
            when {
                branch 'main'
            }
            steps {
                // Sesuaikan dengan proses deploy Anda
                echo 'Deploying to production...'
                // Contoh deploy menggunakan Docker:
                sh 'docker build -t laravel-app .'
                sh 'docker-compose down && docker-compose up -d'
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
