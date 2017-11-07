# Core 事件

> [下一章：概述](./00-overview.md) | [目录](./index.md)

## 1. 启动核心事件监听

LiteRT/Core 模块通过类 EventBus 提供了两个核心事件的监听和处理，分别是 `error` 事件
和 `shutdown` 事件。

但是这个监听机制不是默认启动的，需要在脚本启动时执行一句：

```php
\L\Core\boot();
```

## 2. 监听和处理 error 事件

`error` 事件发生在 PHP 脚本遇到错误时，通过以下方式可以监听：

```php
\L\Core\EventBus::getInstance()->on('error', function($error) {

    var_dump($error); // 将错误信息打印出来
});
```

在监听回调中，参数 `$error` 是一个键值数组，内含如下 key：

- int **code** 错误码，可以是 `E_ERROR`、`E_WARNING` 等内置错误码，也可能是异常
的错误号。
- string **message** 错误描述文字。
- string **file** 错误发生的文件路径。
- int **$line** 错误发生的文件行号。
- string **level** 错误等级，只有 `error` 和 `warning` 两种。
- string **type** 错误类型，包含如下类型：

    - **exception** 未捕获的异常。
    - **notice** PHP 内置 `E_NOTICE` 警告。
    - **warning** PHP 内置 `E_WARNING` 警告。
    - **compile-warning** PHP 内置 `E_COMPILE_WARNING` 警告。
    - **user-warning** PHP 内置 `E_USER_WARNING` 警告。
    - **user-notice** PHP 内置 `E_USER_NOTICE` 警告。
    - **user-deprecated** PHP 内置 `E_USER_DEPRECATED` 警告。
    - **strict** PHP 内置 `E_STRICT` 警告。
    - **error** PHP 内置 `E_ERROR` 错误。
    - **core-error** PHP 内置 `E_CORE_ERROR` 错误。
    - **recoverable-error** PHP 内置 `E_RECOVERABLE_ERROR` 错误。
    - **compile-error** PHP 内置 `E_COMPILE_ERROR` 错误。
    - **parse** PHP 内置 `E_PARSE` 错误。
    - **user-error** PHP 内置 `E_USER_ERROR` 错误。
    - **user-custom** 脚本自定义错误码。

## 3. 监听和处理 shutdown 事件

`shutdown` 事件发生在 PHP 脚本结束时，通过以下方式可以监听：

```php
\L\Core\EventBus::getInstance()->on('shutdown', function() {

   echo 'Bye bye!';
});
```

## 4. EventBus 的使用

EventBus 类基于组件 TEventListener，更多使用方式请参考组件 TEventListener
的文档。

> [下一章：组件 TEventListener](./02-TEventListener.md) | [目录](./index.md)
