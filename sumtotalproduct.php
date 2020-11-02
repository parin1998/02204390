<?php
session_start();
require 'connectDB.php';
if (isset($_POST['num']) and isset($_POST['price'])) {
    $result = $_POST['num'] * $_POST['price'];

    //Query SQL
    $sql = "UPDATE cart_product set quantity= '{$_POST['num']}',price = '{$result}' WHERE cart_id='{$_POST['cart_id']}' and product_id= '{$_POST['product_id']}'";
    $update = $db->execute($sql);
    if($update){
        $sql = "SELECT cart.id as cart_id,count(*),sum(cart_product.price) as sum FROM cart
INNER JOIN cart_product on cart_product.cart_id = cart.id
WHERE cus_id = '{$_SESSION['id']}' and is_close = false GROUP BY cart.id";
        $record = selectOne($db, $sql);
        $sql = "UPDATE cart set total_price = '{$record['sum']}' where id = '{$_POST['cart_id']}'";
        $update = $db->execute($sql);
        if ($update) {
           /* echo "SUCCESS TO UPDATE IN TOTAL_PRICE";*/
        }
       /* echo "SUCCESS TO UPDATE";*/
    }
    else{
        /*echo "FAILED TO UPDATE";*/
    }
    //End Query SQL

    echo number_format($result,2);

} else
    echo 0;
