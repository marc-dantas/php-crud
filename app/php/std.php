<?php

    $database = array(
        'host' => 'localhost',
        'dbname' => 'data',
        'user' => 'root',
        'pass' => ''
    );

    function connectDB($host, $dbname, $user, $pass) {
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        return $connection;
    }

    function queryCommand($pdoConnection, $sql, $bindArray = array()) {
        $stmt = $pdoConnection -> prepare($sql);
        $stmt -> execute($bindArray);
        return $stmt;
    }

    function verifyLogin($connection, $username, $passwd) {
        $sql = "SELECT * FROM `users` WHERE username = '$username' AND passwd = '$passwd'";

        $stmt = queryCommand($connection, $sql);
        $result = $stmt -> fetch();
        
        return $result ? true : false;
    }

    function register($connection, $username, $passwd) {
        $sql = "INSERT INTO `users` (username, passwd) VALUES ('$username', '$passwd')";
        $stmt = queryCommand($connection, $sql);

        return $stmt -> rowCount() > 0 ? true : false;
    }

    function showSuccess($message) {
        $html = "<div class=\"notification is-success m-1\">";
        $html .= "$message";
        $html .= "</div>";
        echo $html;
    }

    function showError($message) {
        $html = "<div class=\"notification is-danger m-1\">";
        $html .= "$message";
        $html .= "</div>";
        echo $html;
    }

    function showInfo($message) {
        $html = "<div class=\"notification is-info m-1\">";
        $html .= "$message";
        $html .= "</div>";
        echo $html;
    }

?>