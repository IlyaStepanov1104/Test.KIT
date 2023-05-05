<?php
include("include.php");

if(isset($_SESSION["user"])){
    echo '<script>window.location = "index.php";</script>';
}
?>
<body>
<div class="container mregister">
    <div id="login">
        <h1>РЕГИСТРАЦИЯ</h1>
        <div class="errors">
            <?php
            if(!empty($_POST['username_register']) && !empty($_POST['password_register'])) {
                $username=$_POST['username_register'];
                $password=password_hash($_POST['password_register'], PASSWORD_BCRYPT);
                $sth = $pdo->prepare("INSERT INTO admin (id, username, password) VALUES (NULL, '".$username."', '".$password."')");
                try {
                    $sth->execute();
                } catch (PDOException $exception){
                    echo 'ERROR: Can\'t register!';
                    return;
                }
                $find = $pdo->lastInsertId();
                if ($find == 0){
                    echo 'ERROR: Invalid username or password!';
                } else {
                    $_SESSION['user']=$_POST['username_register'];
                    echo '<script>window.location = "index.php";</script>';
                }
            } else {
                echo 'ERROR: All parameters are required!';
            }
            ?>
        </div>
        <form action="#" id="registerform" method="post" name="registerform">
            <p>
                <label for="username">Имя пользователя<br>
                    <input class="input" id="username_register" name="username_register" size="32" type="text" value="">
                </label>
            </p>
            <p>
                <label for="password">Пароль<br>
                    <input class="input" id="password_register" name="password_register" size="32" type="password" value="">
                </label>
            </p>
            <p class="submit"><input class="button" type= "submit" value="Войти"></p>
        </form>
    </div>
</div>
</body>
</html>