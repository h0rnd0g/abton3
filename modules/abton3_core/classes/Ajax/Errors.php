<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Ajax_Errors
 *   Класс-обработчик ошибок при ajax-запросах
 */

class Ajax_Errors {

    private $_errors = array();

    /*
     * Get & Set
     */
    public function getErrors()
    {
        return
            $this->_errors;
    }


    /**
     * Добавляем новую ошибку
     *
     * @param $error название ошибки
     * @param array $params массив характеристик ошибки (не обязательно)
     */
    public function addError($error, $params = array())
    {
        $this->_errors[] = array(
            'name' => $error,
            'params' => $params
        );
    }


    /**
     * @return bool есть ли ошибки
     */
    public function haveErrors()
    {
        return
            count($this->_errors) > 0;
    }

}