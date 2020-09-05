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

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

## Laravel 5.5+:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
// config/app.php
'providers' => [
    ...
    Solitweb\LaravelDirectAdmin\LaravelDirectAdminServiceProvider::class,
];
```

Optionally, register the facade:

```php
// config/app.php
'aliases' => [
    ...
    'DirectAdmin' => Solitweb\LaravelDirectAdmin\LaravelDirectAdminFacade::class,
];
```

To publish the config file to app/config/laravel-directadmin.php run:

```bash
php artisan vendor:publish --provider="Solitweb\LaravelDirectAdmin\LaravelDirectAdminServiceProvider"
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

### Magic Methods

It's also possible to make use of magic methods to get the data from the API as shown below:

```php
$users = DirectAdmin::getShowAllUsers();
// Translates to DirectAdmin->get()->request('SHOW_ALL_USERS');
```

Arguments are also supported when using a magic method:

```php
return DirectAdmin::postAccountAdmin([
    'action' => 'create',
    'username' => 'New Admin',
    ....
]);
// Translates to DirectAdmin->post()->request('ACCOUNT_ADMIN', [arguments]);
```

Magic Methods are named after the method (get/post) followed by the command without `CMD_API_` in CamelCase. So, if you want to make a GET request with the CMD_API_SHOW_ALL_USERS command, the magic method would be `getShowAllUsers()`.

### JSON Support

It's possible to use JSON support, this allows using the HTTP code for feedback.
No more annoying login screen errors on invalid login parameters.

```php
$data = DirectAdmin::get()->requestJSON('SHOW_USERS');
$response = DirectAdmin::get_status_code();
```

Also added magic methods support:
```php
$data = DirectAdmin::getjsonShowUsers();
```

### Change user during runtime

It's also possible to change the user during runtime as shown below:

```php
DirectAdmin::set_login('username', 'password')
```

## Credits
- [Phi1 'l0rdphi1' Stier](mailto:l0rdphi1@liquenox.net)
- [Joshua de Gier / Pendo](https://github.com/PendoNL)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
