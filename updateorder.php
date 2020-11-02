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

    if (isset($_POST['cp_id'])) {
        console_log($_POST['cp_id']);
        $cp_id = $_POST['cp_id'];
        $sql = "DELETE FROM cart_product WHERE id=  '$cp_id'   ";
        $rs = delete($db, $sql);
        console_log($sql);
        console_log($rs);
        header("location:order.php");
        exit(0);
    } else {
        console_log($_POST['statuspayment']);
        console_log($_POST['statuspost']);
        console_log($_POST['trackcode']);
        console_log($_POST['p_id']);

        console_log($_POST['t_id']);
        console_log($_POST['id']);

        $statuspayment = $_POST['statuspayment'];
        $statuspost = $_POST['statuspost'];
        $trackcode = $_POST['trackcode'];
        $p_id = $_POST['p_id'];
        // $cp_id = $_POST['cp_id'];
        $t_id = $_POST['t_id'];

        $sql = "UPDATE payment SET status = '$statuspayment'  WHERE id=  '$p_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);

        $sql = "UPDATE tracking SET track_code = '$trackcode'  WHERE id=  '$t_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);

        $sql = "UPDATE tracking SET t_status = '$statuspost'  WHERE id=  '$t_id'   ";
        $rs = updatetData($db, $sql);
        console_log($sql);
        console_log($rs);

        header("location:order.php");
        exit(0);
    }
}
