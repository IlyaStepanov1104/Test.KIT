<?php
include("include.php");
?>
<div class="container mregister">
    <div id="login">
        <h1>РЕДАКТИРОВАТЬ ЭЛЕМЕНТ</h1>
        <form action="#" id="edit" method="post" name="edit">
            <div class="errors">
                <?php
                if (empty($_POST['name'])){
                    echo 'ERROR: no such element!';
                } else if(empty($_POST['id'])) {
                    $name = $_POST['name'];
                    $sth = $pdo->prepare("SELECT * FROM `data` WHERE `name` = ".$name);
                    $sth->execute();
                    $find = $sth->fetch();
                    if ($find == null){
                        echo 'ERROR: no such element!';
                    } else {
                        $sth = $pdo->prepare("SELECT name FROM `data` WHERE `id` = ".$find['parent']);
                        $sth->execute();
                        $parent = $sth->fetch();
                        if ($parent == null){
                            $parent = 'NULL';
                        } else {
                            $parent = $parent['name'];
                        }
                        echo '
                            <input type="hidden" name="id" id="id" value="'.$find['id'].'">
                            <p>
                                <label for="name">Название редактируемого элемента<br>
                                    <input class="input" id="name" name="name" size="32" type="text" value="'.$find['name'].'">
                                </label>
                            </p>
                            <p>
                                <label for="name">Описание редактируемого элемента<br>
                                    <input class="input" id="description" name="description" size="32" type="text" value="'.$find['description'].'">
                                </label>
                            </p>
                            <p>
                                <label for="name">Родитель редактируемого элемента<br>
                                    <input class="input" id="parent" name="parent" size="32" type="text" value="'.$parent.'">
                                </label>
                            </p>
                            </div>
                            <p class="submit"><input class="button" type="submit" value="Сохранить"></p>';
                        return;
                    }
                } else {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $description = $_POST['description'] ? "'".$_POST['description']."'" : 'NULL';
                    $parent_name = $_POST['parent'] ? "'".$_POST['parent']."'" : 'NULL';

                    $sth = $pdo->prepare("SELECT id FROM `data` WHERE `name` = ".$parent_name);
                    $sth->execute();
                    $parent_id = $sth->fetch();
                    if ($parent_id == null){
                        $parent_id = 'NULL';
                    } else {
                        $parent_id = $parent_id['id'];
                    }
                    $sth = $pdo->prepare("UPDATE `data` SET `name` = '".$name."', `description` = ".$description.", `parent` = ".$parent_id." WHERE `data`.`id` = ".$id);
                    $sth->execute();
                    $find = $pdo->lastInsertId();
                    print_r($sth);
                    if ($find == 0) {
                        header("Location: data_admin.php");
                        return;
                    } else {
                        echo 'ERROR: can\'t edit!';
                    }
                }
                echo '<p>
                <label for="name">Название редактируемого элемента<br>
                    <input class="input" id="name" name="name" size="32" type="text" value="">
                </label>
            </p>
            </div>
            <p class="submit"><input class="button" type="submit" value="Выбрать"></p>';
                ?>

        </form>
    </div>
</div>
</body>
</html>