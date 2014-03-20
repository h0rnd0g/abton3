<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Object
 *   базовый класс представления всех записей БД как объектов
 */
abstract class Data_Object {

    /**
     * @var array поля, которые хранятся в БД непосредственно (ключ => значение)
     */
    protected $fields = array();

    /**
     * Для реализации доступа к полям объекта
     *
     * @param $property
     * @return mixed
     */
    function __get($property)
    {
        $method = "get{$property}";

        if (method_exists($this, $method))
            return
                $this->$method();
        elseif (array_key_exists($property, $this->fields))
            return
                $this->fields[strtolower($property)];
    }

    /**
     * Для реализации доступа к полям объекта
     *
     * @param $property
     * @param $value
     * @return mixed
     */
    function __set($property, $value)
    {
        $method = "set{$property}";

        if (method_exists($this, $method))
            return
                $this->$method($value);
        else
            $this->fields[strtolower($property)] = $value;
    }

    /**
     * Для реализации проверки на заданность поля в объекте
     *
     * @param $property
     * @return bool
     */
    final function __isset($property)
    {
        $method = "get{$property}";

        // сначала проверяем существует ли метод, который может вернуть нам значение поля
        if (method_exists($this, $method))
            // если да, то поле существует в случае, когда этот метод не возвращает null
            return
                ($this->$method() !== null);

        /* иначе поле существует только в том случае, когда существует соответствующий ключ в массиве $fields
           и значение по этому ключу не равно null
        */
        return
            (array_key_exists($property, $this->fields) and ($this->fields[$property] !== null));
    }

    /**
     * Инициализируем стартовые поля объекта
     */
    protected function initFields()
    {
        $this->fields['id'] = null;
    }

    /**
     * @return array ассоциативный массив значений всех полей объекта
     */
    final public function formRawFields()
    {
        $fields = array();
        foreach ($this->fields as $key => $value)
            if (($value !== null) and (!is_object($value)))
                $fields[$key] = $this->$key;

        return
            $fields;
    }

    /**
     * @return array массив всех ключей полей объекта
     */
    final public function formRawKeys()
    {
        $keys = array();
        foreach ($this->fields as $key => $value)
            if (($value !== null) and (!is_object($value)))
                $keys[] = $key;

        return
            $keys;
    }

    /**
     * ВАЖНО! Отличие от formRawFields() в том, что здесь возвращаемый массив не является ассоциативным
     * Порядок следование значений соответствует порядку следования ключей, который возвращает formRawKeys()
     *
     * @return array массив значений всех полей объекта
     */
    final public function formRawValues()
    {
        $values = array();
        foreach ($this->fields as $key => $value)
            if (($value !== null) and (!is_object($value)))
                $values[] = $this->$key;

        return
            $values;
    }

    /**
     * Оболочка над конструктором
     *
     * @param array $values ассоциативный массив "поле => значение" для объекта
     * @return static
     */
    public static function create(array $values = array())
    {
        return
            (new static($values));
    }

    /**
     * @param array $values ассоциативный массив "поле => значение" для объекта
     */
    protected function __construct(array $values = array())
    {
        static::initFields();

        foreach ($values as $key => $value)
            $this->$key = $value;
    }

}