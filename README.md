<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Instalación (Windows)

- Descargar XAMPP para Windows: https://sourceforge.net/projects/xampp/files/latest/download

- Crear base de datos llamada ```laravel_auth_db``` (utf8mb4_general_ci)

- Descargar Composer: https://getcomposer.org/Composer-Setup.exe

Instalar dependencias:

```
composer install
```

Renombrar el archivo de configuración:

```
copy .env.example .env
```

Generar la clave:

```php
php artisan key:generate
```

Migrar BD:

```php
php artisan migrate
```

Correr los seeders:

```php
php artisan db:seed
```

Levantar el servidor:

```php
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
