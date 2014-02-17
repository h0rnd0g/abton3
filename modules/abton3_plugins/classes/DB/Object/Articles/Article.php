<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Object_User_Auth
 */
class DB_Object_Articles_Article extends DB_Object
{

    protected $_title;
    protected $_preview;
    protected $_content;
    protected $_seo_keywords;
    protected $_seo_description;
    protected $_added;

    /*
     * Get & Set
     */

    public function getTitle()
    {
        return
            $this->_title;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function getPreview()
    {
        return
            $this->_preview;
    }

    public function setPreview($preview)
    {
        $this->_preview = $preview;
    }

    public function getContent()
    {
        return
            $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }

    public function getSEOKeywords()
    {
        return
            $this->_seo_keywords;
    }

    public function setSEOKeywords($keywords)
    {
        $this->_seo_keywords = $keywords;
    }

    public function getSEODescription()
    {
        return
            $this->_seo_description;
    }

    public function setSEODescription($description)
    {
        $this->_seo_description = $description;
    }

    public function getAdded()
    {
        return
            $this->_added;
    }

    public function setAdded($added)
    {
        $this->_added = $added;
    }





    function __construct($id, $title, $preview, $content, $added, $seo_keywords = '', $seo_description = '')
    {
        // инциализация
        $this->_title = $title;
        $this->_preview = $preview;
        $this->_content = $content;
        $this->_added = $added;
        $this->_seo_keywords = $seo_keywords;
        $this->_seo_description = $seo_description;

        // вызываем конструктор предка
        parent::__construct($id);
    }


}