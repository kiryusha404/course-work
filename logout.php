<?php 
    // закрытие сессии(выход)
    session_start();
    $_SESSION = array();
    header('Location: index');