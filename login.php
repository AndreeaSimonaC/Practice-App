<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>

<body>
    <form method="post" action="login.php">
        <div>
            <label for="username">Username</label><br>
            <input type="text" name="username" placeholder="username" /><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" /><br>
            <input type="submit" value="login here" name="login-button" />
        </div>
    </form>
</body>

</html>

<?php
include_once 'dbconnection.php';
session_start();

//check if login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginQuery = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $loginQuery->bindParam(":username", $username);
    $loginQuery->execute();
    $results = $loginQuery->fetch();

    if ($results) 
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $results['role'];

        //check role in $results
        if($results['role'] === 'admin') 
        {
            header("Location: index.php");
            exit();
        } else if($results["role"] === "user") 
        {
            header("Location: index.php");
            exit();
        }
        
    } else 
    {
        header("Location: index.php");
    }   
}
?>