<?php

namespace MX\Base;

class Model implements /*\ArrayAccess,*/ \Countable, \IteratorAggregate
{
    /**
     * Internal attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Constructor
     *
     * Initializes internal attributes with given array
     *
     * @param  array  $attributes (optional)
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Countable
     *
     * @return integer Number of attributes
     */
    public function count()
    {
        return count($this->attributes);
    }

    /**
     * This is needed by \IteratorAggregate abstract
     * It allows to use foreach
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->attributes, 1);
    }

    // /**
    //  * Returns the value at specified offset
    //  *
    //  * @param string The offset to retrieve
    //  * @return mixed
    //  * @abstracting ArrayAccess
    //  */
    // public function offsetGet($offset)
    // {
    //     return $this->offsetExists($offset) ? $this->attributes[$offset] : null;
    // }

    // /**
    //  * Assigns a value to the specified offset
    //  *
    //  * @param string The offset to assign the value to
    //  * @param mixed  The value to set
    //  * @abstracting ArrayAccess
    //  */
    // public function offsetSet($offset, $value) {
    //     $this->data[$offset] = $value;
    // }

    // /**
    //  * Whether or not an offset exists
    //  *
    //  * @param string An offset to check for
    //  * @access public
    //  * @return boolean
    //  * @abstracting ArrayAccess
    //  */
    // public function offsetExists($offset) {
    //     return isset($this->data[$offset]);
    // }

    // /**
    //  * Unsets an offset
    //  *
    //  * @param string The offset to unset
    //  * @access public
    //  * @abstracting ArrayAccess
    //  */
    // public function offsetUnset($offset) {
    //     if ($this->offsetExists($offset)) {
    //         unset($this->data[$offset]);
    //     }
    // }

    /**
     * Get an attribute by key
     *
     * @param  string  $key
     * @return mixed   $value
     */
    public function __get($key)
    {
        if (array_key_exists($key, get_object_vars($this))) {
            return $this->$key;
        }

        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * Set an attribute by key
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set($key, $value)
    {
        if (array_key_exists($key, get_object_vars($this))) {
            throw new \Exception("Can\'t set value ($value) to read only property ($key).");
        }

        $this->attributes[$key] = $value;
    }

    /**
     * Return isset for an attribute by key
     *
     * @param  string  $key
     */
    public function __isset($key)
    {
        if (array_key_exists($key, get_object_vars($this))) {
            return isset($this->$key);
        }

        return isset($this->attributes[$key]);
    }

    /**
     * Unset an attribute by key
     *
     * @param  string  $key
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
}
