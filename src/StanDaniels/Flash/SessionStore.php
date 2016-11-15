<?php
namespace StanDaniels\Flash;

interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param array  $data
     */
    public function flash($name, $data);

    /**
     * Get the value of a given key and then forget it.
     *
     * @param string $name
     * @param mixed  $default
     */
    public function pull($name, $default);

    /**
     * Get the value of a given key.
     *
     * @param string $name
     * @param mixed  $default
     */
    public function get($name, $default);
}