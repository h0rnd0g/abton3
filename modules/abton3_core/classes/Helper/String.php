<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Helper_String
 *   Воспомогательный статический класс-хелпер по работе со строками
 */
class Helper_String
{

    /**
     * Возвращает строку, которая находится между $start_str и $end_str в базовой строке $haystack
     *
     * @param $haystack базовая строка
     * @param $start_str "открывающая" строка
     * @param $end_str "закрывающая" строка
     * @return string нужная строка "между"
     */
    public static function getStringBetween($haystack, $start_str, $end_str)
    {
        $parse_start = strpos($haystack, $start_str) + strlen($start_str);
        $parse_end = strpos($haystack, $end_str, $parse_start);

        $length = $parse_end - $parse_start;

        return
            substr($haystack, $parse_start, $length);

        // TODO: обработка исключений (если start_str или end_str не найдены)
    }

}