<?php
    include('temp/server.php'); //подключение базы данных к странице
    include('temp/header.php'); //подключение шапки к странице
?>
<div class="user_conditions">
<h1><b>Наша гордость</b></h1>
<div class="boxers">

<?php
    $push = $BOX_DB->query('SELECT * FROM `boxer`JOIN users on users.id_user = boxer.id_user');  //запрос через PDO, который узнаёт информацию о боксерах
    $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
    while($row = $push->fetch()){ // возрат данных в ввиде асоциативного массива
?>

    <div class="boxer">
        <div class="img_boxer">
            <img src="img/boxer/<?php echo $row['img']; ?>" alt="boxer">
        </div>
        <div class="information_boxer">
            <h2><b>

            <?php 
            echo $row['surname']; // вывод ФИО коментатора
            echo " ";
            echo $row['name'];
            echo " ";
            echo $row['patronymic']; 
            ?>

            </b></h2>
            <p><?php echo $row['text_boxer']; //вывод информации о боксере ?></p>
        </div>
    </div>

<?php
    }
?>

</div>
</div>




<?php
    include('temp/footer.php'); //подключение подвала к странице
?>