<?php

require_once('inc/auth.php');

if ($login == false || $user == null) {
    header('location: login.php');
}
//get endpoint for adding items to cart from single file
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (addToCart($user, getFoodById($id))) {
        $_SESSION['message'] = 'Successfully added cart items';
        header('location: index.php');
    } else {
        $_SESSION['message'] = 'Failed to add to cart items';
        header('location: index.php');
    }
}
include('inc/header.php');



?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadowed">
                <div class="card-header">
                    Your Cart <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($message)) :
                    ?>
                        <div class="alert alert-success">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Food</th>
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($cartitems) == 0) : ?>
                                <tr>
                                    <td colspan="5">
                                        <p class="alert alert-info">Cart is empty. Please go to <a href="/">shop</a> to add to cart.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php $total = 0;
                            ?>

                            <?php foreach ($cartitems as $index => $item) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td> <a href="/food.php?id=<?php echo $item['food_id']; ?>"><?php echo $item['name']; ?></a> </td>
                                    <td><?php echo $item['rate']; ?></td>
                                    <td><input type="number" placeholder="qty" class='qty form-control w-50' data-id='<?php echo $item['id']; ?>' value="<?php echo $item['quantity']; ?>"></td>
                                    <td>$<?php echo $item['total']; ?></td>
                                    <?php
                                    $total += $item['total'];
                                    ?>
                                    <td class="d-none">
                                        <form method="POST" action="/update-cart.php/?id=<?php echo $item['id']; ?>" style="display:none">
                                            <input type="text" class="" name='qty' id='cartitem-<?php echo $item['id']; ?>'>
                                            <input type="submit" id='cartsubmit-<?php echo $item['id']; ?>'>
                                        </form>
                                    </td>
                                    <td>
                                        <a class='btn del btn-sm btn-danger' data-id='<?php echo $item['id']; ?>' href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Grand Total</th>
                            <th>$<?php echo $total; ?></th>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/place-order.php" class='btn btn-danger float-right'>Place Order Now</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.qty').on('change', function() {
        var id = $(this).data('id');
        $("#cartitem-" + id).val($(this).val());
        $("#cartsubmit-" + id).click();
    });

    $('.del').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $("#cartitem-" + id).val($(this).val());
        $("#cartsubmit-" + id).click();
    })
</script>


<?php include('inc/footer.php'); ?>