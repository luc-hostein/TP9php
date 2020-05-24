<?php

include "PHP.ini";

function connexpdo($user,$password){
    $dsn = "pgsql:dbname=notes;host=127.0.0.1;port=5432";
    try {
        $dbh = new PDO($dsn,$user,$password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    return $dbh;
}

?>
