![Social Image](social.jpeg)

[![GitHub Workflow Status](https://github.com/laratoolbox/query-viewer/workflows/Run%20tests/badge.svg)](https://github.com/laratoolbox/query-viewer/actions)
[![Packagist](https://img.shields.io/packagist/v/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![Packagist](https://img.shields.io/packagist/l/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![GitHub issues](https://img.shields.io/github/issues/laratoolbox/query-viewer.svg)](https://github.com/laratoolbox/query-viewer/issues)

## Package description

This package adds custom sql methods to eloquent and database query builder.

Laravel's `toSql()` method gives you sql query without bindings replaced.
```sql
select `name` from `users` where `id` = ? and `name` = ?
```

With this package you have `getSql()` method. Which gives you same result with bindings replaced.
```sql
select `name` from `users` where `id` = 5 and `name` = 'laravel'
```

## Requirement

```
Laravel >= 5.5
```

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
  * Optionally takes closure and calls closure with sql parameter.
  * Returns string or closure result.

- `dumpSql`
  * This method prints sql query (uses dump() function)
  * Returns builder.

- `logSql`
  * This method logs sql query.
  * Optionally takes prefix string. Which prepends to sql string.
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
    ->logSql('LOG_PREFIX_HERE') // logs sql to log file. (LOG_PREFIX_HERE : select `name` from `users` where `id` = 5)
    ->where('name', '!=', 'john')
    ->dumpSql()
    ->where('surname', '!=', 'doe')
    ->where('email', 'LIKE', '%example%')
    ->getSql(function(string $sql) {
        echo $sql;
    });
// select `name` from `users` where `id` = 5
// select `name` from `users` where `id` = 5 and `name` != 'john'
// select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
```

#### Database Builder

```php
\DB::table('users')->select('name')->where('id', 5)->getSql();
// 'select `name` from `users` where `id` = 5'

\DB::table('users')
    ->where('id', 5)
    ->dumpSql()
    ->logSql('LOG_PREFIX_HERE') // logs sql to log file. (LOG_PREFIX_HERE : select `name` from `users` where `id` = 5)
    ->where('name', '!=', 'john')
    ->dumpSql()
    ->where('surname', '!=', 'doe')
    ->where('email', 'LIKE', '%example%')
    ->getSql(function(string $sql) {
        echo $sql;
    });
// select `name` from `users` where `id` = 5
// select `name` from `users` where `id` = 5 and `name` != 'john'
// select `name` from `users` where `id` = 5 and `name` != 'john' and `surname` != 'doe' and `email` LIKE '%example%'
```

#### Replace bindings for all queries
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

## Credits

- [Semih ERDOGAN](https://github.com/semiherdogan)
- [Dincer DEMIRCIOGLU](https://github.com/dinncer)
- [All contributors](https://github.com/laratoolbox/query-viewer/graphs/contributors)
- The social image generated with [banners.beyondco.de](https://banners.beyondco.de/).
- This package generated using the [melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
