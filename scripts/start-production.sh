#!/bin/bash

WEB_PROD_SSL_PORT=$(grep WEB_PROD_SSL_PORT .env | cut -d '=' -f2)
DOMAINLIST=($(grep DOMAINLIST .env | cut -d '=' -f2))

echo '### Starting services for production'
docker-compose up -d frontend_prod api backend db certbot

echo '### Services for production are ready'
echo "### Your production app is      reachable by https://localhost:$WEB_PROD_SSL_PORT"

for domain in "${DOMAINLIST[@]}";
do
echo "### Your production app is also reachable by https://$domain"
done
