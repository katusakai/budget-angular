#!/bin/bash

bash ./scripts/generate-cert-include.sh

if ! [ -x "$(command -v docker-compose)" ]; then
  echo '### Error: docker-compose is not installed.' >&2
  exit 1
fi

bash ./scripts/init-letsencrypt.sh $1

echo '### Running composer install...'
#if [ "$OS" = "Windows_NT" ];
#then
  docker-compose -f docker-compose-helpers.yml run --rm composer install
#else
 # docker run --rm --interactive --tty -v $(pwd)/backend:/app composer install
#fi

echo '### Running npm install...'
docker-compose -f docker-compose-helpers.yml run --rm node npm install

echo '### Building images...'
docker-compose build --no-cache

echo "### Preparing container for data seeding"
docker-compose up -d api backend db

echo "### Seeding default database data"
if [ "$OS" = "Windows_NT" ];
then
  winpty docker-compose exec backend php artisan key:generate
  winpty docker-compose exec backend php artisan config:cache
  winpty docker-compose exec backend php artisan migrate:fresh --seed

  if [ "$1" != 'prod' ];
  then
    winpty docker-compose exec backend php artisan db:seed --class=FakeDataSeeder
  fi

else
  docker-compose exec backend php artisan key:generate
  docker-compose exec backend php artisan config:cache
  docker-compose exec backend php artisan migrate:fresh --seed

  if [ "$1" != 'prod' ];
  then
    docker-compose exec backend php artisan db:seed --class=FakeDataSeeder
  fi

fi

echo "### Turning down containers"
docker-compose down
