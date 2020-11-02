<?php
$num = $_POST['num'];
$price = $_POST['price'];
if($num == ''){
    $num = 0;
}
$result = $num * $price;
$array = array(
  'value' => $result,
  'format' => number_format($result,2)
);

echo json_encode($array);
