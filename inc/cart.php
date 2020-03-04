<?php 
// initialized details about cart and make them available to our whole er....., universe....
require_once('auth.php');
$cartcount = 0;
$cartitems = array();
if ($login) {
    $user_id = $user['id'];
    $query = "select * from cart_items,foods where cart_items.user_id='$user_id' and foods.id=cart_items.food_id;;";
    $result = $dbconnection->query($query);
    // var_dump($dbconnection->error);
    // exit;
    if ($result) {
        $cartcount = $result->num_rows;
        while (($row = $result->fetch_assoc()))
            array_push($cartitems, $row);
    }
}


//at the end of the exectution, $cartcount contains number of items in cart, $cartitems is array of all the cartitems.
