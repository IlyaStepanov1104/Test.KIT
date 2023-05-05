<?php
include("include.php");
if(!isset($_SESSION["user"])){
    echo '<script>window.location = "index.php";</script>';
}
?>
<div class="container mregister">
    <div id="login">
        <h1>ДОБАВИТЬ ЭЛЕМЕНТ</h1>
        <div class="errors">
            <?php
            if(!empty($_POST['name'])) {
                $name = $_POST['name'];
                $description = $_POST['description'] ? "'".$_POST['description']."'" : 'NULL';
                $parent_name = $_POST['parent'] ? "'".$_POST['parent']."'" : 'NULL';

                $sth = $pdo->prepare("SELECT id FROM `data` WHERE `name` = ".$parent_name);
                $sth->execute();
                $parent = $sth->fetch();
                if ($parent == null){
                    $parent = 'NULL';
                } else {
                    $parent = $parent['id'];
                }
                $sth = $pdo->prepare("INSERT INTO data (id, name, description, parent) VALUES (NULL, '".$name."', ".$description.", ".$parent.")");
                try {
                    $sth->execute();
                } catch (Exception $exception){
                    echo 'ERROR: Can\'t add!';
                    return;
                }
                $find = $pdo->lastInsertId();
                if ($find == 0){
                    echo 'ERROR: Can\'t add!';
                } else {
                    echo '<script>window.location = "data_admin.php";</script>';
                }
            } else {
                echo 'ERROR: parameter name is required!';
            }
            ?>
        </div>
        <form action="#" id="add" method="post" name="add">
            <p>
                <label for="name">Название<br>
                    <input class="input" id="name" name="name" size="32" type="text" value="">
                </label>
            </p>
            <p>
                <label for="description">Описание<br>
                    <input class="input" id="description" name="description" type="text" value="">
                </label>
            </p>
            <p>
                <label for="parent">Имя родителя<br>
                    <input class="input" id="parent" name="parent" size="32" type="text" value="">
                </label>
            </p>
            <p class="submit"><input class="button" type= "submit" value="Добавить"></p>
        </form>
    </div>
</div>
</body>
</html>