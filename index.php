<?php
include("include.php"); ?>
<div id="welcome">
    <?php
        if (isset($_SESSION["user"])){
            echo "<h2>Добро пожаловать, <span>".$_SESSION['user']."</span>!</h2>";
        } else {
            echo "<h2>Добро пожаловать!</h2>";
        }
       ?>

</div>
</body>
</html>
