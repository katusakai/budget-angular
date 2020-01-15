#First time setup
1. Run `cd backend`
2. Install composer:
    1. For linux users: run `docker run --rm -v $(pwd):/app composer install`
    2. Windows users run `composer install`
3. Run `cd ..`
4. For linux users only: run `sudo chown -R $USER:$USER .`
5. Run `cp backend/.env.example backend/.env`
6. Run `cp .env.example .env` and change values for your project
7. Run `docker-compose up -d --build`
8. Run `docker-compose exec backend php artisan key:generate`
9. Run `docker-compose exec backend php artisan config:cache`
10. Run `docker-compose exec backend php artisan migrate`
