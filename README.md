# Laravel 5 DirectAdmin API wrapper
[![Latest Version](https://img.shields.io/github/release/solitweb/laravel-directadmin.svg?style=flat-square)](https://github.com/laravel-solitweb/directadmin/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/solitweb/laravel-directadmin/master.svg?style=flat-square)](https://travis-ci.org/solitweb/laravel-directadmin)
[![Total Downloads](https://img.shields.io/packagist/dt/solitweb/laravel-directadmin.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-directadmin)

## Installation

You can install this package via Composer using:

```bash
composer require solitweb/laravel-directadmin
```

You must also install this service provider:

```php
// config/app.php
'providers' => [
    ...
    Solitweb\LaravelDirectAdmin\DirectAdminServiceProvider::class,
];
```

Optionally, register the facade:

```php
// config/app.php
'aliases' => [
    ...
    'DirectAdmin' => Solitweb\LaravelDirectAdmin\DirectAdminFacade::class,
];
```

To publish the config file to app/config/laravel-directadmin.php run:

```bash
php artisan vendor:publish --provider="Solitweb\LaravelDirectAdmin\DirectAdminServiceProvider"
```

## Usage

Import the facade at the top of your file.

```php
use DirectAdmin;
```

### Examples

This will return an array of all users currently owned the reseller:

```php
return DirectAdmin::get()->request('SHOW_USERS');
```

This will return an array of the user's usages:

```php
return DirectAdmin::get()->request('SHOW_USER_USAGE', ['user' => 'john']);
```

For more commands check the [DirectAdmin API docs](https://www.directadmin.com/api.php).
You have to copy the command without the `CMD_API_`.

## Credits
- [Phi1 'l0rdphi1' Stier](mailto:l0rdphi1@liquenox.net)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
