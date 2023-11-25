<?php
    include('temp/server.php'); //подключение базы данных к странице
    include('temp/header.php'); //подключение шапки к странице
?>

<div class="user_conditions">
<h1><b>Отзывы</b></h1>

<?php 
    if(!empty($_SESSION['id'])){
?>

<form action="" method="post" class="form_feedback">
<textarea rows="3"  id="TITLE" placeholder="Расскажите ваше впечатление о клубе" name="text"></textarea>
    <button>Оставить отзыв</button>
</form>

<?php
    if(!empty($_POST['text']) && $_POST['text'] != $_SESSION['form']){
        $text = htmlspecialchars($_POST['text']); // замена спецальных символов html на их кодировку
        $date = date('m/d/Y H:i:s', time()); // текущие время
        $push = $BOX_DB->prepare('INSERT INTO `feedback` (`id_feedback`, `id_user`, `text_feedback`, `date_feedback`) VALUES (NULL, "'.$_SESSION['id'].'", "'.$text.'", "'.$date.'");');  //запрос без возрата результата заполнят таблицу коментарий
        $push->execute(); // выполнение запроса
        $_SESSION['form'] = $_POST['text']; // что бформа при обновлении не отправлялась снова
    }
}
?>

<div class="feedbacks">

<?php
    $push = $BOX_DB->query('SELECT * FROM `feedback` join `users` on feedback.id_user = users.id_user ORDER BY `feedback`.`id_feedback` DESC');  //запрос через PDO, который выводит информацию о отзывах
    $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
    while($row = $push->fetch()){ // возрат данных в ввиде асоциативного массива
?>

    <div class="feedback">
        <h2><b>
            <?php 
            echo $row['surname']; // вывод ФИО коментатора
            echo " ";
            echo $row['name'];
            echo " ";
            echo $row['patronymic']; 
            ?>
        </b></h2>
        <p><?php echo $row['text_feedback']; //вывод текста коменнтария ?></p>
        <p class="date_feedback"><?php echo date('H:i d.m.y', strtotime($row['date_feedback'])); //вывод даты коменнтария ?></p>
    </div>

<?php
    }
?>

</div>
</div>







<?php
    include('temp/footer.php'); //подключение подвала к странице
?>