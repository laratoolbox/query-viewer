![Social Image](social.jpeg)

[![GitHub Workflow Status](https://github.com/laratoolbox/query-viewer/workflows/Run%20tests/badge.svg)](https://github.com/laratoolbox/query-viewer/actions)
[![Packagist](https://img.shields.io/packagist/v/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![Packagist](https://img.shields.io/packagist/l/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![GitHub issues](https://img.shields.io/github/issues/laratoolbox/query-viewer.svg)](https://github.com/laratoolbox/query-viewer/issues)

## Package description

This package adds custom methods to eloquent and database query builder for getting sql query. (question marks replaced with values)

Laravel's `toSql()` method gives you sql query without bindings replaced. (see question marks below)
```php
\DB::table('users')->select('name')->where('id', 5)->toSql();

// select `name` from `users` where `id` = ? and `name` = ?
```

With this package you have `getSql()` method. Which gives you same result with bindings replaced.
```php
\DB::table('users')->select('name')->where('id', 5)->getSql();

// select `name` from `users` where `id` = 5 and `name` = 'laravel'
```

## Requirement

```
Laravel >= 5.5
```

## Build History

[![Build History](https://buildstats.info/github/chart/laratoolbox/query-viewer?branch=main)](https://github.com/laratoolbox/query-viewer/actions)

## Installation

Install via composer
```bash
$ composer require laratoolbox/query-viewer
```

### Publish package config

```bash
$ php artisan vendor:publish --provider="LaraToolbox\QueryViewer\QueryViewerServiceProvider"
```

## Usage

After installing this package you can use these methods on eloquent and database builder.

- `getSql`
  * This method returns sql query.
  * Optionally takes closure as parameter and calls closure with sql string.
  * Returns string or closure result.

- `dumpSql`
  * This method prints sql query (uses dump() function)
  * Returns builder.

- `logSql`
  * This method logs sql query.
  * Optionally takes prefix string parameter. Which prepends to sql string.
  * Log type can be set in config file (default is "info").
  * Returns builder.

## Examples

#### Eloquent

```php
use App\Models\User;

User::select('name')->where('id', 5)->getSql();
// 'select `name` from `users` where `id` = 5'

User::select('name')
    ->where('id', 5)
    ->dumpSql()
    // PRINTS: select `name` from `users` where `id` = 5
    ->logSql('LOG_PREFIX_HERE') // logs sql to log file. (LOG_PREFIX_HERE : select `name` from `users` where `id` = 5)
    ->where('name', '!=', 'john')
    ->dumpSql()
    // PRINTS: select `name` from `users` where `id` = 5 and `name` != 'john'
    ->where('surname', '!=', 'doe')
    ->where('email', 'LIKE', '%example%')
    ->getSql(function(string $sql) {
        echo $sql;
        // select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
    })
    ->getSql();
    // PRINTS: select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
```

#### Database Builder

```php
\DB::table('users')->select('name')->where('id', 5)->getSql();
// 'select `name` from `users` where `id` = 5'

\DB::table('users')
    ->where('id', 5)
    ->dumpSql()
    // PRINTS: select `name` from `users` where `id` = 5
    ->logSql('LOG_PREFIX_HERE') // logs sql to log file. (LOG_PREFIX_HERE : select `name` from `users` where `id` = 5)
    ->where('name', '!=', 'john')
    ->dumpSql()
    // PRINTS: select `name` from `users` where `id` = 5 and `name` != 'john'
    ->where('surname', '!=', 'doe')
    ->where('email', 'LIKE', '%example%')
    ->getSql(function(string $sql) {
        echo $sql;
        // select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
    })
    ->getSql();
    // PRINTS: select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
```

#### Replace bindings for all queries

Add code below into `app/Providers/AppServiceProvider.php` file for listening all queries.

```php
use LaraToolbox\QueryViewer\QueryViewer;

\DB::listen(function ($query) {
    $sql = QueryViewer::replaceBindings($query->sql, $query->bindings);

    logger()->info($sql);
});
```

## Testing

``` bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Semih ERDOGAN](https://github.com/semiherdogan)
- [Dincer DEMIRCIOGLU](https://github.com/dinncer)
- [All contributors](https://github.com/laratoolbox/query-viewer/graphs/contributors)
- The social image generated with [banners.beyondco.de](https://banners.beyondco.de/).
- This package generated using the [melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
