<?php defined('SYSPATH') or die('No direct script access.');

// -- Файл языковых констант для плагина Articles -------------------------------

return
    array
    (
        'ua' => array(
            'title' => 'Управління статтями',

            'index' => 'Управління статтями',
                'articles_table_name' => 'Список статей',
                    'articles_field_title' => 'Заголовок',
                    'articles_field_title_placeholder' => 'Заголовок статті, відображатиметься на сайті',
                    'articles_field_date' => 'Дата створення',
                    'articles_field_preview' => 'Анонс',
                    'articles_field_preview_img' => 'Зображення',
                    'articles_field_pref' => 'Адресна назва',
                    'articles_field_content' => 'Вміст',
                    'articles_field_seo_keywords' => 'Ключові слова (SEO)',
                    'articles_field_seo_description' => 'Опис (SEO)',
                    'articles_field_status' => 'Статус',
                        'articles_status_published' => 'На сайті',
                        'articles_status_moderating' => 'Модерується',
                    'articles_field_controls' => 'Управління',
                        'articles_controls_edit' => 'редаг.',
                        'articles_controls_delete' => 'видал.',
                        'articles_controls_hide' => 'на модерацію',
                        'articles_controls_publish' => 'на cайт',

                    'articles_table_empty' => 'Список матеріалів порожній',

                    'articles_modal_edit_title' => 'Редагувати статтю',
                    'articles_modal_delete_title' => 'Видалити статтю',
                        'articles_modal_delete_body' => 'Стаття <a href="javascript:;" class="article_title"></a> буде видалена без можливості відновлення. Ви впевнені, що бажаєте видалити її?<p><br><i>Ви можете тимчасово прибрати статтю з сайту, зробивши її неактивною (відправивши на модерацію)</i>',

                'articles_form_add_title' => 'Додати статтю',
                    'articles_form_add' => 'Додати',
                    'articles_form_clear' => 'Очистити',

                'articles_msg_added' => 'Успіх!',
                'articles_msg_added_body' => 'Нову статтю успішно додано',

                'articles_msg_error' => 'Помилка!',
                'articles_msg_error_body' => 'Не вдалось виконати операцію',

        ),
    );