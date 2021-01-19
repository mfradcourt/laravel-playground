# Games Collection POC
Quick demo website using Laravel, listing a collection of games with possibility to add & remove games.

## Requirements
- Docker
- Docker-compose
- This has been tested on Windows using WSL2 and should work using any UNIX environment

## Environment Setup
Copy the env file: `cp .env.example .env`

Add `127.0.0.1 local.games.com` to Host file.

Run `docker-compose up` in the project directory

## Application Setup
Install dependencies `docker exec games_php composer install`

Create the required database tables `docker exec games_php php artisan migrate`

## Access the application
http://local.games.com:8000/


## Extra
### See datatabase in phpMyAdmin

Add `127.0.0.1 pma.local.games.com` to Host file.

Access using http://pma.local.games.com:8000/

