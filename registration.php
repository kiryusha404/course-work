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
        <input type="text" name="surname" placeholder="Фамилия" required class="identification_input">
        <input type="text" name="name" placeholder="Имя" required class="identification_input">
        <input type="text" name="patronymic" placeholder="Отчество" required class="identification_input">
        <input type="email" name="email" placeholder="Почта" required class="identification_input">
        <input type="password" name="password" placeholder="Пароль" required class="identification_input">
        <input type="password" name="password2" placeholder="Повторите пароль" required class="identification_input">
        <div class="checkbox">
            <input type="checkbox" id="check" name="check" required>
            <p>Я соглашаюсь с <a href="user_conditions">пользовательскими условтями</a></p>
        </div>
        <button>Войти</button>

        <?php
            function registration($surname, $name, $patronymic, $email, $password, $password2, $db) { // функция осуществляющая валидацию
                
                if(!preg_match("/^[а-яА-ЯёЁ\-]+$/iu", $surname) ) { // проверка на наличие лишних символов у фамилии
                    return "<p class='error'>Недопустимый формат фамилии.</p>"; 
                }

                if(!preg_match("/^[а-яА-ЯёЁ\-]+$/iu", $name) ) { // проверка на наличие лишних символов у имени
                    return "<p class='error'>Недопустимая недопустимый формат имени.</p>"; 
                }
                
                if(!preg_match("/^[а-яА-ЯёЁ\-]+$/iu", $patronymic) ) { // проверка на наличие лишних символов у отчества
                    return "<p class='error'>Недопустимая недопустимый формат отчества.</p>"; 
                }                

                if(!preg_match("/^[a-zA-Z0-9\'\-\#\@\%\&\/\.\_]+$/i", $email) ) { // проверка на наличие лишних символов у почты
                    return "<p class='error'>Недопустимая недопустимый формат почты.</p>"; 
                }   

                $email = strtolower(htmlspecialchars($email)); //преобразование спецальных тегов html и преводит в нижний регистр

                $push = $db->query('SELECT email FROM `users` WHERE email = "'.$email.'"');  //запрос через PDO, который узнаёт есть ли такой емаил
                $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
                $row = $push->fetch(); // возрат данных в ввиде асоциативного массива

                if($email == $row['email']){ // проверка на уникальность почты
                    return "<p class='error'>Аккаунт с такой почтой уже существует.</p>"; 
                }

                if(strlen ($password) < 6) { // проверка на соотвествии длины пароля
                    return "<p class='error'>Пароль может содержать минимум 6 символов.</p>"; 
                } 

                if($password != $password2) { // сравнение паролев
                    return "<p class='error'>Пароли не совпадают.</p>"; 
                } 

                $surname = htmlspecialchars($surname); //преобразование спецальный символов
                $name = htmlspecialchars($name); //преобразование спецальный символов
                $patronymic = htmlspecialchars($patronymic); //преобразование спецальный символов
                $password = password_hash($password, PASSWORD_DEFAULT); //хэширование пароля

                $push = $db->prepare('INSERT INTO `users` (`id_user`, `surname`, `name`, `patronymic`, `email`, `password`, `id_role`) VALUES (NULL, "'.$surname.'", "'.$name.'", "'.$patronymic.'", "'.$email.'", "'.$password.'", "1");');  //апрос без возрата результата
                $push->execute(); // выполнение запроса

                $push = $db->query('SELECT * FROM `users` WHERE email = "'.$email.'"');  //запрос через PDO, который узнаёт какой пароль у этого логина
                $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
                $row = $push->fetch(); // возрат данных в ввиде асоциативного массива

                $_SESSION['id'] = $row['id_user']; 
                $_SESSION['role'] = 'user'; // присваем только что зарегистрировашиму пользователю роль юзер, как другую роль он ещё иметь не может 
               
               echo "<script>window.location.href='index'</script>"; // сприпт переадресовывающий на главную страницу

                return "";
            }

            if(!empty($_POST['surname']) && !empty($_POST['name']) && 
            !empty($_POST['patronymic']) && !empty($_POST['email']) && 
            !empty($_POST['password']) && !empty($_POST['password2']) && 
            !empty($_POST['check'])){ //Проверка на заполненость полей ввода

                echo registration($_POST['surname'], $_POST['name'], $_POST['patronymic'], $_POST['email'], $_POST['password'], $_POST['password2'], $BOX_DB);
                
            }
        ?>

    </form>
</div>








<?php
    include('temp/footer.php'); //подключение подвала к странице
?>