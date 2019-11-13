<?php

$fp = stream_socket_client("tcp://www.google.com:80", $errno, $errstr, 30);
fwrite($fp,"GET / HTTP/1.1\r\nHost: www.google.com\r\n\r\n");

swoole_event_add($fp, function($fp) {
    $resp = fread($fp, 8192);
    // Remove the socket from eventloop
    swoole_event_del($fp);
    fclose($fp);
});
echo "Finish\n";