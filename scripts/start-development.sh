#!/bin/bash

WEB_DEV_PORT=$(grep WEB_DEV_PORT .env | cut -d '=' -f2)
KARMA_PORT=$(grep KARMA_PORT .env | cut -d '=' -f2)

echo '### Starting services for production'
docker-compose up -d frontend_dev frontend_karma api backend db

echo '### Services for production are ready'
echo "### Your development app is reachable by https://localhost:$WEB_DEV_PORT"
echo "### Your testing environment is reachable by http://localhost:$KARMA_PORT"
