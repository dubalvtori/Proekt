<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Регистрация</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
<?php
    require('db.php');
    if (isset($_REQUEST['username'])) {

        $username = stripslashes($_REQUEST['username']);

        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Вие се регистрирахте успешно.</h3><br/>
                  <p class='link'>Натиснете тук за <a href='login.php'>вход</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Някои от задължителните полета са празни.</h3><br/>
                  <p class='link'>Натиснете тук за <a href='registration.php'>регистрация</a> отново.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Регистрация</h1>
        <input type="text" class="login-input" name="username" placeholder="Потребителско име" required />
        <input type="text" class="login-input" name="email" placeholder="Имейл">
        <input type="password" class="login-input" name="password" placeholder="Парола">
        <input type="submit" name="submit" value="Регистрация" class="login-button">
        <p class="link">Вече имате акаунт? <a href="login.php">Вход към системата!</a></p>
    </form>
<?php
    }
?>
</body>
</html>
