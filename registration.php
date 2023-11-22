<?php
    include('temp/server.php'); //подключение базы данных к странице
    include('temp/header.php'); //подключение шапки к странице
?>

<div class="form_identification">
    <img src="img/main/identification.png" alt="identification">
    <h2><b>Авторизация</b></h2>
    <form action="" method="post">
        <input type="text" name="surname" placeholder="Фамилия" required>
        <input type="email" name="name" placeholder="Имя" required>
        <input type="email" name="patronymic" placeholder="Отчество" required>
        <input type="email" name="email" placeholder="Почта" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button>Войти</button>



    </form>
</div>








<?php
    include('temp/footer.php'); //подключение подвала к странице
?>