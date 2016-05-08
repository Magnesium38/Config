<?php namespace MagnesiumOxide\Config;

use ArrayAccess;

class Repository implements ArrayAccess {
    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Create a new configuration repository.
     *
     * @param array $items
     * @return Repository
     */
    public function __construct(array $items = []) {
        $this->items = $items;
    }

    /**
     * Determine if a given $key exists for the configuration.
     *
     * @param string $key
     * @return bool
     */
    public function has($key) {
        return array_key_exists($key, $this->items);
    }

    /**
     * Retrieve a configuration value for a given $key. Defaults to $default if $key does not exist in the config.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null) {
        return self::has($key) ? $this->items[$key] : $default;
    }

    /**
     * Set a configuration $value for the given $key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value = null) {
        if (!is_null($value)) {
            $this->items[$key] = $value;
        } else {
            unset($this->items[$key]);
        }
    }

    /**
     * Determine if a given $key exists for the configuration.
     *
     * @param string $key
     * @return bool
     */
    public function offsetExists($key) {
        return $this->has($key);
    }

    /**
     * Retrieve a configuration value for a given $key. Defaults to null if $key does not exist in the config.
     *
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key) {
        return $this->get($key);
    }

    /**
     * Set a configuration $value for the given $key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value) {
        $this->set($key, $value);
    }

    /**
     * Unset the configuration value for the given $key.
     *
     * @param string $key
     * @return void
     */
    public function offsetUnset($key) {
        $this->set($key, null);
    }
}
