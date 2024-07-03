Uso del Patrón Factory Method:

Se crea una clase llamada backend\app\Factories\ConcreteEmployeeFactory.php que implementa la interfaz backend\app\Factories\EmployeeFactoryInterface.php, permitiendo la creación de objetos de tipo Employee de forma encapsulada desde cualquier punto, asegurando que la lógica de creación esté centralizada y pueda ser modificada o extendida en el futuro.

Para el ejemplo la creación del objeto tipo Employee se realiza en backend\app\Http\Controllers\EmployeeController.php   



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
