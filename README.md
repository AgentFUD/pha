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

6. Now you can run migrations
```
bash$     
```

7. Now you can run tests as well
```
bash$ docker exec -it app php /var/www/artisan test   
```

8. Fix some permission issues
```
bash$ docker exec -it app bash
root@1724f029db3f:/var/www# chmod -R 777 storage/
```

9. Migrate
```
bash$ docker exec -it app php /var/www/artisan migrate
```

10. Seed two users
```
bash$ docker exec -it app php /var/www/artisan db:seed
```