<?php
include "include.php";


echo '<p><a href="add.php">Добавить элемент</a></p>';
echo '<p><a href="delete.php">Удалить элемент</a></p>';
echo '<p><a href="edit.php">Редактировать элемент</a></p>';

$tree = get_tree($pdo);
print_tree_admin($tree);


?>
</body>
</html>