
docker exec -it amazon_linux /bin/bash

php artisan serve --host=0.0.0.0 --port=80

php artisan test --list
php artisan test
php artisan test --filter EmployeeTest


php artisan make:model Favorites -m



php artisan make:controller CityController
php artisan make:factory CategoryFactory --model=Category

php artisan migrate:status
php artisan migrate 
php artisan migrate:rollback --path=/database/migrations/2024_07_03_162804_create_employees_table.php
php artisan migrate --path=/database/migrations/2024_07_03_162804_create_employees_table.php

2024_07_03_162804_create_areas_table

2024_07_03_164324_create_employees_table.php
