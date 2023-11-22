<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Боксерский клуб</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/main/icon.png">
</head>
<body>
    <header>
        <div class = "header">
            <a href="index">
                <img src="img/main/logo.png" alt="logo" class = "header_logo">
            </a>
        </div>
        <div class = "header_nav">
            <div class="nav">
                <a href="index">Новости</a>
                <a href="schedule">Расписание</a>
                <a href="coach">Наши тренера</a>
                <a href="boxer">Наша гордость</a>
                <a href="club">О клубе</a>
            </div>    
            <div class="identification">
                <?php if($_SESSION['id']){ // проверка на авторизированость пользователя ?>

                <a href="logout">Выйти</a>

                <?php } else{ ?>

                <a href="authorization">Войти</a>
                <a href="registration">Зарегистрироваться</a>

                <?php } ?>
            </div>
        </div>
    </header>
<div class="main_content">    
