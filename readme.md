## Especificaciones

Se realiza implementacion de patrón mvc para realizar un desacople de capas de la siguiente forma:
- <b>Capa de presentación</b> 
        la cual la genera la herramienta Swagger (documentacion de API's) en la que se usa la notación especificada por cada metodo invocado 
        en los diferentes endPoints y de esta manera poder ver los recursos disponibles en la API
- <b>Capa Logica</b>
        la cual se compone de los controladores diseñados para los diferentes recursos generados en la API 
        (Productos, Proveedores, Ordenes, Reportes).
        En esta capa se desarrollo la logica necesaria para realizar validaciones y cargues correctos de las fuentes proporcionadas por cada uno de los componentes ya mecionados al sistema
- <b>Capa de persistencia de datos</b>
        la cual la componen las entidades creadas por cada uno de los recursos definidos en la capa anteriormente mencionada,
        así como también entidades adicionales para la creación de relaciones implicitas.
        En esta se encuentra la abstracción de la data necesaria por cada 
        uno de los requerimientos (reportes) solicitados en el pdf suministrado para la prueba

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
routes
|-- api.php
|-- web.php
.env
.env.example

********************************************************************************************
PostData:
 Solo se tienen en cuenta los archivos necesarios en la estructura, ya que el framework empleado dispone de muchos archivos
********************************************************************************************

```

## Comandos a ejecutar para despliegue de prueba
se debe configurar el archivo /etc/host incluir la linea
127.0.0.1 merqueo

adicionalmente agregar configuracion de virtualhost para poder ejecutar 
correctamente el proyecto:
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/prueba_merqueo/public"
    ServerName merqueo
</VirtualHost>
```
# Descargue de librerias 
    $ composer install
    
## Base de datos
```
    crear database con nombre "merqueo"
    El script para la cargue de base de datos se encuentra en el folder
    ./storage/app/recursos/dumpSqlMerqueo.sql
    
    Nota: se puede ejecutar migraciones de LARAVEL teniendo creada la base
    de datos "merqueo":
    $ php artisan migrate
```

##Variables de entorno
```
se debe cambiar el nombre del archivo .env.example por .env para que funcione correctamente la aplicación.
```