<?php
/*
   +----------------------------------------------------------------------+
   | LiteRT Core Library                                                  |
   +----------------------------------------------------------------------+
   | Copyright (c) 2007-2017 Fenying Studio                               |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.0 of the Apache license,    |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | https://github.com/litert/core/blob/master/LICENSE                   |
   +----------------------------------------------------------------------+
   | Authors: Angus Fenying <i.am.x.fenying@gmail.com>                    |
   +----------------------------------------------------------------------+
 */

declare (strict_types = 1);

error_reporting(0);

@ini_set('display_errors', 'off');

require __DIR__ . '/../vendor/autoload.php';

L\Core\boot();

L\Core\EventBus::getInstance()->on('error', function(array $e) {

    echo 'Error: ';
    print_r($e);
})->on('shutdown', function() {

    echo 'Bye bye', PHP_EOL;
});

if (L\Core\EventBus::getInstance()->hasListeners('error')) {

    echo 'Registered error handler.', PHP_EOL;
}

$num = 0;

echo 1 / $num;

require __DIR__ . '/bad-file-test.php';
