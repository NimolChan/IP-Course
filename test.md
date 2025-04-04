1. docker exec -it laravel_app php artisan test
2. check env: docker exec -it laravel_app php artisan env
listing file test: docker exec -it laravel_app ls tests

run test: docker exec -it laravel_app php artisan test
run test: docker exec -it -e APP_ENV=testing laravel_app php artisan test
==========================================
php artisan migrate:fresh --env=testing
php artisan test
==========================================