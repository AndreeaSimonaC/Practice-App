<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
</head>

<body>
    <form method="post" action="register.php" name="registration">
        <div>
            <label for="username">Username</label><br>
            <input type="text" name="username" placeholder="username" /><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" /><br>
            <input type="submit" value="Register" name="register-button" />
        </div>
    </form>
</body>
</html>

<?php
include_once 'dbconnection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $registerQuery = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $registerQuery->bindParam(":username", $username);
    $registerQuery->bindParam(":password", $password);
    $results = $registerQuery->execute();

    if ($results) 
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = 'user';

        header("Location: index.php");
        exit();
    } 
    header("Location: index.php");
}


?>