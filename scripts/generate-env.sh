#!/bin/bash

echo '### Generating .env'
cp .env.example .env

echo '### Generating backend/.env'
cp backend/.env.example backend/.env

echo '### Generating frontend/src/environments/env.ts'
cp frontend/src/environments/env.ts.example frontend/src/environments/env.ts

echo '### All environmental files are generated'
echo '### Edit .env beforce launching scripts/install.sh'
echo '### Edit frontend/src/environments/env.ts before launching scripts/install.sh'