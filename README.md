# Query Viewer

[![GitHub Workflow Status](https://github.com/laratoolbox/query-viewer/workflows/Run%20tests/badge.svg)](https://github.com/laratoolbox/query-viewer/actions)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)

[![Packagist](https://img.shields.io/packagist/v/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![Packagist](https://poser.pugx.org/laratoolbox/query-viewer/d/total.svg)](https://packagist.org/packages/laratoolbox/query-viewer)
[![Packagist](https://img.shields.io/packagist/l/laratoolbox/query-viewer.svg)](https://packagist.org/packages/laratoolbox/query-viewer)

Package description: This package adds sql methods for eloquent and query builder.

## Installation

Install via composer
```bash
composer require laratoolbox/query-viewer
```

### Publish package assets

```bash
php artisan vendor:publish --provider="LaraToolbox\QueryViewer\QueryViewerServiceProvider"
```

## Usage

After installing this package you may use these methods on eloquent and db builder.
- `getSql`
  * This method returns sql query.
  * Differences between `toSql` and this method is this method returns sql with question marks (?) replaced.

- `dumpSql`
  * This method prints sql query and returns builder.

- `logSql`
  * This method logs sql query and returns builder.
  * Log type can be set in config file.


## Security

If you discover any security related issues, please email
instead of using the issue tracker.

## Credits

- [](https://github.com/laratoolbox/query-viewer)
- [All contributors](https://github.com/laratoolbox/query-viewer/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
