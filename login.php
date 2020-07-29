<?php session_start();?>
<html>
<head>
    <meta charset="utf-8">
    <title> Авторизация </title>
    <link rel="stylesheet" type="text/css" href="css/style-login.css">   
</head>
<body class="log_page">
    <div class="login">
    <img src="images/user.png" class="user">
        <h1>Войти</h1>
        <form id="login-form" method="post" action="index.php">
            <label>Username</label>
            <input type="text" name="login" placeholder="Логин">
            <label>Password</label>
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" name="submit">
        </form>
        <?php
            if (isset($_SESSION['log_error']))
            {
                echo '<p class = "error_msg">'.$_SESSION['log_error'].'</p>';
                $_SESSION['log_error'] = NULL;
            }
        ?>
    </div>
</body>
</html>