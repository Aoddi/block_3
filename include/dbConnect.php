<?php
function connect()
{
    static $connection = null;

    if ($connection === null) {
        $connection = mysqli_connect('mysqldb', 'dev', 'dev', 'dev') or die('connection Error');
        mysqli_set_charset($connection, 'utf8');
    }

    return $connection;
}

/**
 * Функция для получения кортежа по логину
 * @param string $login введенный пользователем
 * @return найденный пароль
 */
function getTupleByLogin(string $login)
{
    $result = mysqli_query(connect(), "SELECT * FROM users WHERE email = '$login'");
    return mysqli_fetch_assoc($result);
}

/**
 * Функция для проверки пароля пользователя
 * @param string $login введенный пользователем
 * @param string $password введенный пользователем 
 * @return bool (true/false) соответсвует ли пароль хешу
 */
function passwordVerification(string $login, string $password): bool
{
    $passwordHash = getTupleByLogin($login)['password'];
    return password_verify($password, $passwordHash);
}

/**
 * Функция для получения id активного пользователя
 * @param string $login активного пользователя
 * @return id пользователя
 */
function getIdActiveUser(string $login)
{
    return getTupleByLogin($login)['id'];
}

/**
 * В таблице users меняет значение activity_flag 1
 */
function activeUser(int $id)
{
    mysqli_query(connect(), "UPDATE users SET activity_flag = 1 WHERE id = $id");
}

/**
 * В таблице users меняет значение activity_flag на 0
 */
function inactiveUser(int $id)
{
    mysqli_query(connect(), "UPDATE users SET activity_flag = 0 WHERE id = $id");
}

/**
 * Функция для поиска кортежа по id
 * @param int $id пользователя 
 * @return array кортеж с информацией о пользователе
 */
function getTuple(int $id): array
{
    $result = mysqli_query(connect(), "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
}

/**
 * Функция для получения значения activity_flag
 * @param int $id пользователя
 * @return значение activity_flag
 */
function getActivityFlag(int $id)
{
    return getTuple($id)['activity_flag'];
}

/**
 * Функция для получения значения full_name
 * @param int $id пользователя
 * @return значение full_name
 */
function getFullName(int $id)
{
    return getTuple($id)['full_name'];
}

/**
 * Функция для получения значения email
 * @param int $id пользователя
 * @return значение email
 */
function getEmail(int $id)
{
    return getTuple($id)['email'];
}

/**
 * Функция для получения значения phone
 * @param int $id пользователя
 * @return значение phone
 */
function getPhone(int $id)
{
    return getTuple($id)['phone'];
}

/**
 * Функция для получения значения email_notifications_flag
 * @param int $id пользователя
 * @return значение email_notifications_flag
 */
function getFlagNotifications(int $id)
{
    return getTuple($id)['email_notifications_flag'];
}


/**
 * Функция для получения групп связанных с пользователем
 * @param int $id пользователя 
 * @return названия и описания групп
 */
function getGroups(int $id)
{
    $result = [];

    $query = mysqli_query(
        connect(),
        "SELECT gr.id, gr.name, gr.description FROM users AS u
        LEFT JOIN group_user AS gu ON u.id = gu.user_id
        LEFT JOIN groups as gr ON gu.group_id = gr.id
        WHERE u.id = $id"
    );

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}

/**
 * Функция для получения массива с сообщениями
 * @param int $id активного пользователя
 * @param int $flag READ/UNREAD message
 * @return массив с заголовками сообщений, с названиями и цветами раздела
 */
function getMessagesList(int $id, int $flag)
{
    $query = mysqli_query(
        connect(),
        "SELECT m.id, m.header, s.name, c.hex FROM messages AS m
        LEFT JOIN users AS u ON m.recipient_id = u.id
        LEFT JOIN sections AS s ON m.section_id = s.id
        LEFT JOIN colors AS c ON s.color_id = c.id
        WHERE m.recipient_id = $id AND m.read_message_flag = $flag"
    );

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}

/**
 * Функция для получения массива с блоками из бд
 * @param int $id активного пользователя
 * @return массив с блоками
 */
function getSections(int $id)
{
    $query = mysqli_query(connect(), "SELECT s.id, s.parent_id, s.name FROM sections AS s WHERE user_id = $id");

    while ($row = mysqli_fetch_assoc($query)) {
        $sections[] = $row;
    }

    return $sections;
}

/**
 * Функция для получения данных из таблицы colors
 * @return айди и название цвета
 */
function getColors()
{
    $query = mysqli_query(connect(), "SELECT c.id, c.color FROM colors AS c");

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}

function getUsersModerated()
{
    $query = mysqli_query(
        connect(),
        "SELECT u.id, u.full_name as name FROM group_user AS gu
        LEFT JOIN users AS u ON gu.user_id = u.id
        WHERE gu.group_id = 2"
    );

    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    return $result;
}

function getMessage(int $id)
{
    $result = mysqli_query(
        connect(),
        "SELECT m.id, m.header, m.datetime, u.full_name, m.read_message_flag, u.email, m.text 
        FROM messages AS m
        LEFT JOIN users AS u ON m.sender_id = u.id
        WHERE m.id = $id"
    );
    return mysqli_fetch_assoc($result);
}