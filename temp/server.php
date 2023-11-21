<?php
    SESSION_START(); // Создание сессии пользователя
    $BOX_DB = new PDO("mysql:host=localhost; dbname=box", "root", "root"); // поключение базы данных через PDO