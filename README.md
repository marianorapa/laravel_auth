[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/marianorapa/laravel_auth"><img src="images/unlu.png" alt="Logo" width="160" height="160"></a>
  <h4 align="center">Universidad Nacional de Luján</h4>
  <h1 align="center">Seminario de Integración Profesional (11087)</h1>
  <h2 align="center">Trabajo Práctico de Campo</h2>  
  <h3 align="center">Edición 2020</h3>
  <p align="center"><a href="https://github.com/marianorapa/laravel_auth"><strong>Explorar los documentos »</strong></a></p>
</p>



<!-- INDICE -->
## Índice
* [Equipo docente](#equipo-docente)
* [Integrantes del grupo](#integrantes-del-grupo)
* [Acerca del proyecto](#acerca-del-proyecto)
  * [Desarollado con](#desarrollado-con)
  * [Demo en vivo](#demo-en-vivo)
* [Instalación desde el código fuente](#instalacion-desde-el-codigo-fuente)
* [Documentación](#documentacion)
* [Licencia](#licencia)



<!-- DOCENTES -->
## Equipo docente
| Profesor  | Cargo  |
| :------------ |:---------------:|
| Bibiana D. Rossi      | Titular |
| David M. Petrocelli      | Ayudante        |
| Viviana P. Chapetto | Ayudante        |



<!-- INTEGRANTES -->
## Integrantes del grupo
| Alumno  | Legajo  |
| :------------ |:---------------:|
| César G. Ferrarotti      | 113145 |
| Dilan M. Bernabe Riegel      | 143852        |
| Emanuel Rodriguez | 143050        |
| Luciano Palmieri | 148478        |
| Mariano Rapaport | 155671        |



<!-- ACERCA DEL PROYECTO -->
## Acerca del proyecto

<!--[![Vilumar][product-screenshot]]-->
![VILUMAR][product-screenshot]

**VILUMAR S.A.** es una fábrica de alimento para el consumo animal (principalmente pollos y cerdos) ubicada en San Andrés de Giles, Buenos Aires.

Este sistema web tiene como principal objetivo facilitar las operaciones diarias de la empresa, desde que ingresan los insumos hasta el despacho de los productos finalizados.

Las funcionalidades incluyen atender la entrada de camiones, gestionar los pedidos de producción, realizar préstamos a clientes, administrar el stock, entre otras.
<br />


### Desarrollado con
<br />
<p align="center">
  <a href="https://www.php.net/"><img src="images/php.png" alt="PHP" alt="PHP" width=120></img></a>
  <img src="images/blank.png" width=40></img>
  <a href="https://laravel.com"><img src="images/laravel.png" alt="Laravel" width=240></img></a>
  <img src="images/blank.png" width=40></img>
  <a href="https://mariadb.org/"><img src="images/mariadb.png" alt="MariaDB" width=220></img></a>
</p>
<br />


### Demo en vivo
Es posible probar la aplicación desde [aquí][demo-url].

<!--[![Heroku][heroku-logo]](https://www.heroku.com/)-->
<p align="left"><a href="https://www.heroku.com/"><img src="images/heroku.png" alt="Logo" width="300"></a></p>

Deben utilizarse las siguientes credenciales para operar:
* Usuario: *administrator*
* Contraseña: *admin01*



<!-- INSTALACION -->
## Instalacion desde el codigo fuente
### Windows
- Descargar e instalar las siguientes dependencias (las imágenes son enlaces de descarga): <p align="center"><a href="https://git-scm.com/download/win"><img src="images/git.png" alt="Logo" width="180"></a><img src="images/blank.png" width=60></img><a href="https://getcomposer.org/Composer-Setup.exe"><img src="images/composer.png" alt="Logo" width="60"></a><img src="images/blank.png" width=60></img><a href="https://sourceforge.net/projects/xampp/files/latest/download"><img src="images/xampp.png" alt="Logo" width="260"></a></p>
- Clonar el repositorio utilizando `git clone https://github.com/marianorapa/laravel_auth.git`
- Ejecutar `composer install` para instalar las dependencias
- Crear una base de datos con codificación `utf8mb4_general_ci` 
- Renombrar el archivo de configuración con el comando `copy .env.example .env` (posteriormente debe actualizarse para que apunte a la base de datos creada en el punto anterior) 
- Generar una clave ejecutando `php artisan key:generate`
- Migrar la base de datos con `php artisan migrate` 
- Correr los seeders con `php artisan db:seed`
- Levantar el servidor mediante `php artisan serve` 

NOTA: *Para la instalación en entorno producción, referirse al manual correspondiente en la [documentación](#documentacion).*



<!-- DOCUMENTACION -->
## Documentacion
* Especificación General de Requerimientos
  * [Documento en formato PDF](documentation/egr/vilumar.pdf)
  * [Proyecto de Enterprise Architect](https://github.com/marianorapa/laravel_auth/raw/master/documentation/egr/vilumar.eap)
* Manuales
  * [De instalación](documentation/manuales/instalacion.pdf)
  * [De usuario](documentation/manuales/usuario.pdf)
* Prácticas Profesionales Supervisadas
  * [Formulario de aceptación](documentation/pps/aceptacion.pdf)
  * [Formulario de cumplimiento](documentation/pps/cumplimiento.pdf)
* Presentaciones
  * [Modelo de negocio](https://github.com/marianorapa/laravel_auth/raw/master/documentation/presentaciones/mneg.pptx)
  * [De venta](https://github.com/marianorapa/laravel_auth/raw/master/documentation/presentaciones/venta.pptx)



<!-- LICENCIA -->
## Licencia
The Laravel framework is open-sourced software licensed under the [MIT license](https://github.com/laravel/framework/raw/master/LICENSE.md).



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/marianorapa/laravel_auth.svg?style=flat-square
[contributors-url]: https://github.com/marianorapa/laravel_auth/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/marianorapa/laravel_auth.svg?style=flat-square
[forks-url]: https://github.com/marianorapa/laravel_auth/network/members
[stars-shield]: https://img.shields.io/github/stars/marianorapa/laravel_auth.svg?style=flat-square
[stars-url]: https://github.com/marianorapa/laravel_auth/stargazers
[issues-shield]: https://img.shields.io/github/issues/marianorapa/laravel_auth.svg?style=flat-square
[issues-url]: https://github.com/marianorapa/laravel_auth/issues
[license-shield]: https://img.shields.io/github/license/marianorapa/laravel_auth.svg?style=flat-square
[license-url]: https://github.com/marianorapa/laravel_auth/blob/master/LICENSE.txt
[unlu-logo]: images/unlu.png
[product-screenshot]: images/screenshot.gif
[heroku-logo]: images/heroku.png
[heroku-url]: https://www.heroku.com/
[demo-url]: https://pacific-savannah-37454.herokuapp.com/
[php-logo]: images/php.png
[php-url]: https://www.php.net/
[laravel-logo]: images/laravel.png
[laravel-url]: https://laravel.com
[mariadb-logo]: images/mariadb.png
[mariadb-url]: https://mariadb.org/
[xampp-logo]: images/xampp.png
[xampp-url]: https://sourceforge.net/projects/xampp/files/latest/download
[git-logo]: images/git.png
[git-url]: https://git-scm.com/download/win
[composer-logo]: images/composer.png
[composer-url]: https://getcomposer.org/Composer-Setup.exe
