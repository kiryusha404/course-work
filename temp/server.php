<?php
    SESSION_START(); // Создание сессии пользователя
    $BOX_DB = new PDO("mysql:host=localhost; dbname=box", "root", "root"); // поключение базы данных через PDO
    date_default_timezone_set('Europe/Samara'); // смена часового пояса на +4