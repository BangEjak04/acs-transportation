pipeline {
  agent any

  environment {
    COMPOSE_FILE = 'docker-compose.yml'
  }

  stages {
    stage('Checkout') {
      steps {
        git credentialsId: 'github-pat', url: 'https://github.com/BangEjak04/acs-transportation.git', branch: 'main'
      }
    }

    stage('Build Docker Containers') {
      steps {
        sh 'docker-compose build'
      }
    }

    stage('Run Containers') {
      steps {
        sh 'docker-compose up -d'
      }
    }

    stage('Install Laravel Dependencies') {
      steps {
        sh 'docker-compose exec -T app composer install'
      }
    }

    stage('Run Laravel Migration') {
      steps {
        sh 'docker-compose exec -T app php artisan migrate'
      }
    }
  }

  post {
    always {
      echo "Cleaning up..."
      sh 'docker-compose down'
    }
  }
}
