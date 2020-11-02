<?php
require 'connectDB.php';

if (isset($_POST['postal_code'])){

    if(isset($_POST['search'])){
        if($_POST['search'] == 'amphure'){
            $sql = "SELECT amphures.id as amphure_id,amphures.name_th as th_amphure_name
FROM districts
INNER JOIN amphures on districts.amphure_id = amphures.id
INNER JOIN provinces on amphures.province_id = provinces.id
WHERE districts.zip_code = '{$_POST['postal_code']}'
GROUP BY amphures.id
ORDER BY amphures.id ASC
";
            $result = selectAll($db,$sql);
        }
    }

    echo json_encode($result);
}
