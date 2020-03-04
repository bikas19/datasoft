<?php

require_once('inc/auth.php');

if ($login == false || $user == null) {
    header('location: login.php');
}

if (isset($_POST['submit'])) {
	//orders not yet saved into the database
    header('location: order-completed.php');
}
include('inc/header.php');
?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Place your order now...
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Your order details</h2>
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
                                    <?php if (count($cartitems) == 0) : ?> <tr>
                                            <td colspan="5">
                                                <p class="alert alert-info">Cart is empty. Please go to <a href="/">shop</a> to add to cart.</p>
                                            </td>
                                        </tr> <?php endif; ?>
                                    <?php $total = 0;
                                    //cartitems is defined in inc/cart.php , this file is included in inc/header.php for easy access to cart details all over the website
                                    foreach ($cartitems as $index => $item) :
                                    ?>


                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td> <a href="#"><?php echo $item['name']; ?></a> </td>
                                            <td><?php echo $item['rate']; ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td>$<?php echo $item['total']; ?></td>
                                            <?php $total += $item['total']; ?>

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
                            <p>To modify order details. Please go to <a href="/my-cart.php">cart.</a>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <form action="/place-order.php" method="POST">

                                <h2>Delivery and card details</h2>
                                <div class="form-group">
                                    <label for="type">Delivery Type</label>
                                    <select required class="form-control" name='delivery_type' id="delivery-type">
                                        <option value='pickup'>STORE PICKUP</option>
                                        <option value='deliver'>Deliver to address</option>

                                    </select>
                                </div>
                                <div id='delivery_address' class="form-group">
                                    <label for="">Deliver to (full address)</label>
                                    <textarea name='address' class='form-control'>

                        </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Credit Card Details</label>
                                    <div class=" form-group row">
                                        <input required type="text" placeholder="Credit Card Number" class="form-control col-md-6">
                                        <input required type="text" placeholder="Expiry Date" class="form-control col-md-3">
                                        <input required type="text" placeholder="CVV" class="form-control col-md-3">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Cardholder Name</label>
                                    <input name='cardholder_name' required type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Cardholder Address</label>
                                    <input name='cardholder_address' required type="text" class="form-control">
                                </div>
                                <button type="submit" name="submit" class='btn btn-lg btn-danger'>
                                    Place Order
                                </button>
                            </form>
                        </div>
                    </div>


                </div>


            </div>

        </div>

    </div>

</div>




<script>
    var val = $("#delivery-type").val();

    if (val === 'pickup') {
        $("#delivery_address").hide();
    } else if (val === 'deliver') {
        $("#delivery_address").show();
    };
    $("#delivery-type").on('change', function() {
        var val = $(this).val();
        if (val === 'pickup') {
            $("#delivery_address").hide();
        } else if (val === 'deliver') {
            $("#delivery_address").show();
        }
    });
</script>



<?php include('inc/footer.php'); ?>