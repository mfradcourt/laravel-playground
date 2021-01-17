# Games Collection POC
Quick demo website using Laravel, listing a collection of games with possibility to add & remove games.

## Requirements
- Docker
- Docker-compose

## Environment Setup
`cp .env.example .env`

add `127.0.0.1 local.games.com` to Host file

## Application Setup
`docker exec games_php php artisan migrate`


## Access the application
http://local.games.com:8000/


