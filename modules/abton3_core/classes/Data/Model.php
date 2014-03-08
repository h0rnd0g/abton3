<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Model
 */
class Data_Model {

    protected $mapper = null;

    public static function create(Data_Mapper $mapper)
    {
        return (new static($mapper));
    }

    protected function __construct(Data_Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getMapper()
    {
        return $this->mapper;
    }

}