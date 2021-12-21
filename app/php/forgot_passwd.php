<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style/bulma.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<body>
    <?php

        include 'std.php';

        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $newpasswd = isset($_GET['newpasswd']) ? $_GET['newpasswd'] : '';
        $connection = connectDB(
            $database['host'],
            $database['dbname'],
            $database['user'],
            $database['pass']
        );

        if (saveNewPassword($connection, $username, $newpasswd)) {
            showSuccess("Your password has been changed!");
            echo "<a href=\"../index.html\" class=\"button is-link is-small m-1\">Back</a>";
        } else {
            showError('Password Change Failed');
            echo "<a href=\"../index.html\" class=\"button is-link is-small m-1\">Back</a>";
        }
    
    ?>
</body>
</html>