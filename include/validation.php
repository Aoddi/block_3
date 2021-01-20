<?php

$header = $_POST['message_header'];
$text = $_POST['message_text'];
$user = $_POST['message_users'];
$section = $_POST['message_section'];
$color = $_POST['section_color'];
$activeUser = $_SESSION['idActiveUser'];


function clean($value = "")
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

$header = clean($header);
$text = clean($text);

function checkLength($value = "", $max)
{
    $result = mb_strlen($value) > $max;
    return $result;
}

if (isset($_POST['message'])) {
    if (empty($header)) {
        $result['header'] = 'Это поле пустое. Введите заголовок';
    }

    if (checkLength($header, 15)) {
        $result['header'] = 'Введите меньше символов';
    }

    if (empty($text)) {
        $result['text'] = 'Это поле пустое. Введите заголовок';
    }

    if (checkLength($header, 255)) {
        $result['text'] = 'Введите меньше символов';
    }

    if (empty($result)) {
        mysqli_query(
            connect(),
            "INSERT INTO messages SET
            text = '$text', 
            header = '$header', 
            datetime = now(), 
            read_message_flag = 0,
            section_id = '$section',
            sender_id = '$activeUser',
            recipient_id = '$user'"
        );

        mysqli_query(connect(), "UPDATE sections SET color_id = $color WHERE id = $section");
    }
}
