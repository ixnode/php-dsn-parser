# PHP DSN Parser

[![Release](https://img.shields.io/github/v/release/ixnode/php-dsn-parser)](https://github.com/ixnode/php-dsn-parser/releases)
[![](https://img.shields.io/github/release-date/ixnode/php-dsn-parser)](https://github.com/ixnode/php-dsn-parser/releases)
![](https://img.shields.io/github/repo-size/ixnode/php-dsn-parser.svg)
[![PHP](https://img.shields.io/badge/PHP-^8.2-777bb3.svg?logo=php&logoColor=white&labelColor=555555&style=flat)](https://www.php.net/supported-versions.php)
[![PHPStan](https://img.shields.io/badge/PHPStan-Level%20Max-777bb3.svg?style=flat)](https://phpstan.org/user-guide/rule-levels)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-Unit%20Tests-6b9bd2.svg?style=flat)](https://phpunit.de)
[![PHPCS](https://img.shields.io/badge/PHPCS-PSR12-416d4e.svg?style=flat)](https://www.php-fig.org/psr/psr-12/)
[![PHPMD](https://img.shields.io/badge/PHPMD-ALL-364a83.svg?style=flat)](https://github.com/phpmd/phpmd)
[![Rector - Instant Upgrades and Automated Refactoring](https://img.shields.io/badge/Rector-PHP%208.2-73a165.svg?style=flat)](https://github.com/rectorphp/rector)
[![LICENSE](https://img.shields.io/github/license/ixnode/php-api-version-bundle)](https://github.com/ixnode/php-api-version-bundle/blob/master/LICENSE)

> This library helps to parse DSN\URI strings.

## 1. Usage

```php
use Ixnode\PhpDsnParser\DsnParser;
```

```php
$dsnParser = new DsnParser('smtp://suserweb:S22jD7Po%.,/zu34k@mail.domain.tld:25?verify_peer=0');

print_r($dsnParser->getParsed());
// (array) [
//     'protocol' => 'smtp',
//     'user' => 'suserweb',
//     'password' => 'S22jD7Po%.,/zu34k',
//     'host' => 'mail.domain.tld',
//     'port' => 25,
//     'options' => 'verify_peer=0',
// ]
```

## 2. Installation

```bash
composer require ixnode/php-dsn-parser
```

```bash
vendor/bin/php-dsn-parser -V
```

```bash
php-dsn-parser 0.1.0 (03-07-2023 01:17:26) - Björn Hempel <bjoern@hempel.li>
```

## 3. Library development

```bash
git clone git@github.com:ixnode/php-dsn-parser.git && cd php-dsn-parser
```

```bash
composer install
```

```bash
composer test
```

## 4. License

This library is licensed under the MIT License - see the [LICENSE](/LICENSE) file for details.
