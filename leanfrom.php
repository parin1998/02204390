<?php
require("connectDB.php");
session_start();
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
if ($_POST) {
    if (isset($_FILES['upload'])) {

        // $sql = 'SELECT payment.id FROM customer INNER JOIN cart ON customer.id = cart.cus_id
        // INNER JOIN payment ON cart.id = payment.cart_id WHERE (customer.id = \'' . $_SESSION['id'] . '\')'; // AND (payment.status = false);';
        // $rs = selectAll($db, $sql);
        // // console_log($rs);
        // echo "<br>";

        // $record = array();
        // foreach ($rs as $row) {
        //     $record[] = $row;
        // }


        $pay_id = $_POST['id'];
        $date = date("Y-m-d");
        $name_file =  "cus_" . $_SESSION['id'] . "_pay_" . $pay_id . "_" . date("Y-m-d") . ".webp"; //. $_FILES['upload']['name'];
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img = "img/slip/";
        $_SESSION['slip'] = $name_file;
        move_uploaded_file($tmp_name, $locate_img . $name_file);

        $sql = "UPDATE payment SET slip = '$name_file'  WHERE id=  '$pay_id'   ";
        $rs = updatetData($db, $sql);
        $sql = "UPDATE payment SET date = '$date '  WHERE id=  '$pay_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);
        header("location:payment.php");
    }
}
