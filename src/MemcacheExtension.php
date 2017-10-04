<?php


namespace SilexMemcache;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MemcacheExtension implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['memcache'] = function ($app) {
            $servers = isset($app['memcache.server']) ? $app['memcache.server'] : array(
                array('127.0.0.1', 11211)
            );

            $memcache = new \Memcached(serialize($servers));
            if (!count($memcache->getServerList())) {
                foreach ($servers as $config) {
                    call_user_func_array(array($memcache, 'addServer'), array_values($config));
                }
            }
            return $memcache;
        };
    }
}
