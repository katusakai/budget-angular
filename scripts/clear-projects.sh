#!/bin/bash

read -p '### You are about to delete all database files, certificates, and installed packages. Are you sure? (y/N) ' decision
if [ "$decision" = "Y" ] || [ "$decision" = "y" ]; then

    echo '### Shuting down services'
    docker-compose down

    echo '### Deleting database data and certificates'
    rm -r data

    echo '### Deleting composer packages'
    rm -r backend/vendor

    echo '### Deleting node packages'
    rm -r frontend/node_modules
    
else
    exit
fi