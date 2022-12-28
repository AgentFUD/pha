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

6. Fix some permission issues if you have any
```
bash$ docker exec -it app bash
root@1724f029db3f:/var/www# chmod -R 777 storage/
```

7. Migrate
```
bash$ docker exec -it app php /var/www/artisan migrate
```

8. Seed two users and two players
```
bash$ docker exec -it app php /var/www/artisan db:seed
```
9. Now you can run tests as well
```
bash$ docker exec -it app php /var/www/artisan test   
```

10. Run queue:listen and you are ready to go to upload file.txt
```
bash$ docker exec -it app php /var/www/artisan queue:listen
```

11. Login to the app [ first@domain.com / password ]

12. Trigger calculateStatistics job by calling /api/game/calculate-statistics

13. Get the generated statistics by calling /api/game/get-player-statistics


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
Upload file - Validate | Y
Upload file - Parse into database | Y
Organize table relations player and rounds | Y
Port smaatcoda/poker-rankr to Laravel8/PHP8 | Y
Implement player statistics calculation | Y
Implement player statistics - Winner for each round | Y
Implement player statistics - Best hand | Y
Unit tests | Y
Migrations | Y
Database seeder | Y
Postman collection | Y
Docker nginx | Y
Docker php-fpm | Y
Docker mysql | Y
