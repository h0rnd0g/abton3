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


    public function getArticles()
    {
        // запрос
        $articles_raw = DB::select()
            ->from($this->_tables['auth'])
            ->execute()
            ->as_array();

        $articles = array();

        // проверка: найден ли статьи
        if ($articles_raw)
        {
            // заполняем массив материалов, создавая объекты
            foreach ($articles_raw as $raw)
            {
                $article = new DB_Object_Articles_Article(
                    $raw['id'],
                    $raw['title'],
                    $raw['preview'],
                    $raw['content'],
                    $raw['added'],
                    $raw['seo_keywords'],
                    $raw['seo_description']
                );

                // добавляем созданный объект в массив
                $articles[] = $article;
            }
        }

        // возвращаем массив материалов
        return
            $articles;
    }

    public function getArticlesByPageAndLimit($page, $limit_per_page)
    {

    }

}