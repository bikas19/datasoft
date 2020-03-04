<?php
//cart button, where count is shown as badge..
require_once('./inc/cart.php');
?>
<a class="nav-link btn btn-outline-primary" href='/my-cart.php'>
    <span class='mx-2 fas fa-shopping-cart'></span>
    <?php if ($cartcount > 0) : ?>
        <span class="badge badge-info">
            <?php echo $cartcount; ?>
        </span>
    <?php endif ?>
</a>