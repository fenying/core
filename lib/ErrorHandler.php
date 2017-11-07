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

/**
 * Bootstrap of the LiteRT/Core.
 */
function boot()
{
    $errorHandler = function(
        int $code,
        string $error,
        string $file,
        int $line,
        $isException = false
    ) {

        $e = [
            'code' => $code,
            'message' => $error,
            'file' => $file,
            'line' => $line
        ];

        if ($isException === true) {

            $e['type'] = 'exception';
            $e['level'] = 'error';
        }
        else {

            switch ($e['code']) {
            case E_NOTICE:
                $e['type'] = 'notice';
                $e['level'] = 'warning';
                break;
            case E_WARNING:
                $e['type'] = 'warning';
                $e['level'] = 'warning';
                break;
            case E_USER_DEPRECATED:
                $e['type'] = 'user-deprecated';
                $e['level'] = 'warning';
                break;
            case E_COMPILE_WARNING:
                $e['type'] = 'compile-warning';
                $e['level'] = 'warning';
                break;
            case E_USER_WARNING:
                $e['type'] = 'user-warning';
                $e['level'] = 'warning';
                break;
            case E_USER_NOTICE:
                $e['type'] = 'user-notice';
                $e['level'] = 'warning';
                break;
            case E_STRICT:
                $e['type'] = 'strict';
                $e['level'] = 'warning';
                break;
            case E_DEPRECATED:
                $e['type'] = 'deprecated';
                $e['level'] = 'warning';
                break;
            case E_ERROR:
                $e['type'] = 'error';
                $e['level'] = 'error';
                break;
            case E_CORE_ERROR:
                $e['type'] = 'core-error';
                $e['level'] = 'error';
                break;
            case E_RECOVERABLE_ERROR:
                $e['type'] = 'recoverable-error';
                $e['level'] = 'error';
                break;
            case E_COMPILE_ERROR:
                $e['type'] = 'compile-error';
                $e['level'] = 'error';
                break;
            case E_PARSE:
                $e['type'] = 'parse';
                $e['level'] = 'error';
                break;
            case E_USER_ERROR:
                $e['type'] = 'user-error';
                $e['level'] = 'error';
                break;
            default:
                $e['type'] = 'user-custom';
                $e['level'] = 'error';
            }

            error_clear_last();
        }

        EventBus::getInstance()->emit(
            'error',
            $e
        );
    };

    register_shutdown_function(function() use ($errorHandler) {

        if ($e = error_get_last()) {

            $errorHandler(
                $e['type'],
                $e['message'],
                $e['file'],
                $e['line']
            );
        }

        EventBus::getInstance()->emit('shutdown');
    });

    set_error_handler($errorHandler);

    set_exception_handler(function(\Throwable $e) use ($errorHandler) {

        $errorHandler(
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            true
        );
    });

    unset($errorHandler);

}
