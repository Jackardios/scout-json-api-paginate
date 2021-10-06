# A paginator that plays nice with the JSON API spec

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jackardios/scout-json-api-paginate.svg?style=flat-square)](https://packagist.org/packages/jackardios/scout-json-api-paginate)
[![Total Downloads](https://img.shields.io/packagist/dt/jackardios/scout-json-api-paginate.svg?style=flat-square)](https://packagist.org/packages/jackardios/scout-json-api-paginate)

This package is just [Scout](https://github.com/laravel/scout) extension for [spatie/laravel-json-api-paginate](https://github.com/spatie/laravel-json-api-paginate)

In a vanilla Laravel application [the query builder paginators will listen to `page` request parameter](https://laravel.com/docs/master/pagination#paginating-query-builder-results). This works great, but it does follow the example solution of [the json:api spec](http://jsonapi.org/). That example [expects](http://jsonapi.org/examples/#pagination) the query builder paginator to listen to the `page[number]` and `page[size]` request parameters. 

This package adds a `jsonPaginate` method to the Scout query builder that listens to those parameters and adds [the pagination links the spec requires](http://jsonapi.org/format/#fetching-pagination).

## Installation

You can install the package via composer:

```bash
composer require jackardios/scout-json-api-paginate
```

In Laravel 5.5 and above the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    ...
    Spatie\JsonApiPaginate\JsonApiPaginateServiceProvider::class,
    Jackardios\ScoutJsonApiPaginate\JsonApiPaginateServiceProvider::class,
];
```

Optionally you can publish the config file with:

```bash
php artisan vendor:publish --provider="Spatie\JsonApiPaginate\JsonApiPaginateServiceProvider" --tag="config"
```

This is the content of the file that will be published in `config/json-api-paginate.php`

```php
<?php

return [

    /*
     * The maximum number of results that will be returned
     * when using the JSON API paginator.
     */
    'max_results' => 30,

    /*
     * The default number of results that will be returned
     * when using the JSON API paginator.
     */
    'default_size' => 30,

    /*
     * The key of the page[x] query string parameter for page number.
     */
    'number_parameter' => 'number',

    /*
     * The key of the page[x] query string parameter for page size.
     */
    'size_parameter' => 'size',

    /*
     * The name of the macro that is added to the Scout query builder.
     */
    'method_name' => 'jsonPaginate',

    /*
     * If you only need to display Next and Previous links, you may use
     * simple pagination to perform a more efficient query.
     */
    'use_simple_pagination' => false,

    /*
     * Here you can override the base url to be used in the link items.
     */
    'base_url' => null,

    /*
     * The name of the query parameter used for pagination
     */
    'pagination_parameter' => 'page',
];
```

## Usage

To paginate the results according to the json API spec, simply call the `jsonPaginate` method.

```php
YourModel::search('...')->jsonPaginate();
```

Of course you may still use all the builder methods you know and love:

```php
YourModel::search('...')->where('my_field', 'myValue')->jsonPaginate();
```

By default the maximum page size is set to 30. You can change this number in the `config` file or just pass the value to  `jsonPaginate`.

```php
$maxResults = 60;

YourModel::search('...')->jsonPaginate($maxResults);
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
