<?php
//some utility functions
//check if string is empty.. can also be done by using strlen function.. but lets just define our own function
function isEmpty($str)
{
    if (count_chars($str) == 0) return true;
    return false;
}

//check if email already exists in our database. helpful in registration
function email_exists($email)
{
    global $dbconnection;
    $result = $dbconnection->query("select email from users where email='$email'");
    if ($result->num_rows > 0) {
        return true;
    }
    return false;
}

