<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Object
 */
abstract class Data_Object {

    protected $fields = array();

    final function __get($property)
    {
        if (array_key_exists($property, $this->fields))
        {
            $method = "get{$property}";

            if (method_exists($this, $method))
                return $this->$method($this->fields[$property]);
            else
                return $this->fields[$property];
        }
    }

    final function __set($property, $value)
    {
        $method = "set{$property}";

        if (method_exists($this, $method))
            return $this->$method($value);
    }

    final function __isset($property)
    {
        return (array_key_exists($property, $this->fields) and ($this->fields[$property] !== null));
    }

    protected function initFields()
    {
        $this->fields['id'] = null;
    }

    final public function formRawFields()
    {
        $fields = array();
        foreach ($this->fields as $key => $value)
            if ($value !== null)
                $fields[$key] = $this->$key;

        return $fields;
    }

    final public function formRawKeys()
    {
        $keys = array();
        foreach ($this->fields as $key => $value)
            if ($value !== null)
                $keys[] = $key;

        return $keys;
    }

    final public function formRawValues()
    {
        $values = array();
        foreach ($this->fields as $key => $value)
            if ($value !== null)
                $values[] = $this->$key;

        return $values;
    }

    public static function create(array $values = array())
    {
        return (new static($values));
    }

    protected function __construct(array $values = array())
    {
        static::initFields();

        foreach ($values as $key => $value)
            $this->$key = $value;
    }

}