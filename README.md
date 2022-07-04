# homework

composer install

docker-compose build

docker-compose exec php chmod -R 777 /var/www/html/storage

docker-compose exec php php /var/www/html/artisan migrate

docker-compose exec php php /var/www/html/artisan test
