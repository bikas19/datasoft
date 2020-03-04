<?php require_once('auth.php') ?>
<?php

?>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <?php echo $user['name']; ?> <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a href="/home.php" class="dropdown-item">Dashboard</a>
        <a class="dropdown-item" href="/logout.php">
            Logout
        </a>



    </div>
</li>