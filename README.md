## About The Package

This package provides useful helper classes and functions.



Install the package via Composer:
```sh
 composer require coderiki/php-helpers
```
And you can use:
```php
<?php
require_once "vendor/autoload.php";

use yusufonur\Helpers\Str;


$title = 'This is a title';

$slug = Str::slug($title);
```