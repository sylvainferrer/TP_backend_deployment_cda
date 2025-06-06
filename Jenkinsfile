pipeline {
    
    agent none

    stages {
        stage('Git clone') {
            agent { label 'agent-php' }
            steps {
                git branch: 'main', url: 'https://github.com/sylvainferrer/TP_backend_deployment_cda.git'
            }
        }
        stage('Copy server') {
            agent { label 'agent-php' }
            steps {
                sh '''
                   lftp -u storehoop,"$Mdp" "$ftp" -e "mirror -R ${WORKSPACE}/ www/ ; quit"
                '''
            }
        }
        stage('Composer') {
            agent { label 'agent-php' }
                steps {
                     sh '''
                        sshpass -p "$Mdp" ssh -o StrictHostKeyChecking=no "$ssh" '
                        cd www/ &&
                        composer install
                        '
                    '''
                }
        }
        stage('Modifier .env') {
            agent { label 'agent-php' }
            steps {
                script {
                     sh '''
sshpass -p "$Mdp" ssh -o StrictHostKeyChecking=no "$ssh" "cat > www/.env << 'EOF'
${credentials}
EOF"
'''
                }
            }
        }
         stage('Migration DB') {
            agent { label 'agent-php' }
                steps {
                    sh '''
                    sshpass -p "$Mdp" ssh -o StrictHostKeyChecking=no "$ssh" 'cd www/ && php migrate.php'
                    '''
                }
        }
    }
}
