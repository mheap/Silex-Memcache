# installing memcached extension
curl -s http://pecl.php.net/get/memcached-3.0.3.tgz > memcached-3.0.3.tgz
tar -xzf memcached-3.0.3.tgz
sh -c "cd memcached-3.0.3 && phpize && ./configure && make && sudo make install"
echo "extension=memcached.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`

composer install --dev --prefer-source
