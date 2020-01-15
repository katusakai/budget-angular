#First time setup
1. Run `cd backend`
2. Install composer:
    1. For linux users: run `docker run --rm -v $(pwd):/app composer install`
    2. Windows users run `composer install`
3. Run `cd ..`
4. For linux users only: run `sudo chown -R $USER:$USER .`
