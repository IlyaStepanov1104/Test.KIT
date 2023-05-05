<?php
include("include.php");

if(isset($_SESSION["user"])){
    echo '<script>window.location = "index.php";</script>';
}
?>
<div class="container mregister">
    <div id="login">
        <h1>ВХОД</h1>
        <div class="errors">
            <?php
            if(!empty($_POST['username']) && !empty($_POST['password'])) {
                $username=$_POST['username'];
                $password=$_POST['password'];
                $sth = $pdo->prepare("SELECT * FROM admin WHERE username='".$username."'");
                $sth->execute();
                $find = $sth->fetch();
                if (password_verify($password, $find['password'])) {
                    $_SESSION['user'] = $find['username'];
                    echo '<script>window.location = "index.php";</script>';
                } else {
                    echo 'ERROR: Invalid username or password!';
                }
            } else {
                echo 'ERROR: All parameters are required!';
            }
            ?>
        </div>
        <form action="#" id="loginform" method="post" name="loginform">
            <p>
                <label for="username">Имя пользователя<br>
                    <input class="input" id="username" name="username" size="32" type="text" value="">
                </label>
            </p>
            <p>
                <label for="password">Пароль<br>
                    <input class="input" id="password" name="password" size="32" type="password" value="">
                </label>
            </p>
            <p class="submit"><input class="button" type= "submit" value="Войти"></p>
        </form>
    </div>
</div>
</body>
</html>