# PrimeXconnect API test

## Assumptions

- No authentication required
- One user can have multiple roles

## Setting  up

1. In the terminal 

```
git clone https://github.com/richdho/primex.git
cd primex
```

2. Create an database in your local MySQL

   ```SQL
   CREATE SCHEMA `primex` DEFAULT CHARACTER SET utf8mb4 ;
   ```

3. Create an file `.env` in the project directory and copy the content from `.env`

4. Input the database information and random APP_KEY accordingly in `.env`

   ```
   APP_NAME=Lumen
   APP_ENV=local
   APP_KEY=AnzQ0lnxePTQWFaLYqqdcpHH61Aw8qkv
   APP_DEBUG=true
   APP_URL=http://localhost
   APP_TIMEZONE=UTC
   
   LOG_CHANNEL=stack
   LOG_SLACK_WEBHOOK_URL=
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=primex
   DB_USERNAME=root
   DB_PASSWORD=
   
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   ```

5. Install dependencies

   ```
   composer install
   ```

6. Migrate database and seeding

   ```
   php artisan migrate
   composer dump-autoload
   php artisan db:seed
   ```

7. Run tests

   ```
   phpunit
   ```



