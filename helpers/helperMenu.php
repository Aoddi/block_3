<?php

namespace helperMenu;

/**
 * Функция для сортировки пунктов меню
 * @param входной массив, для сортировки
 * @param ключ элементов этого массива, по которому будет осуществлена сортировка
 * @param направление сортировки по возрастанию/по убыванию (SORT_ASC/SORT_DESC)
 * @return отсортированный массив
 */
function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    array_multisort(array_column($array, $key), $sort, $array);
    return $array;
}

/**
 * Функция для вывода меню разделов в шапке и футере
 * @param строка
 * @param длина строки
 * @param конец строки
 * @return обрезанную строку с троеточием в конце
 */
function cutString(string $line, int $length = 12, string $appends = '...'): string
{
    return mb_substr($line, 0, $length) . $appends;
}

/**
 * @param входной массив
 * @param ключ элемента этого массива
 * @return обрезанную строку с троеточием в конце
 */
function checkLongSrting(array $item, string $key = 'title'): string
{
    if (mb_strlen($item[$key]) >= 15) {
        $item[$key] = cutString($item[$key]);
    }

    return $item[$key];
}

/**
 * @param входной массив
 * @return массив с данными активной страницы
 */
function searchActivePage(array $item)
{
    if (strstr($_SERVER['REQUEST_URI'], '/route/') === $item['path'] . 'index.php') {
        return true;
    }
}

/**
 * @param входной массив
 * @return заголовок активной вкладки
 */
function showTitle(array $array): string
{
    foreach ($array as $item) {
        if (searchActivePage($item)) {
            return $item['title'];
        }
    }
}

/**
 * Функция для вывода меню разделов в шапке и футере
 * @param входной массив, для сортировки
 * @param ключ элементов этого массива, по которому будет осуществлена сортировка
 * @param направление сортировки по возрастанию/по убыванию (SORT_ASC/SORT_DESC)
 */
function showMenu(array $array, string $key = 'sort', $sort = SORT_ASC)
{
    $arr = arraySort($array, $key, $sort);

    foreach ($arr as $item) {

        $item['title'] = checkLongSrting($item);

        if (searchActivePage($item)) {
            echo '<li><a href="' . '/skillbox/homework/block_3' . $item['path'] . 'index.php' . '" id="active">' . $item['title'] . '</a></li>';
        } else {
            echo '<li><a href="' . '/skillbox/homework/block_3' . $item['path'] . 'index.php' . '">' . $item['title'] . '</a></li>';
        }
    }
}