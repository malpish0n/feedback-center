FeedbackCenter API

Technologies used:

    Docker
    
    Symfony
    
    Symfony Security
    
    Doctrine ORM

    LexikJWTAuthenticationBundle

    Docker

    Postman (or any API client) for testing

Features:

    User registration and login

    JWT token-based authentication

    Role-based access control (User/Admin)

    Management of Posts, users and groups

    Consistent JSON responses formatted by ApiResponseFormatter

Requirements

    PHP 8.1 or higher

    Composer

    Symfony CLI
    
    Docker

Installation and Setup

# 1. Clone the repository
git clone https://github.com/malpish0n/feedback-center-api.git
cd FeedbackCenter

# 2. Start Docker containers (build and run)
docker compose up -d --build

# 3. Access the PHP container
docker exec -it feedbackcenter-php-1 bash

# 4. Install PHP dependencies
composer install

JWT Key Generation

If keys are not generated yet, run:

mkdir -p config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

Then, configure .env.local:

JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE= <your pasphrase here>

Fixtures loading

php bin/console doctrine:fixtures:load

Auth endpoints:

Method	    Endpoint	      Description
POST	    /api/register	  Register a new user
POST	    /api/login	      Log in and receive a JWT token
POST        /api/logout       Log out

Use the JWT token in the Authorization header for all protected endpoints:

Authorization: Bearer <your_token>





