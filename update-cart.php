<?php
//this file updates cart item. receives post request.


require('inc/auth.php');
if ($login == false || $user == null) {
    header('location: /index.php');
}
//checking if cart addition allowed
if (isset($_GET['id']) && isset($_POST['qty'])) {
    $qty = $_POST['qty'];

    $id = $_GET['id'];
    //if $qty is 0 delete cart item.. shortcut for deleting cart items as well.
    if ($qty == 0) {
        //delete
        $uid = $user['id'];

        $quer = "DELETE from cart_items where food_id='$id' and user_id='$uid'";
        
    } else {
        $r = $dbconnection->query("select * from cart_items where id='$id'");
        if ($r && $r->num_rows > 0) {
            $uid = $user['id'];
            $total = $qty * $r->fetch_assoc()['rate'];
            $quer = "UPDATE cart_items set quantity='$qty', total='$total' where food_id='$id' and user_id='$uid'";
        }
    }

    if (isset($quer)) {

        if ($dbconnection->query($quer)) {
            // var_dump($quer);
            // exit;
            //flashing into cookie,, the message
            $_SESSION['message'] = 'Successfully updated cart items';
            header('location: /my-cart.php');
        }
    }
} else {
    header('location: /index.php');
}
