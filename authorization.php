<?php
    include('temp/server.php'); //подключение базы данных к странице

    if(!empty($_SESSION['role'])){ // запрет заходить на эту страницу авторизированому пользователю
        header('Location: index');
    }
    
    include('temp/header.php'); //подключение шапки к странице
?>

<div class="form_identification">
    <img src="img/main/identification.png" alt="identification">
    <h2><b>Авторизация</b></h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Почта" required class="identification_input">
        <input type="password" name="password" placeholder="Пароль" required class="identification_input">
        <button>Войти</button>


    <?php 
        if(!empty($_POST['email']) && !empty($_POST['password'])){

            $email = strtolower(htmlspecialchars($_POST['email'])); //преобразование спецальных тегов html и преводит в нижний регистр
    
            $push = $BOX_DB->query('SELECT id_user, role.name, password FROM `users` JOIN role on role.id_role = users.id_role WHERE email = "'.$email.'"');  //запрос через PDO, который узнаёт какой пароль у этого логина и его роль
            $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
            $row = $push->fetch(); // возрат данных в ввиде асоциативного массива
            
                if(password_verify($_POST['password'], $row['password'])){ //сравнение введеного пароля и полученого

                    $_SESSION['id'] = $row['id_user']; 
                    $_SESSION['role'] = $row['name']; 
                   
                   echo "<script>window.location.href='index'</script>"; // сприпт переадресовывающий на главную страницу
                }
                else{
                    echo "<p class='error'>Неверный логин или пароль.</p>"; // сообщение о некоректный данных
                }
        }

    ?>


</form>
</div>

<?php
    include('temp/footer.php'); //подключение подвала к странице
?>