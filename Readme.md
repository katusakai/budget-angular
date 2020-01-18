#First time setup
1. Install composer:
    1. For linux users: run `cd backend && docker run --rm -v $(pwd):/var/www composer install && cd ..`
    2. Windows users run `cd backend && composer install && cd ..`
2. Install npm:
    1. For linux users: run `cd frontend && docker run --rm -v $(pwd):/app npm install && cd ..`
    2. Windows users run `cd frontend && npm install && cd ..`
3. For linux users only: run `sudo chown -R $USER:$USER .`
4. Run `cp backend/.env.example backend/.env`
5. Run `cp .env.example .env` and change values for your project
6. Run `cp frontend/src/environments/env.ts.example frontend/src/environments/env.ts`
7. Change `API_PORT` in `frontend/src/environments/env.ts`. It must match with `API_PORT` from `.env`
8. Run `docker-compose up -d --build` and wait for services to start up. First time it will take several minutes.
9. Run `docker-compose exec backend php artisan key:generate`
10. Run `docker-compose exec backend php artisan config:cache`
11. Run `docker-compose exec backend php artisan migrate`
