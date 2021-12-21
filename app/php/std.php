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

    function removeUser($pdoConnection, $username, $passwd) {
        $sql = "DELETE FROM `users` WHERE username = '$username' AND passwd = '$passwd'";
        $stmt = queryCommand($pdoConnection, $sql);

        return $stmt -> rowCount() > 0 ? true : false;
    }

    function verifyLogin($connection, $username, $passwd) {
        $sql = "SELECT * FROM `users` WHERE username = :username AND passwd = :passwd";

        $stmt = queryCommand($connection, $sql, array(
            ':username' => $username,
            ':passwd' => $passwd
        ));

        return $stmt -> fetch() ? true : false;
    }

    function saveNewPassword($connection, $username, $passwd) {
        $sql = "UPDATE `users` SET passwd = :passwd WHERE username = :username";

        $stmt = queryCommand($connection, $sql, array(
            ':username' => $username,
            ':passwd' => $passwd
        ));

        return $stmt -> rowCount() > 0 ? true : false;
    }

    function register($connection, $username, $passwd) {
        $sql = "INSERT INTO `users` (username, passwd) VALUES (:username, :passwd)";
        $stmt = queryCommand($connection, $sql, array(
            'username' => $username,
            'passwd' => $passwd
        ));

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

    function showTitle($message) {
        $html = "<div class=\"title m-1\">";
        $html .= "$message";
        $html .= "</div>";
        echo $html;
    }

    function showDatabase($pdoConnection, $title) {
        $html = "<div class=\"hero has-background-info is-small m-1\">";
        $html .= "<div class=\"hero-body\">";
        $html .= "<p class=\"title is-1\" style=\"color:white\">$title</p>";
        $html .= "<table class=\"table is-bordered is-striped is-narrow is-hoverable is-fullwidth\">";
        $html .= "<thead><tr>";
        $html .= "<th>Username</th>";
        $html .= "<th>Password</th>";
        $html .= "</tr></thead><tbody>";
    
        $stmt = queryCommand($pdoConnection, "SELECT * FROM `users`");
        $result = $stmt -> fetchAll();

        foreach ($result as $row) {
            $html .= "<tr><td>$row[username]</td>";
            $html .= "<td>$row[passwd]</td></tr>";
        }

        $html .= "</tbody></table></div></div>";

        echo $html;
    }

?>