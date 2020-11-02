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

        console_log($_POST['p_id']);
        console_log($_POST['status']);
        console_log($_POST['money_received']);
        
        

        $status = $_POST['status'];
        $money_received = $_POST['money_received'];
        $p_id = $_POST['p_id'];
        
        

        $sql = "UPDATE payment SET status = '$status'  WHERE id=  '$p_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);

        $sql = "UPDATE payment SET money_received = '$money_received'  WHERE id=  '$p_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);

       

        header("location:updatepayment.php");
        exit(0);
    }
