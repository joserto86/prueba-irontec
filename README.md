# prueba-irontec

## Requisitos

Será imprescindible disponer de un servidor `LAMP | WAMP` 

## Primeros pasos

* [Composer]: En este enlace está toda la documentación al respecto
  Una vez instalado ejecutar el siguiente comando para confirmar que la instalación se ha efectuado correctamente:

  ```$ composer -v ```

* A continuación ejecutar para obtener todas las dependencias necesarias para ejecutar el proyecto: 
 
  ```$ composer install```
  
* Editar el fichero `.env` para configurar la conexión de BBDD, concretamente buscar esta línea:

  ```DATABASE_URL=mysql://root:tiger@mysql:3306/irontec?serverVersion=5.7```

* Crear la BBDD previamente configurada mediante el siguiente comando:

  ```$ php bin/console  doctrine:database:create```
  
* Restaurar el backup de bbdd ubicado en la raiz del repositorio `dump.sql` en la BBDD para tener algunos datos de prueba

* Acceder al sitio a través del navegador

   [composer]: <https://getcomposer.org/>

