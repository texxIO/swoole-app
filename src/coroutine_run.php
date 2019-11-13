<?php
Swoole\Runtime::enableCoroutine();
$s = microtime(true);
Co\run(function() {
    for ($c = 100; $c--;) {
        go(function () {
            ($redis = new Redis)->connect('127.0.0.1', 6379);
            for ($n = 100; $n--;) {
                assert($redis->get('awesome') === 'swoole');
            }
        });
    }
});
echo 'use ' . (microtime(true) - $s) . ' s';

//$run = new Coroutine\Run;
//$run->add(function () {
//    Co::sleep(1);
//    echo "Done.\n";
//});
//$run->start();