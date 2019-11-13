<?php

/*PHP   2. Co\run() /var/www/swoole-app/src/mysql_client.php:20
PHP   3. Swoole\Coroutine\run() @swoole-src/library/alias_ns.php:19
PHP   4. Swoole\Coroutine\Scheduler->start() @swoole-src/library/alias_ns.php:9
*/


$s = microtime(true);
Co\run(function() {
    for ($c = 100; $c--;) {
        go(function () {
            $mysql = new Swoole\Coroutine\MySQL;
            $mysql->connect([
                'host' => '127.0.0.1',
                'user' => 'texx',
                'password' => 'test',
                'database' => 'swoole'
            ]);
            $statement = $mysql->prepare('SELECT * FROM `user`');
            for ($n = 100; $n--;) {
                $result = $statement->execute();
                assert(count($result) > 0);
            }
        });
    }
});
echo 'use ' . (microtime(true) - $s) . ' s';
