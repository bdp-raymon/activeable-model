# A laravel package to activate or deactivate models on demand

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alish/activeable-model.svg?style=flat-square)](https://packagist.org/packages/alish/activeable-model)
[![Build Status](https://travis-ci.org/bdp-raymon/activeable-model.svg?branch=main)](https://travis-ci.org/bdp-raymon/activeable-model)
[![Quality Score](https://img.shields.io/scrutinizer/g/bdp-raymon/activeable-model.svg?style=flat-square)](https://scrutinizer-ci.com/g/bdp-raymon/activeable-model)
[![Total Downloads](https://img.shields.io/packagist/dt/alish/activeable-model.svg?style=flat-square)](https://packagist.org/packages/alish/activeable-model)

with this package you can add activation ability to your models
## Installation

You can install the package via composer:

```bash
composer require alish/activeable-model
```

## Usage

for adding activation behavior to your model just use `IsActiveable` trait to your model
``` php

use Alish\ActiveableModel\Tratis\IsActiveable;

class Model {
    use IsActiveable;
}

```

the default behavior of activation has been set to `true` ,if you want that your models became deactive by default:
```php
class Model {
    use IsActiveable;

    protected bool $defaultStatus = false;
}
```

you have access to history of activation of your model with 
```php
    $histories = $model->activeStates()->get();

    // get the exact time of state change
    /** @var \Carbon\Carbon $changeStateTime */
    $changeStateTime = $histories->first()->created_at;

    // you can also get the status of state change
    /** @var bool $status */
    $status = $histories->first()->is_active;
```

you can also publish the migration file:
```bash
php artisan vendor:publish --provider="Alish\ActiveableModel\ActiveableModelServiceProvider" --tag=migrations
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email alishabani9270@gmail.com instead of using the issue tracker.

## Credits

- [Ali Shabani](https://github.com/alish)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
