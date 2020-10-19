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
        echo '<li><a href="' . '/skillbox/homework/block_3' . $item['path'] . 'index.php' . '">' . $item['title'] . '</a></li>';
    }
}

// function showTitle(array $array, string $line)
// {
//     $str = (strstr($line, '/route/') . '/');

//     foreach ($array as $item) {
//         if ($item['path'] == $str) {
//             return ($item['title']);
//         }
//     }

// }