# 概述

> [目录](./index.md)

LiteRT 是一个轻量级的组件化框架，框架内大部分元素都是可拆卸的组件。Core 则是 LiteRT
的核心部件，其他一切模块都基于 LiteRT/Core。

目前 LiteRT/Core 提供如下功能：

1. 事件监听组件 TEventListener

    这是一个 PHP trait，将其引入其他类中即可直接使用。

2. 核心事件总线

    LiteRT/Core 通过 EventBus 类提供对 error 事件和 shutdown 事件的监听和处理。

3. 全局错误监听

    LiteRT/Core 对 PHP 进行了全局的错误监听，可以捕获一切 PHP 错误和未捕获的异常。
    然后通过 EventBus 类提供的 error 事件即可进行错误处理。

    > EventBus 的 error 事件和 shtudown 事件都须通过 `\L\Core\boot` 函数启动监听。

4. 扩展工具函数

    Core 组件还提供了包括 createRandomString、isEMail、startsWith 在内的十多个工具
    函数。

> [下一章：Core 事件](./01-core-events.md) | [目录](./index.md)
