<?php
/*
# Тестовое задание для направления Backend разработка
1. Создать страницу с формой. 
В форме должны быть следующие поля:
- имя
- фамилия
- email
- пароль
- повтор пароля
2. Реализовать отправку этой формы при помощи AJAX. 
3. Реализовать обработку AJAX запроса на php. 
В обработчике нужно:
1) провести валидацию 
- email содержит @
- пароли совпадают
При желании эти валидации можно также продублировать еще на клиенте (js). 
2) задать некий массив уже существующих юзеров (получать его из какой-либо базы данных не требуется). В массиве должны присутствовать поля email, id, name.
3) Провести проверку есть ли в этом массиве элемент с заполненным юзером емейлом.
4) Результат проверки должен логироваться в файл в любом формате
При успешной проверке - форма должна скрываться, а пользователю должно выводиться сообщение об успешной регистрации.
При неудачной проверке - пользователю должна выводиться ошибка над формой.
*/

define('ROOT', 'C:\\Users\\L\\Documents\\GG'); //для проверки указать свой путь до проекта

$log_path = ROOT . '\\.log';
$log_file = $log_path . "\\data.log";
if (!file_exists($log_file)) {
    mkdir($log_path);
    file_put_contents($log_file, '');
}

date_default_timezone_set('Europe/Moscow');
require_once(ROOT . '\\private\\model\\user.php');
//тестовые данные
$user1 = new User(1, "Алексей", "example@mail.ru");
$user2 = new User(2, "Иван", "test@mail.ru");
$user3 = new User(3, "Михаил", "qwerty@yandex.ru");
$user4 = new User(4, "Евгений", "start@ya.ru");

$users = [$user1, $user2, $user3, $user4];
$inputUnique = true;

//данные с клиента
$name = $_POST['regName'];
$secondName = $_POST['regSecondName'];
$email = $_POST['email'];
$passwordReg = $_POST['passwordReg'];
$rePasswordReg = $_POST['rePasswordReg'];

//log
$log = '_____________________________________________________________________________________________' . PHP_EOL;
$log .= date('Y-m-d H:i:s') . " Начало логирования в файл" . PHP_EOL;
error_log($log, 3, $log_file);
if ((User::validateEmailAddress($email)) && ($passwordReg === $rePasswordReg)) {
    $log = date('Y-m-d H:i:s') . " Валидация данных с клиента прошла успешно" . PHP_EOL;
    error_log($log, 3, $log_file);
    $newUser = new User(5, $name, $email);
    foreach ($users as $user) {
        if (($user->getName() == $newUser->getName()) || ($user->getEmail() == $newUser->getEmail())) {
            $log = date('Y-m-d H:i:s') . " ERROR.Пользователь с указанными данными уже зарегестрирован." . PHP_EOL;
            error_log($log, 3, $log_file);
            $inputUnique = false;
            break;
        }
    }
    if ($inputUnique === true) {
        $users[] = $newUser;
        $log = date('Y-m-d H:i:s') . " Регистрация прошла успешно." . PHP_EOL;
        $output = 1;
        echo $output;
        error_log($log, 3, $log_file);
    } else {
        $output = 2;
        echo $output;
        http_response_code(500);
        die();
    }
} else {
    $log = date('Y-m-d H:i:s') . " ERROR.Валидация данных с клиента прошла с ошибкой." . PHP_EOL;
    error_log($log, 3, $log_file);
    $output = 3;
    echo $output;
    http_response_code(500);
    die();
}
?>