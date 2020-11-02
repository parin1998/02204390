<?php
require 'connectDB.php';

if (isset($_POST['postal_code'])){

    if(isset($_POST['search'])){
        if($_POST['search'] == 'province'){
            $sql = "SELECT provinces.id as province_id,provinces.name_th as th_province_name
FROM districts
INNER JOIN amphures on districts.amphure_id = amphures.id
INNER JOIN provinces on amphures.province_id = provinces.id
WHERE districts.zip_code = '{$_POST['postal_code']}'
GROUP BY provinces.id
ORDER BY provinces.id ASC
";
            $result = selectAll($db,$sql);
        }

    }

    echo json_encode($result);
}
