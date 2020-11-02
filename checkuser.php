<html>
<?php
session_start();
require("connectDB.php");

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
if (isset($_POST['uname'])) {
    if (($_POST['uname'] != "admin") || $_POST['psw'] != "admin") {
        header("location:index.php?allow=0");
    } else {
        $_SESSION['admin'] = true;
        header("location:admin.php");
    }
}

$quantity = $_POST['phone'];
if (isset($_POST['phone'])) {
    $sql = 'SELECT * FROM customer WHERE phone  = \'' . $_POST['phone'] . '\'';
    $rs = selectAll($db, $sql);
    // console_log($rs);
    echo "<br>";

    $record = array();
    foreach ($rs as $row) {
        $record[] = $row;
    }

    // print_r($record[0]['id']);
    // echo "<br/>";
    // print_r($record[0]['phone']);




    $_SESSION['id'] = $record[0]['id'];
    $_SESSION['f_name'] = $record[0]['f_name'];
    $_SESSION['l_name'] = $record[0]['l_name'];
    $_SESSION['postal_code'] = $record[0]['postal_code'];
    $_SESSION['email'] = $record[0]['email'];
    $_SESSION['address'] = $record[0]['address'];
    $_SESSION['phone'] = $record[0]['phone'];

    console_log($_SESSION['id']);

    if (isset($_SESSION['from'])) {
        // console_log($_SESSION['from']);
        if ($_SESSION['from'] == "cart") {

            unset($_SESSION['from']);
            header("location:cart.php");
            exit(0);
        } else if ($_SESSION['from'] == "index") {

            unset($_SESSION['from']);
            header("location:product_list.php");
            exit(0);
        } else if ($_SESSION['from'] == "track") {

            unset($_SESSION['from']);
            header("location:statusgoods.php");
            exit(0);
        } else if ($_SESSION['from'] == "payment") {

            unset($_SESSION['from']);
            header("location:payment.php");
            exit(0);
        }
    }
}
?>

</html>