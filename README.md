# Requirements / used versions:

## Backend:

- PHP 8.1.3
- Symfony CLI version 5.4.7
- Composer version 2.2.7
- Docker version 20.10.14, build a224086

## Frontend:

- node v16.14.2
- npm 8.5.0

## Installation instruction:

- git clone https://github.com/JoshuaKoch/full-stack-coding-challenge.git
- cd backend
- composer install
- docker compose up -d
- php bin/console make:migration
- php bin/console --no-interaction doctrine:migrations:migrate
- php import.php
- symfony server:start -d

- cd ..
- cd frontend
- npm install
- ng serve
