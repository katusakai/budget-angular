#cd backend && composer install && cd ..
#cd frontend && npm install && cd ..
chown -R $USER:$USER .
cp backend/.env.example backend/.env
cp .env.example .env
cp frontend/src/environments/env.ts.example frontend/src/environments/env.ts
docker-compose up -d --build
docker-compose exec backend php artisan key:generate
docker-compose exec backend php artisan config:cache
docker-compose exec backend php artisan migrate
