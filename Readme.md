# Requirements
1. docker https://docs.docker.com/get-docker/
2. docker-compose https://docs.docker.com/compose/install/
# First time setup
For linux users only: for each script use `sudo bash ./script/scriptname.sh`

1. Run `./scripts/generate-env.sh` without `sudo`
2. Edit `.env` file according to you. Make sure that you use empty ports.
3. If you plan to use it for production, make sure that `API_PORT` matches in `.env` `frontend/src/environments/env.ts`.
4. Install:
    1. For development Run `./scripts/install.sh`
    2. For production Run `./scripts/install.sh prod`
    
# Usage
1. To start application:
    1. For development Run `./scripts/start-development.sh`
    2. For production Run `./scripts/start-production.sh`
2. To stop application Run `docker-compose down`
3. To enter backend terminal Run `docker-compose exec bash backend`
4. To enter frontend terminal (development only) Run `docker-compose exec bash frontend_dev`
5. To reach database terminal Run `docker-compose exec db mysql -u root -p` and enter `MYSQL_ROOT_PASSWORD`

# Tips for usage
1. If you add new model, run `docker-compose exec backend php artisan ide-helper:models` to update it with Eloquent properties and methods
2. After every update in production, stop frontend_prod container and run `docker-compose build --no-cache frontend_prod`
