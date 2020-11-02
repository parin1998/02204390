<?php
session_start();
require 'connectDB.php';
if ((isset($_POST["postal_code"]) or isset($_POST["address"]) or isset($_POST["name"]) or isset($_POST["l_name"]) or isset($_POST["phone"]) or isset($_POST["provinces"]) or isset($_POST["amphures"]) or isset($_POST["districts"]))){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $phone = $_POST['phone'];
    $postal_code = $_POST['postal_code'];
    $provinces = $_POST['provinces'];
    $amphures = $_POST['amphures'];
    $districts = $_POST['districts'];
    $address = $_POST['address'];

    $sql = "SELECT cart.id as cart_id,cart.cus_id as customer_id FROM cart
WHERE cart.cus_id = '{$_SESSION['id']}' and cart.is_close = false";

    $record = selectOne($db,$sql);
    $address = $address." ตำบล ".$districts." อำเภอ ".$amphures." จังหวัด ".$provinces ;
    $cart_id = $record['cart_id'];

    //Update Customer
    $sql = "UPDATE customer set f_name = '{$f_name}',l_name = '{$l_name}',postal_code = '{$postal_code}',address = '{$address}',phone = '{$phone}'
WHERE id = '{$_SESSION['id']}'";
    $update = $db->execute($sql);
    if($update){
        echo "UPDATE customer data success";
    }

    //Update Cart
    $sql = "UPDATE cart set is_close = true where id = '{$cart_id}'";
    $update = $db->execute($sql);
    if($update){
        echo "update cart success";
    }

    //Insert Payment
    $sql = "INSERT INTO payment(cart_id) VALUES ('{$cart_id}')";
    $save = $db->execute($sql);
    if($save){
        echo "Insert payment success";
    }

    $sql = "INSERT INTO tracking(cart_id) VALUES ('{$cart_id}')";
    $save = $db->execute($sql);
    if($save){
        echo "Insert tracking success";
        header('location: ./payment.php');
    }

    echo $record['cart_id'];
}
