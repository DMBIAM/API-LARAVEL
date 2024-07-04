# Frontend
El front está en IONIC y angular, utiliza en su gran mayoría componentes nativos para el render de los elementos

## Listar empleados
Desde http://localhost:8100/home se podrá observar el listado de empleados, adicional se podrá indicar si es favorito o no utilizando el tooltip, si el empleado es favorito el tooltip estará seleccionado y en color azul.

También se podrá ordenar los empleados por el satisfacción ascendente y descendente.

![Prueba Modal](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/employee-list.png)

## Mostrar modal y ver favoritos
Desde el Home se observará un botón en el header que permite abrir el modal, este botón solo se habilita una vez se carga la información de los empleados.

Desde el modal se podrá buscar empleados por nombre, compañía o categoría

![Prueba Modal](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/modal-1.png)

![Prueba Modal](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/modal-2.png)

Desde el modal se podrá eliminar empleados marcados como favoritos, con solo darle clic al botón con icono de trash, una vez se da clic el botón asociado al empleado favorito se deshabilita mientras se realiza el proceso correspondiente para luego retirarse el empleado del listado observado

![Prueba Modal Peticiones](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/modal-3.png)

![Prueba Modal Peticiones](https://github.com/DMBIAM/API-LARAVEL/blob/main/pic/modal-4.png)



# Backend 
## Uso del Patrón Factory Method:

Se crea una clase llamada backend\app\Factories\ConcreteEmployeeFactory.php que implementa la interfaz backend\app\Factories\EmployeeFactoryInterface.php, permitiendo la creación de objetos de tipo Employee de forma encapsulada desde cualquier punto, asegurando que la lógica de creación esté centralizada y pueda ser modificada o extendida en el futuro.

Para el ejemplo la creación del objeto tipo Employee se realiza en backend\app\Http\Controllers\EmployeeController.php   


## Uso del Patrón Command:

Se utiliza en el controlador de favoritos backend\app\Http\Controllers\FavoritesController.php para crear (backend\app\Commands\CreateFavoriteCommand.php), eliminar (backend\app\Commands\DeleteFavoriteCommand.php) y buscar (backend\app\Commands\FavoriteSearchCommandHandler.php) favoritos. Para este se utiliza una única interfaz que se encarga de ejecutar el comando invocado 

## Ejecución de prueba unitaria:

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
Ruta: postman\api_laravel.postman_collection.json 

# Copia de la BD para hacer pruebas
Ruta: dump\api.sql

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
