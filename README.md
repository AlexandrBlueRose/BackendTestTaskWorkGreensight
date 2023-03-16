# Тестовое задание для направления Backend разработка для Greensight
---
## Описание
Форма регистрации с полями:
- имя
- фамилия
- email
- пароль
- повтор пароля

Валидация реализована и в js и в php по [заданию](https://greensight.notion.site/Backend-f863a6666e9f40f99f41254a1fffe450). Для валидации в js использовалась
библиотека [jQuery Validation](https://jqueryvalidation.org/).
Логика приложения организована по концепции MVC, где:
- view (index.html)
- controller (private/controller/RegistrationController.php)
- model (private/model/User.php)

Для проверки валидации на сервере, в файле script.js проставлены комментарии указывающие на валидацию, которую необходимо закомментировать(валидации пересекаются на клиенте и сервере)

---
## Установка и запуск
Для запуска используется встроенный php сервер:
````
cd ~/project
php -S localhost:8000
````
Страница авторизации: http://localhost:8000/
**В файле RegistrationController.php в 25 строке необходимо указать путь до проекта**
