<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Mapper_Navigation
 */
class DB_Mapper_Articles extends DB_Mapper
{

    /**
     * Создаем таблицы для плагина материалов сайта
     */
    public function createTables()
    {
        // TODO: transaction

        // запрос на создание таблицы articles
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['articles']} (
                `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                `active` int(1) NOT NULL COMMENT '0 - moderating, 1 - on site',
                `title` VARCHAR(255) NOT NULL COMMENT 'title of the article',
                `preview` text NOT NULL COMMENT 'preview of the article',
                `content` text NOT NULL COMMENT 'content of the article',
                `seo_keywords` text NOT NULL DEFAULT '' COMMENT 'keywords of the page (for SEO)',
                `seo_description` text NOT NULL DEFAULT '' COMMENT 'description of the page (for SEO)',
                `added` TIMESTAMP DEFAULT now() COMMENT 'when article was created'
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();
    }

    public function getArticleByID($id, $return_raw = false, $only_active = false)
    {
        // запрос
        $query = DB::select()
            ->from($this->_tables['articles'])
            ->where('id', '=', $id);

        if ($only_active)
            $query->and_where('active', '=', 1);

        $articles_raw = $query
            ->execute()
            ->as_array();

        $article = null;

        // проверка: найден ли статьи
        if ($articles_raw)
        {
            if (!$return_raw)
            {
                // заполняем массив материалов, создавая объекты
                $article = new DB_Object_Articles_Article(
                    $articles_raw[0]['id'],
                    $articles_raw[0]['active'],
                    $articles_raw[0]['title'],
                    $articles_raw[0]['preview'],
                    $articles_raw[0]['content'],
                    $articles_raw[0]['added'],
                    $articles_raw[0]['pref'],
                    $articles_raw[0]['preview_img'],
                    $articles_raw[0]['seo_keywords'],
                    $articles_raw[0]['seo_description']
                );
            }
            else
                $article = $articles_raw[0];
        }

        // возвращаем массив материалов
        return
            $article;
    }

    public function getArticleByPref($pref, $return_raw = false, $only_active = false)
    {
        // запрос
        $query = DB::select()
            ->from($this->_tables['articles'])
            ->where('pref', '=', $pref);

        if ($only_active)
            $query->and_where('active', '=', 1);

        $articles_raw = $query
            ->execute()
            ->as_array();

        $article = null;

        // проверка: найден ли статьи
        if ($articles_raw)
        {
            if (!$return_raw)
            {
                // заполняем массив материалов, создавая объекты
                $article = new DB_Object_Articles_Article(
                    $articles_raw[0]['id'],
                    $articles_raw[0]['active'],
                    $articles_raw[0]['title'],
                    $articles_raw[0]['preview'],
                    $articles_raw[0]['content'],
                    $articles_raw[0]['added'],
                    $articles_raw[0]['pref'],
                    $articles_raw[0]['preview_img'],
                    $articles_raw[0]['seo_keywords'],
                    $articles_raw[0]['seo_description']
                );
            }
            else
                $article = $articles_raw[0];
        }

        // возвращаем массив материалов
        return
            $article;
    }

    public function getArticles($return_raw = false, $only_active = false)
    {
        // запрос
        $query = DB::select()
            ->from($this->_tables['articles']);

        if ($only_active)
            $query->where('active', '=', 1);

        $articles_raw = $query
            ->execute()
            ->as_array();

        $articles = array();

        // проверка: найден ли статьи
        if ($articles_raw)
        {
            if (!$return_raw)
            {
                // заполняем массив материалов, создавая объекты
                foreach ($articles_raw as $raw)
                {
                    $article = new DB_Object_Articles_Article(
                        $raw['id'],
                        $raw['active'],
                        $raw['title'],
                        $raw['preview'],
                        $raw['content'],
                        $raw['added'],
                        $raw['pref'],
                        $raw['preview_img'],
                        $raw['seo_keywords'],
                        $raw['seo_description']
                    );

                    // добавляем созданный объект в массив
                    $articles[] = $article;
                }
            }
            else
                $articles = $articles_raw;
        }

        // возвращаем массив материалов
        return
            $articles;
    }

    public function saveArticle(DB_Object_Articles_Article $article)
    {
        // запрос на обновление записи объекта в таблице auth
        $query = DB::update($this->_tables['articles'])
            ->set(
                array
                (
                    'title' => $article->getTitle(),
                    'active' => $article->getActive(),
                    'added' => $article->getAdded(),
                    'preview' => $article->getPreview(),
                    'content' => $article->getContent(),
                    'pref' => $article->getPref(),
                    'preview_img' => $article->getPreviewImg(),
                    'seo_description' => $article->getSEODescription(),
                    'seo_keywords' => $article->getSEOKeywords()
                )
            )
            ->where('id', '=', $article->getID());

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }


    public function changeActive($id, $active)
    {
        // запрос на обновление активности объекта в таблице auth
        $query = DB::update($this->_tables['articles'])
            ->set(
                array
                (
                    'active' => $active
                )
            )
            ->where('id', '=', $id);

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }

    public function deleteArticleByID($id)
    {
        $query = DB::delete($this->_tables['articles'])
            ->where('id', '=', $id);

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            return
                $this->parseDatabaseException($e);
        }
    }

    public function addArticle(DB_Object_Articles_Article $article)
    {
        // запрос на вставку в таблицу записи о объекте $user
        $query = DB::insert($this->_tables['articles'], array('title', 'preview', 'content', 'pref', 'preview_img', 'seo_description', 'seo_keywords', 'active'))
            ->values(
                array(
                    $article->getTitle(),
                    $article->getPreview(),
                    $article->getContent(),
                    $article->getPref(),
                    $article->getPreviewImg(),
                    $article->getSEODescription(),
                    $article->getSEOKeywords(),
                    $article->getActive()
                )
            );

        // если ID задан явно, то указываем его в запросе (иначе СУБД подставит значение по умолчанию - AUTO_INCREMENT)
        if ($article->getID() != DB_Object::PK_AUTO_INCREMENT)
            $query->set('id', $article->getID());

        // если дата задана явно, то указываем ее в запросе (иначе СУБД подставит значение по умолчанию - NOW() )
        if ($article->getAdded() != DB_Object::TIMESTAMP_NOW)
            $query->set('added', $article->getAdded());

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }


    public function getArticlesByPageAndLimit($page, $limit_per_page)
    {

    }

}