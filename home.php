<?php require('inc/auth.php');
//if not logged in redirect to index.php
if ($user == null) {
    header('location: index.php');
}
include('inc/header.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">


                    Hello! <?php echo $user['name']; ?>,
                </div>

                <div class="card-footer">
                    <a class='btn btn-primary mt-2' href='/my-cart.php'>Your shopping cart</a>
                    <a class='btn btn-primary mt-2' href='/my-orders.php'>Your orders</a>


                    <?php if ($user['role_id'] == 1) : ?>

                        <a class='btn btn-primary mt-2' href='/add_manager.php'>Add new manager</a>
                    <?php endif; ?>
                    <?php if ($user['role_id'] > 0 && $user['role_id'] < 3) : ?>
                        <a class='btn btn-primary mt-2' href='/add_food.php'>Add new food item</a>

                        <a class='btn btn-primary mt-2' href='/add_employee.php'>Add new employee</a>
                    <?php endif; ?>
                    <?php if ($user['role_id'] > 0) : ?>
                        <a class='btn btn-primary mt-2' href='/all-orders.php'>All Orders</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('inc/footer.php'); ?>