<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Articles
 *   Плагин материалов
 */
class Controller_Plugin_Articles extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'index' => array(
                    'icon' => 'file',
                    'path' => '',
                ),
            );
    }

    public function action_ajax()
    {
        parent::action_ajax();

        try
        {
            $success_data = array();
            $type = $this->request->post('type');

            if ($type == 'get_articles')
            {
                $articles = DB_Model_Articles::get()->getMapperInstance()->getArticles(true);
                $success_data['articles'] = $articles;
            }
            elseif ($type == 'edit_article')
            {
                // читаем данные из запроса
                $id = $this->request->post('article_id');
                $active = $this->request->post('active');
                $title = $this->request->post('title');
                $preview = $this->request->post('preview');
                $content = $this->request->post('content');
                $pref = $this->request->post('pref');
                $preview_img = $this->request->post('preview_img');
                $added = $this->request->post('added');
                $seo_description = $this->request->post('seo_description');
                $seo_keywords = $this->request->post('seo_keywords');

                // парсинг
                $active = ($active === '1') ? 1 : 0;

                // создаем объект
                $article = new DB_Object_Articles_Article($id, $active, $title, $preview, $content, $added, $pref, $preview_img, $seo_keywords, $seo_description);

                // записываем его
                DB_Model_Articles::get()->getMapperInstance()->saveArticle($article);
            }
            elseif ($type == 'change_article_status')
            {
                // читаем данные из запроса
                $id = $this->request->post('article_id');
                $active = $this->request->post('active');

                // парсинг
                $active = ($active === '1') ? 1 : 0;

                // меняем активность материала
                DB_Model_Articles::get()->getMapperInstance()->changeActive($id, $active);
            }
            elseif ($type == 'delete_article')
            {
                // читаем данные из запроса
                $id = $this->request->post('article_id');

                // удаляем статью
                DB_Model_Articles::get()->getMapperInstance()->deleteArticleByID($id);
            }
            elseif ($type == 'add_article')
            {
                // читаем данные из запроса
                $title = $this->request->post('title');
                $preview = $this->request->post('preview');
                $content = $this->request->post('content');
                $pref = $this->request->post('pref');
                $preview_img = $this->request->post('preview_img');
                $seo_description = $this->request->post('seo_description');
                $seo_keywords = $this->request->post('seo_keywords');

                // создаем объект и добавляем его
                $article = new DB_Object_Articles_Article(
                    DB_Object::PK_AUTO_INCREMENT,
                    0,
                    $title,
                    $preview,
                    $content,
                    DB_Object::TIMESTAMP_NOW,
                    $pref,
                    $preview_img,
                    $seo_keywords,
                    $seo_description
                );

                DB_Model_Articles::get()->getMapperInstance()->addArticle($article);
            }

            Instance_Security::get()->ajaxResponse(true, $success_data);
        }
        catch (Exception $e)
        {
            Instance_Security::get()->ajaxResponse(false);
        }
    }

    public function formJsAndCSS()
    {
        // подключаем CK Editor
        $this->script('/assets/plugins/ckeditor/ckeditor.js');

        // elFinder
        $this->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js');
        $this->script('/assets/plugins/elfinder/js/elfinder.min.js');
        //$this->script('/assets/plugins/elfinder/js/jquery.dialogelfinder.js');
        $this->style('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css');
        $this->style('/assets/plugins/elfinder/css/elfinder.min.css');
        $this->style('/assets/plugins/elfinder/css/theme.css');

        // подключаем Filepicker
        $this->script('/assets/plugins/filepicker-master/js/jquery.filepicker.js');
        $this->style('/assets/plugins/filepicker-master/css/jquery.filepicker.css');
    }

    // базовый метод
    public function action_index()
    {
        $view = View::factory('articles/list');

        //$articles = DB_Model_Articles::get()->getMapperInstance()->getArticles();
        //$view->articles = $articles;

        $this->template->content = $view;
    }

}