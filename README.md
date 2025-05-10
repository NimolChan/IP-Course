# STEP 1: Clone code

```
docker run --rm -v "C:\User\Asus\ITC NOTED\ITC_24\Internet Programming\Laravel - Backend\laravel-docker:/app" composer create-project --prefer-dist laravel/laravel laravel
```

# STEP 2: Build project

```
docker compose up -d --build
```

# STEP 3: Fix permission 

```
docker exec -it laravel_app bash
root@d1deb2be4532:/var/www# chmod -R 775 ./storage ./bootstrap/cache
root@d1deb2be4532:/var/www# chown -R www-data:www-data storage bootstrap/cache
root@6638c6507143:/var/www# ls -l /var/www/database
root@6638c6507143:/var/www# chmod 664 ./database/database.sqlite
root@6638c6507143:/var/www# chown www-data:www-data /var/www/database/database.sqlite
exit

if error 

apt update && apt install -y curl unzip
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
cd /var/www composer install


database setup 
apt update && apt install -y libpq-dev libzip-dev unzip mariadb-client && docker-php-ext-install pdo pdo_mysql
1. Make Sure .env Exists
Inside your Laravel container, run:

ls -la /var/www
If you don’t see the .env file, create it:

cp .env.example .env
2. Set Proper Permissions for .env
Run the following commands to ensure Laravel can read the .env file:

chmod 777 .env
chown www-data:www-data .env
3. Regenerate the App Key
Now, try running:

php artisan key:generate
This should set the APP_KEY properly.

4. Clear Cache & Restart
After setting the key, run:

php artisan config:clear
php artisan cache:clear
exit
docker-compose restart
```

### TP02 Testing 
```
$ php artisan tinker
App\Models\Customer::all();
App\Models\Product::all();
```
