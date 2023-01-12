<?php
    ini_set('display_errors', 0);

    require_once("db/connection.php");

    if(isset($_COOKIE['token']))
    {
        $token = $_COOKIE['token'];

        $query = "SELECT * FROM users WHERE token='$token'";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        if(count($row) > 0)
            header("Location: /PI/");
    }

    if(isset($_POST['login']))
    {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $password = hash('sha256', $password);

        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);
        if(count($row) > 0)
            setcookie("token", $row['token'], time() + (86400 * 30), "/"); 

        header("Location: /PI/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autentificare</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <!--  Request me for a signup form or any type of help  -->
    <div class="login-form">    
        <form method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Login</h4>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" required="required" name="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Parola" required="required" name="password">
            </div>

            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login" name="login">              
        </form>			
        <div class="text-center small">Nu ai un cont? <a href="./register.php">Inregistrare</a></div>
    </div>
</body>
</html>       