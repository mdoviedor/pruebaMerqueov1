<p align="center">
    <img src="https://image.flaticon.com/icons/png/512/1059/1059757.png" width="120"> Pruebas para aplicar a Back End
</p>


## Especificaciones tecnicas

Para dar solución al problema que se plantea use patron mvc haciendo desacoplamiento de capas de la siguiente manera:
- <b>Capa de presentación</b> 
        la cual la genera la herramienta Swagger en la que se usa la notación especificada por cada metodo invocado 
        en los diferentes endPoints y de esta manera poder ver los recursos disponibles en la API
- <b>Capa de Logica</b>
        la cual la componen los controladores diseñados para los diferentes recursos generados (Productos / Proveedores / Ordenes / Reportes).
        En esta capa desarrolle la logica necesaria para realizar validaciones y cargues correctos de las fuentes proporcionadas por cada uno de los componentes ya mecionados al sistema
- <b>Capa de persistencia</b>
        la cual la componen las entidades creadas por cada uno de los recursos definidos en la capa superior, así como también entidades adicionales
        que considere necesarios para la creación de relaciones implicitas.
        En esta capa desarrolle la logica para la abstracción de la data necesaria por cada 
        uno de los requerimientos (reportes) solicitados en el pdf proporcionado

## Estructura de carpetas

```

app
|-- Http
|   |-- Controllers
|   |   |-- ProductsController.php
|   |   |-- ProvidersController.php
|   |   |-- OrdersController.php
|   |   `-- ReportsController.php
|   `--
|-- Models
|   |-- OrderModel.php
|   |-- ProductModel.php
|   |-- ProductOutOfInventaryModel.php
|   |-- ProviderModel.php
|   |-- RelOrdersProductsModel.php
|   `-- RelProviderProductsModel.php
config
|-- app.php
|-- database.php
`-- l5-swagger.php
databse
|-- migrations
|   |-- 2014_10_12_000000_create_users_table.php
|   |-- 2014_10_12_100000_create_password_resets_table.php
|   |-- 2019_07_20_042308_CreateEntityProducts.php
|   |-- 2019_07_22_033044_CreateEntityProviders.php
|   |-- 2019_07_22_034303_CreateEntityRelProviderProducts.php
|   |-- 2019_07_23_000146_CreateEntityProductOutOfInventory.php
|   |-- 2019_07_23_001936_CreateEntityOrders.php
|   `-- 2019_07_23_002219_CreateEntityRelOrdersProducts.php
docker
|-- docker-compose.yml
`-- merqueo.conf
routes
`-- api.php
.env
.env.example

********************************************************************************************
** Nota 
**    [
**        Dada la cantidad de folders empleadas por el framework solo se mencionan 
**        los archivos trabajados para la realización de la solución
**    ]
********************************************************************************************

```

Como herramientas de apoyo para la ejeución de tareas rutinarias y ayuda de despliegues tanto de front como de back use:

- [Composer](https://getcomposer.org/) para el manejo de paquetes y dependencias
- FrameWork base [Laravel 5.4](https://laravel.com/docs/5.4).
- Herramienta para la validación del API [DarkOnline / Swagger](https://github.com/zircote/swagger-php).
- Repositorio Docker [php:5.6-apache](https://hub.docker.com/_/php?tab=description&page=1)
- Repositorio Docker [mysql:5.7](https://hub.docker.com/_/mysql)

## Comandos a ejecutar para despliegue de proyecto sobre docker

```
    Nota: se deben generar ejecución de codigo en el folder ./docker
    
    # Creación de dominio local
    en el archivo /etc/host incluir la liena
    127.0.0.1 pmerqueo.com
    
    # Creación de contenedores
    $ sudo docker-compose up -d

    #### Si se ha generado con exito debe haber creado dos contenedores:
    #### >> docker_servicio_php56_1 ==> este debe poder acceder por web atravez del puerto 8083
    #### >> docker_servicio_mysql_1 ==> este debe proder acceder por conexion a mysql por puerto 3307

    # Acceso al contenedor de php
    $ sudo docker exec -it docker_servicio_php56_1 /bin/bash
    
    # copiado de configuraciones merqueo.conf
    $ cp /var/www/html/docker/merqueo.conf /etc/apache2/sites-enabled/merqueo.conf
    
    # inicio de servicio apache
    $ a2enmod rewrite && service apache2 start
    
    # Descargue de librerias 
    $ cd /var/www/html && composer install
    
    # copiado de archivo .env para framework laravel
    $ cp /var/www/html/.env.example /var/www/html/.env 

```

Link de acceso documentación api [pmerqueo.com:8083](http://pmerqueo.com:8083/api/documentation) <br>
Link de acceso documentación api 2 [localhost:8083](http://localhost:8083/api/documentation)

Link de acceso documentación [localhost/api/documentation](http://localhost/api/documentation)

## Base de datos

```

    El script para la cargua de base de datos se encuentra en el folder
    ./storage/app/recursos/dumpMerqueo.sql
    
    Nota: esta la opción de cargar las migraciones de LARAVEL

```
