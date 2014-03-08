<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Object_User_Auth
 */
class DB_Object_Articles_Article extends DB_Object
{

    protected $_active;
    protected $_title;
    protected $_preview;
    protected $_preview_img;
    protected $_pref;
    protected $_content;
    protected $_seo_keywords;
    protected $_seo_description;
    protected $_added;

    /*
     * Get & Set
     */

    public function getPreviewImg()
    {
        return
            $this->_preview_img;
    }

    public function setPreviewImg($img)
    {
        $this->_preview_img = $img;
    }

    public function getPref()
    {
        return
            $this->_pref;
    }

    public function setPref($pref)
    {
        $this->_pref = $pref;
    }

    public function getActive()
    {
        return
            $this->_active;
    }

    public function setActive($active)
    {
        $this->_active = ($active) ? 1 : 0;
    }

    public function getTitle()
    {
        return
            $this->_title;
    }

    public function setTitle($title)
    {
        $screened = Instance_Security::get()->screenString($title);
        $result = Instance_Security::get()->specialChars($screened);

        $this->_title = $result;
    }

    public function getPreview()
    {
        return
            $this->_preview;
    }

    public function setPreview($preview)
    {
        $this->_preview = Instance_Security::get()->specialChars($preview);
    }

    public function getContent()
    {
        return
            $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = Instance_Security::get()->specialChars($content);
    }

    public function getSEOKeywords()
    {
        return
            $this->_seo_keywords;
    }

    public function setSEOKeywords($keywords)
    {
        $screened = Instance_Security::get()->screenString($keywords);
        $result = Instance_Security::get()->specialChars($screened);

        $this->_seo_keywords = $result;
    }

    public function getSEODescription()
    {
        return
            $this->_seo_description;
    }

    public function setSEODescription($description)
    {
        $screened = Instance_Security::get()->screenString($description);
        $result = Instance_Security::get()->specialChars($screened);

        $this->_seo_description = $result;
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


    function __construct($id, $active, $title, $preview, $content, $added, $pref, $preview_img, $seo_keywords = '', $seo_description = '')
    {
        // инциализация
        $this->_active = $active;
        $this->_title = $title;
        $this->_preview = $preview;
        $this->_content = $content;
        $this->_added = $added;
        $this->_preview_img = $preview_img;
        $this->_pref = $pref;
        $this->_seo_keywords = $seo_keywords;
        $this->_seo_description = $seo_description;

        // вызываем конструктор предка
        parent::__construct($id);
    }


}