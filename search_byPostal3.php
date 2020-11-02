<?php
require 'connectDB.php';

if (isset($_POST['postal_code'])){

    if(isset($_POST['search'])){
        if($_POST['search'] == 'district'){
            $sql = "SELECT districts.id as district_id,districts.name_th as th_district_name
FROM districts
INNER JOIN amphures on districts.amphure_id = amphures.id
INNER JOIN provinces on amphures.province_id = provinces.id
WHERE districts.zip_code = '{$_POST['postal_code']}'
GROUP BY districts.id
ORDER BY districts.id ASC
";
            $result = selectAll($db,$sql);
        }
    }

    echo json_encode($result);
}
