#!/bin/bash

sh ./scripts/generate-cert-include.sh

if ! [ -x "$(command -v docker-compose)" ]; then
  echo 'Error: docker-compose is not installed.' >&2
  exit 1
fi

echo 'Running composer install'
docker-compose -f docker-compose-helpers.yml run --rm composer install

#cd frontend && npm install && cd ..
#chown -R $USER:$USER .
#cp backend/.env.example backend/.env
#cp .env.example .env
#cp frontend/src/environments/env.ts.example frontend/src/environments/env.ts
#docker-compose up -d --build
#docker-compose exec backend php artisan key:generate
#docker-compose exec backend php artisan config:cache
#docker-compose exec backend php artisan migrate
