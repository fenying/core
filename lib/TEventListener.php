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
 * This class provides the event bus
 *
 * @package litert/core
 */
trait TEventListener
{
    /**
     * @var callable[]
     */
    protected $_events;

    /**
     * Call this method to initialize the events listener.
     */
    protected function __initEvents()
    {
        $this->_events = [];
    }

    /**
     * Add a listener for an event.
     *
     * @param string $event
     * @param callable $listener
     *
     * @return static
     */
    public function on(string $event, $listener)
    {
        if (empty($this->_events[$event])) {

            $this->_events[$event] = [$listener];
        }
        else {

            $this->_events[$event][] = $listener;
        }

        return $this;
    }

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
    {
        if ($this->_events[$event] ?? false) {

            $key = array_search(
                $listener,
                $this->_events[$event],
                true
            );

            if ($key !== false) {

                array_splice(
                    $this->_events[$event],
                    $key,
                    1
                );
            }
        }

        return $this;
    }

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
    {
        unset($this->_events[$event]);

        return $this;
    }

    /**
     * Tell if there are listeners of an event.
     *
     * @param string $event
     *
     * @return bool
     */
    public function hasListeners(
        string $event
    ): bool
    {
        return count($this->_events[$event] ?? []) > 0;
    }

    /**
     * Emit an event.
     *
     * @param string $event
     * @param array ...$args
     *
     * @return static
     */
    public function emit(string $event, ...$args)
    {
        if ($this->_events[$event] ?? false) {

            foreach ($this->_events[$event] as $handler) {

                $handler(...$args);
            }
        }

        return $this;
    }
}
