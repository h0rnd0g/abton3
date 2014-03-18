<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Model
 */
class Data_Model extends Data_Base {

    /**
     * @var Data_Mapper|null
     */
    protected $mapper = null;

    public function getMapper()
    {
        return $this->mapper;
    }

    public function install()
    {
        $this->mapper->install();

        return
            $this;
    }

    public function uninstall()
    {
        $this->mapper->uninstall();

        return
            $this;
    }

    public function __construct(Data_Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

}