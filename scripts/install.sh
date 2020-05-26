#!/bin/bash

bash ./scripts/generate-cert-include.sh

if ! [ -x "$(command -v docker-compose)" ]; then
  echo '### Error: docker-compose is not installed.' >&2
  exit 1
fi

bash ./scripts/init-letsencrypt.sh $1

echo '### Running composer install...'
docker-compose -f docker-compose-helpers.yml run --rm composer install

echo '### Running npm install...'
docker-compose -f docker-compose-helpers.yml run --rm node npm install

echo "### Preparing backend containers for data seeding"
docker-compose up -d --build api backend db

if [ "$1" != 'prod' ]; then
  echo "### Preparing remaining containers for development"
  docker-compose build --no-cache frontend_dev frontend_karma

else
  echo "### Preparing remaining containers for development"
  docker-compose build --no-cache frontend_prod

fi

echo "### Seeding default database data"
if [ "$OS" = "Windows_NT" ]; then
  winpty docker-compose exec backend php artisan key:generate
  winpty docker-compose exec backend php artisan config:cache
  winpty docker-compose exec backend php artisan migrate:fresh --seed

  if [ "$1" != 'prod' ]; then
    winpty docker-compose exec backend php artisan db:seed --class=FakeDataSeeder
  fi

else
  docker-compose exec backend php artisan key:generate
  docker-compose exec backend php artisan config:cache
  docker-compose exec backend php artisan migrate:fresh --seed

  if [ "$1" != 'prod' ]; then
    docker-compose exec backend php artisan db:seed --class=FakeDataSeeder
  fi

fi

echo "### Turning down containers"
docker-compose down
