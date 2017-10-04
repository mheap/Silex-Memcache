<?php

namespace SilexMemcache\Tests\Extension;

use PHPUnit\Framework\TestCase;

use SilexMemcache\MemcacheExtension;

use Memcached;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MemcacheExtensionTest extends TestCase
{
    public function setUp()
    {
        if (!class_exists('Memcached')) {
            $this->markTestSkipped('You must have the Memcached or Memcache extension enabled');
        }
    }

    public function testRegisterMemcached()
    {
        $app = new Application();
        $app->register(new MemcacheExtension(), array(
            'memcache.server' => array(
                array('localhost', 11211)
            )
        ));

        $app->get('/', function () use ($app) {
            $app['memcache'];
        });

        $request = Request::create('/');
        $app->handle($request);

        $this->assertInstanceOf(Memcached::class, $app['memcache']);
    }

    public function testSetAndGetMemcached()
    {
        $app = new Application();
        $app->register(new MemcacheExtension(), array(
            'memcache.server' => array(
                array('localhost', 11211)
            )
        ));

        $expectedValue = 'my_test_value';
        $app['memcache']->set('my_test_key', $expectedValue);

        $this->assertSame($expectedValue, $app['memcache']->get('my_test_key'));
    }
}
