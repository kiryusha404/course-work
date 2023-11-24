<?php
    include('temp/server.php'); //подключение базы данных к странице
    include('temp/header.php'); //подключение шапки к странице
?>

<?php
    $push = $BOX_DB->query('SELECT * FROM `news` ORDER BY `news`.`id_news` DESC');  //запрос через PDO, который узнаёт какой выводит информацию о новостях от новой к старой новости
    $push->setFetchMode(PDO::FETCH_ASSOC);  //отправление запроса
    while($row = $push->fetch()){ // возрат данных в ввиде асоциативного массива
?>
<div class="card_news">
<h1><b><?php echo $row['name_news']; // выводится название новости ?></b></h1>
<img src="img/news/<?php echo $row['img']; // выводится фотографии новости ?>" alt="news">
<div class="text_news">
    <p><?php echo $row['text_news']; // выводится информация о новости ?></p>
</div>
<div class="comment_date">
    <div class="news_comment">
        <a href="news?id=<?php echo $row['id_news']; // ссылка на пост новотью и комментариями ?>">Комментарии</a>
    </div>
    <div class="news_date">
        <p><?php echo date('H:i d.m.y', strtotime($row['date_news'])); // выводится дата создания новости новости ?></p>
    </div>
</div>
</div>
<?php
    }
?>

<?php
    include('temp/footer.php'); //подключение подвала к странице
?>