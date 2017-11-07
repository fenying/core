# 组件 TEventListener

> [上一章：Core 事件](./01-core-events.md) | [目录](./index.md)

## 0. 说明

TEventListener 是一个 PHP trait，提供一组方法，允许一个类的对象进行事件监听。

## 1. 方法 on

### 1.1. 用途

该方法将一个函数添加到指定事件的处理函数队列中。

> 每个事件可以有多个事件处理函数，根据注册顺序调用。

### 1.2. 定义

```php
/**
 * Add a listener for an event.
 *
 * @param string $event
 * @param callable $listener
 *
 * @return static
 */
public function on(string $event, $listener);
```

### 1.3. 参数说明

- string **$event** 事件名称
- callable **$listener** 事件处理函数，必须是一个可以调用的函数（类方法则允许通过 
autoload 加载）

### 1.4. 返回值

返回对象本身。

---------------------------------------------------------------

## 2. 方法 removeListener

### 2.1. 用途

该方法将指定事件的一个处理函数从该事件的处理函数队列中删除。

### 2.2. 定义

```php
/**
 * Remove specific listener of an event.
 *
 * @param string $event
 * @param callable $listener
 *
 * @return static
 */
public function removeListener(
    string $event,
    callable $listener
)
```

### 2.3. 参数说明

- string **$event** 事件名称
- callable **$listener** 要删除的事件处理函数

### 2.4. 返回值

返回对象本身。

---------------------------------------------------------------

## 3. 方法 removeAllListeners

### 3.1. 用途

该方法将指定事件的处理函数队列清空。

### 3.2. 定义

```php
/**
 * Remove all listeners of an event.
 *
 * @param string $event
 *
 * @return static
 */
public function removeAllListeners(
    string $event
)
```

### 3.3. 参数说明

- string **$event** 要清空的事件名称

### 3.4. 返回值

返回对象本身。

---------------------------------------------------------------

## 4. 方法 emit

### 4.1. 用途

触发一个事件。即按注册顺序逐个调用被触发事件的处理函数。

### 4.2. 定义

```php
/**
 * Emit an event.
 *
 * @param string $event
 * @param array ...$args
 *
 * @return static
 */
public function emit(string $event, ...$args)
```

### 4.3. 参数说明

- string **$event** 要触发的事件名称。
- mixed **...$args** 要传递给事件处理函数的参数。

### 4.4. 返回值

返回对象本身。

---------------------------------------------------------------

## 5. 方法 __initEvents

### 5.1. 用途

该方法用于初始化事件监听队列，必须在以上 4 个方法调用前调用此方法。

> 建议在类的构造函数中调用此方法。

### 5.2. 定义

```php
/**
 * Call this method to initialize the events listener.
 */
protected function __initEvents()
```

### 5.3. 返回值

无。

> [下一章：工具函数](./03-Function-Extensions.md) | [目录](./index.md)
