#!/bin/bash

domain=($(grep DOMAINLIST .env | cut -d '=' -f2))
file="./docker/nginx_includes/cert.include"

echo "Generating cert.include file with $domain values"
echo "ssl_certificate /etc/letsencrypt/live/$domain/fullchain.pem;" > $file
echo "ssl_certificate_key /etc/letsencrypt/live/$domain/privkey.pem;" >> $file

