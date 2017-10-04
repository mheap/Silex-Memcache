# Silex-Memcache

[![Build Status](https://secure.travis-ci.org/mheap/Silex-Memcache.png?branch=master)](http://travis-ci.org/mheap/Silex-Memcache)

### Requirements

This extension only works with *PHP 7.1+*, *Silex 2* and the *Memcached* driver.
[Version 1.0.0](https://github.com/mheap/Silex-Memcache/releases/tag/1.0.0) is compatible
with Silex 1 and both the Memcache/Memcached drivers.

### Installation

Install with composer:

```bash
composer require mheap/silex-memcache
```

### Usage

Before you can use this extension you need to register it with your application. You can
specify a list of servers to connect to at this point

```php
$app->register(new SilexMemcache\MemcacheExtension(), array(
    'memcache.server' => array(
        array('127.0.0.1', 11211)
    )
));
```

Once the extension is registered, it'll be available as `$app['memcache']`:

```php
$app->get('/', function() use($app) {
    $app['memcache']->set('my_value', 'This is an example');
    $value = $app['memcache']->get('my_value');
});
```

### Running the tests

You'll need memcached running on port `11211` locally to run the tests. If you don't have
memcached installed you can run `docker-compose up` to run it in a container instead.
