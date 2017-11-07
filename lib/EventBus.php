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

namespace L\Core;

class EventBus
{
    use TEventListener;

    protected static $__inst;

    protected function __construct()
    {
        $this->__initEvents();
    }

    public static function getInstance(): EventBus
    {
        if (!self::$__inst) {

            self::$__inst = new self();
        }

        return self::$__inst;
    }
}
