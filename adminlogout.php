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
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    header("location:index.php");
}

?>

</html>