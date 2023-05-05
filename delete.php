<?php
include("include.php");
if(!isset($_SESSION["user"])){
    echo '<script>window.location = "index.php";</script>';
}
?>
<div class="container mregister">
    <div id="login">
        <h1>УДАЛИТЬ ЭЛЕМЕНТ</h1>
        <div class="errors">
            <?php
            if(!empty($_POST['name'])) {
                $name = $_POST['name'];

                $sth = $pdo->prepare("SELECT * FROM `data` WHERE `name` = '".$name."'");
                $sth->execute();
                $id = $sth->fetch();
                if ($id == null){
                    echo 'ERROR: no such element!';
                } else {
                    $id = $id['id'];
                    $childs = array(['id' => $id]);
                    do {
                        $id = array_shift($childs)['id'];
                        $sth = $pdo->prepare("DELETE FROM data WHERE data.id = ".$id);
                        $sth->execute();
                        $search = $pdo->prepare("SELECT id FROM data WHERE parent = ".$id);
                        $search->execute();
                        $childs = array_merge($childs, $search->fetchAll(PDO::FETCH_ASSOC));
                    } while (count($childs) != false);
                    echo '<script>window.location = "data_admin.php";</script>';
                }
            } else {
                echo 'ERROR: parameter name is required!';
            }
            ?>
        </div>
        <form action="#" id="delete" method="post" name="add">
            <p>
                <label for="name">Название<br>
                    <input class="input" id="name" name="name" size="32" type="text" value="">
                </label>
            </p>
            <p class="submit"><input class="button" type= "submit" value="Удалить"></p>
        </form>
    </div>
</div>
</body>
</html>