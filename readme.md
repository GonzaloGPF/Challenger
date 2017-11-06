# Chatvel

Proyecto personal hecho con Laravel y VueJS integrado con Pusher. Desarrollo TDD usando phpunit y Mocha.
Se trata de un sistema de mensajería instantánea y en tiempo real entre perfiles de usuarios logados.

- [VueJS](https://vuejs.org/).
- [Pusher](https://pusher.com/).
- [Phpunit](https://phpunit.de/).
- [Mocha](https://mochajs.org/).
- [MySQL](https://www.mysql.com/).

## Setup
Es necesario cumplir con los siguientes requisitos:

- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

También es necesario como tener una cuenta en Pusher.

### Variables de entorno

Copiar el archivo **.env.example** como **.env** en la misma ruta y modificar su contenido
según corresponda. Después hay que generar la clave con:

``php artisan key:generate``

### Entorno de desarrollo virtual
El proyecto está preparado para un desarrollo en local usando Homestead (una box de Vagrant),
sólo es necesario ejecutar el comando:
 
``vendor/bin/homestead make``

Esto creará el archivo de configuración *homestead.yml*, dejando el proyect listo para ser levantado con Vagrant.
Para ello se ejecuta:

``vagrant up`` Para levantar toda la máquina virtual

``vagrant ssh`` Para acceder a la consola

**Nota:** La base de datos del servidor está configurada con el usuario *homestead* y el password *secret*

### Base de Datos
La Base de Datos está definida mediante migraciones y seeders de Laravel. Para montarla:

``php artisan migrate``

Y para rellenar con datos de prueba:

``php artisan db:seed`` 

### Dependencias
Todas las dependencias del proyecto están definidas en los archivos *composer.json* y *package.json*. 
Para instalarlas:

``composer install``

``npm install``

## Testing
Los tests están desarrollados usando *phpunit* para el backend
 
 ``vendor/bin/phpunit``
 
 y *mocha* para el frontend
 
 ``npm run test``

## License
Este proyecyo está bajo una licencia [MIT license](http://opensource.org/licenses/MIT).
