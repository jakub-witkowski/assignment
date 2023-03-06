<?php

try {
    $db_server = 'serwer2330608.home.pl';
    $db_name = '36974722_assignment';
    $db_user = '36974722_assignment';
    $db_pass = 'BazaTrening_2023';
    
    $db_pdo = new PDO(
            "mysql:host=$db_server;dbname=$db_name",
            $db_user, $db_pass,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
    );
    
    $db_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "An error has occurred: " . $e->getMessage();
    die();
} 
