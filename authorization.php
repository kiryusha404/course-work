<?php
    include('temp/server.php'); //подключение базы данных к странице
    include('temp/header.php'); //подключение шапки к странице
?>

<div class="form_identification">
    <img src="img/main/identification.png" alt="identification">
    <h2><b>Авторизация</b></h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Почта" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button>Войти</button>


    <?php 
        if(!empty($_POST['email']) && !empty($_POST['password'])){

            $email = htmlspecialchars($_POST['email']); //преобразование спецальных тегов html
    
            $push = $BOX_DB->query('SELECT * FROM `users` WHERE email = "'.$email.'"');  //запрос через PDO, который узнаёт какой пароль у этого логина
            $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
            $row = $push->fetch(); // возрат данных в ввиде асоциативного массива

            echo $row['password'];
            
                if(password_verify($_POST['password'], $row['password'])){ //сравнение введеного пароля и полученого

                    $_SESSION['id'] = $row['id_user']; 

                    $push = $BOX_DB->query('SELECT * FROM `role` WHERE id_role = "'.$row['id_role'].'"');  //запрос через PDO, который узнаёт какой пароль у этого логина
                    $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
                    $row = $push->fetch(); // возрат данных в ввиде асоциативного массива

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