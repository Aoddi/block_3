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
 * Функция для добавления атрибута id
 * @param string $path путь до стр
 */
function insertId(string $path)
{
    if (searchActivePage($path)) {
        return 'id="active"';
    }
}

/**
 * Функция вставляет ссылки в меню
 * @param $path путь
 * @return string ссылки
 */
function insertPath($path): string
{
    return isSessionExists() ? "/homework/block_3{$path}index.php" : "/homework/block_3/index.php";
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
    $sortedMenu = arraySort($array, $key, $sort);

    foreach ($sortedMenu as $item) {

        $titleMenu = checkLongSrting($item['title']);
        $activeMenuItem = insertId($item['path']);
        $pathMenuItem = insertPath($item['path']);

        $menuItems .= '<li><a href="' . $pathMenuItem . '" ' . $activeMenuItem . '>' . $titleMenu . '</a></li>';
    }

    return $menuItems;
}