<?php

/**
 * Функция для сортировки пунктов меню
 * @param array $array входной массив, для сортировки
 * @param string $key ключ элементов этого массива, по которому будет осуществлена сортировка
 * @param $sort направление сортировки по возрастанию/по убыванию (SORT_ASC/SORT_DESC)
 * @return array отсортированный массив
 */
function arraySort(array $array, string $key = 'sort', $sort = SORT_ASC): array
{
    usort($array, function ($a, $b) use ($key, $sort) {
        return ($sort == SORT_ASC) ? $a[$key] <=> $b[$key] : $b[$key] <=> $a[$key];
    });

    return $array;
}

/**
 * Функция для вывода меню разделов в шапке и футере
 * @param string $line строка
 * @param int $length длина строки
 * @param string $appends конец строки
 * @return string обрезанную строку с троеточием в конце
 */
function cutString(string $line, int $length = 12, string $appends = '...'): string
{
    return mb_substr($line, 0, $length) . $appends;
}

/**
 * @param string $string заголовка меню
 * @return string обрезанную строку с троеточием в конце
 */
function checkLongSrting(string $string): string
{

    if (mb_strlen($string) >= 15) {
        $string = cutString($string);
    }

    return $string;
}

/**
 * @param string $string входная строка для проверки активной страницы 
 * @return bool (true/false)
 */
function searchActivePage(string $string): bool
{
    return strstr($_SERVER['REQUEST_URI'], '/route/') === $string . 'index.php';
}

/**
 * @param array $array входной массив
 * @return string заголовок активной вкладки
 */
function showTitle(array $array): string
{
    foreach ($array as $item) {
        if (searchActivePage($item['path'])) {
            return $item['title'];
        }
    }
}

/**
 * Функция для вывода меню разделов в шапке и футере
 * @param array $array входной массив, для сортировки
 * @param string $key ключ элементов этого массива, по которому будет осуществлена сортировка
 * @param $sort флаг направление сортировки по возрастанию/по убыванию (SORT_ASC/SORT_DESC)
 * @return string с элементами меню
 */
function showMenu(array $array, string $key = 'sort', $sort = SORT_ASC): string
{
    $menuItems = '';
    $arr = arraySort($array, $key, $sort);

    foreach ($arr as $item) {

        $item['title'] = checkLongSrting($item['title']);

        if (searchActivePage($item['path'])) {
            $menuItems .= '<li><a href="' . '/skillbox/homework/block_3' . $item['path'] . 'index.php' . '" id="active">' . $item['title'] . '</a></li>';
        } else {
            $menuItems .= '<li><a href="' . '/skillbox/homework/block_3' . $item['path'] . 'index.php' . '">' . $item['title'] . '</a></li>';
        }
    }

    return $menuItems;
}
