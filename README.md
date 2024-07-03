# Uso del Patrón Factory Method:

Se crea una clase llamada backend\app\Factories\ConcreteEmployeeFactory.php que implementa la interfaz backend\app\Factories\EmployeeFactoryInterface.php, permitiendo la creación de objetos de tipo Employee de forma encapsulada desde cualquier punto, asegurando que la lógica de creación esté centralizada y pueda ser modificada o extendida en el futuro.

Para el ejemplo la creación del objeto tipo Employee se realiza en backend\app\Http\Controllers\EmployeeController.php   


# Uso del Patrón Command:

Se utiliza en el controlador de favoritos backend\app\Http\Controllers\FavoritesController.php para crear (backend\app\Commands\CreateFavoriteCommand.php), eliminar (backend\app\Commands\DeleteFavoriteCommand.php) y buscar (backend\app\Commands\FavoriteSearchCommandHandler.php) favoritos. Para este se utiliza una única interfaz que se encarga de ejecutar el comando invocado 

# Ejecución de prueba unitaria:

## Creación de empleados
Ruta: backend\tests\Unit\EmployeeTest.php

## Creación de ciudades
Ruta: backend\tests\Unit\CityTest.php
![Prueba unitaria](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/unit_test_create_city.png)

# DML de prueba

### Consultar favoritos por categoría
```sql
USE api;
select favorites.*, 
employees.name as employee_name, 
areas.name as area_name, 
categories.name as category_name, 
companies.name as company_name, 
cities.name as city_name 
from favorites 
inner join employees on favorites.employee_id = employees.id 
inner join areas on employees.area_id = areas.id 
inner join categories on employees.category_id = categories.id 
inner join companies on employees.company_id = companies.id 
inner join cities on employees.city_id = cities.id 
where employees.category_id = 3
```

# Colección de postman
Ruta: /postman 


# Docker
Como punto inicial se deberá 

1. Construir la imagen de Docker con el comando: docker build .
2. Ejecutar el docker compose: docker-compose up -d

Para facilidad, el back utiliza docker e incluye las variables de entorno para comprender lo realizado

# Comandos ejecutados

## Línea de comando para docker
docker exec -it amazon_linux /bin/bash

## Ejecución de laravel
php artisan serve --host=0.0.0.0 --port=80

## Ejecución de pruebas unitarias en Backend
php artisan test --list
php artisan test
php artisan test --filter EmployeeTest

## Creación de modelos
php artisan make:model Favorites -m

## Creación de controladores
php artisan make:controller CityController

## Creación de factory para datos dummy
php artisan make:factory CategoryFactory --model=Category

## Ejecución de migraciones
php artisan migrate:status
php artisan migrate 
php artisan migrate:rollback --path=/database/migrations/2024_07_03_162804_create_employees_table.php
php artisan migrate --path=/database/migrations/2024_07_03_162804_create_employees_table.php
