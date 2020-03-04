<?php
$hostname = 'localhost';
$username = 'bikas19x';
$password = 'Forg0to!@';
$dbname = 'bikas19x_database1';

//one of the important file. without this, our system wont work.. handles connection with db
$dbconnection = mysqli_connect($hostname, $username, $password, $dbname) or die('failed to connect to db');

//given the id, returns food fetched from database,,
function getFoodById($id)
{
    global $dbconnection;
    $query = "select * from foods where id='$id'";
    $result = $dbconnection->query($query);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

//given the user and food objects, add food to user's cart. $user and $food are variable returned from fetch_assoc() function.
function addToCart($user, $food)
{
	//access global variable $dbconnection.
    global $dbconnection;
	//check if both value aint null.
    if ($food && $user) {
        $uid = $user['id'];
        $fid = $food['id'];
        //check if the food is already in the cart, if already in cart, only update quantity and totals.
        $get = "select id,rate,quantity from cart_items where food_id='$fid' and user_id='$uid'";
        $qty = 1;
        $result = $dbconnection->query($get);
        if ($result && $result->num_rows > 0) {
        	//if already...
            $curr = $result->fetch_assoc();
            $qty = $curr['quantity'];
            $cid = $curr['id'];
            $qty += 1;
            $total = ($curr['rate'] * $qty);
            $query = "update cart_items set total=$total, quantity='$qty' where id=$cid; ";
        } else {
            $rate= $food['price'];
            $total= $food['price'];
            $query = "insert into cart_items(user_id,quantity,rate,total,food_id) values($uid,$qty,$rate,$total,$fid);";
        }

        if ($dbconnection->query($query)) {
            return true;
        }
       
    }
    return false;
}


//get list of categories for add_food form.. 
function getCategories()
{
    global $dbconnection;
    $cat = array();
    $query = 'select * from categories';
    $result = $dbconnection->query($query);
    if ($result && $result->num_rows > 0) {
        while (($row = $result->fetch_assoc())) {
        	//each row is pushed to array and then this array is returned..
            array_push($cat, $row);
        }
    }
    return $cat;
}

//helper function to addnew category to database.
//argument $category is string.
function addNewCategory($category)
{
    global $dbconnection;
    $s = "select id from categories where name='$category'";
    $r = $dbconnection->query($s);
    //if this category already exists, just return id of that category
    if ($r && $r->num_rows > 0) {
        return $r->fetch_assoc()['id'];
    }
    $query = "insert into categories(name,status,is_offer) values('$category',1,0)";
    //if no existing, create new and return inserted id
    $result = $dbconnection->query($query);
    if ($result) {
        return $dbconnection->insert_id;
    } else return 0; // 0 means we failed....
}