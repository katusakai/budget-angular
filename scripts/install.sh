#!/bin/bash

sh ./scripts/generate-cert-include.sh

if ! [ -x "$(command -v docker-compose)" ]; then
  echo 'Error: docker-compose is not installed.' >&2
  exit 1
fi

echo 'Running composer install...'
docker-compose -f docker-compose-helpers.yml run --rm composer install

echo 'Running npm install...'
docker-compose -f docker-compose-helpers.yml run --rm node npm install

echo 'Making copies of .env files...'
cp backend/.env.example backend/.env
cp .env.example .env
cp frontend/src/environments/env.ts.example frontend/src/environments/env.ts

echo 'Building images...'
docker-compose build --no-cache

echo "Preparing container for data seeding"
docker-compose up -d api backend db

echo "Seeding default database data"
docker-compose exec backend php artisan key:generate
docker-compose exec backend php artisan config:cache
docker-compose exec backend php artisan migrate:fresh --seed

echo "Turning down containers"
docker-compose down
