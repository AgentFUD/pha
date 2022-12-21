# Poker Hand API

## Install and run the app

1. Clone the repo
```
bash$ git clone git@github.com:AgentFUD/pha.git
```

2. .env file

Copy .env.example to .env

3. Run the app
```
bash$ docker-compose up
```

4. Install app dependencies
```
bash$ docker exec -it app php /usr/bin/composer install
```

5. You have to generate app key
```
bash$ docker exec -it app php /var/www/artisan key:generate   
```

6. Now you can run tests as well
```
bash$ docker exec -it app php /var/www/artisan test   
```

7. Fix some permission issues
```
bash$ docker exec -it app bash
root@1724f029db3f:/var/www# chmod -R 777 storage/
```

8. Migrate
```
bash$ docker exec -it app php /var/www/artisan migrate
```

9. Seed two users
```
bash$ docker exec -it app php /var/www/artisan db:seed
```

## Checklist
TODO | DONE
--- | ---
Php >= 7.4 | Y
Symfony 5.x or Laravel 8.x | Y
Docker and docker-compose | Y
Mysql >= 5.7 | Y
Git | Y
API Authentication - Login | Y
API Authorization - Sanctum | Y
Player manager Create | Y
Player manager Get | Y
Player manager Update | Y
Player manager Delete | Y
Upload file - Validate |
Upload file - Parse into database |
Organize table relations player and rounds |
Player statistics - Best hand
Player statistics - Winner for each round
Unit tests |
Migrations | Y
Database seeder | Y
Postman collection | Y
Docker nginx | Y
Docker php-fpm | Y
Docker mysql | Y
