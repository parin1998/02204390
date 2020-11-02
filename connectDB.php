<?php
require 'vendor/adodb/adodb-php/adodb.inc.php';
/*
* Simple connection
*/
$driver = 'postgres';
$db     = ADONewConnection($driver);
$host = '35.186.154.48';
$user =  'postgres';
$pass = '123456';
$dbname = 'postgres';
$port = '5432';

/*
* Now connect to the database
*/
$db->connect($host,$user,$pass,$dbname);
/*if($db){
    echo "connect";
}
else{
    echo $db;
}
*/

function selectAll($db,$sql){
    $result = $db->getAll($sql);
    return $result;
}

function selectOne($db,$sql){
    $result = $db->getRow($sql);
    return $result;
}

function delete($db,$sql){
    $result = $db->execute($sql);
    return $result;
}

function insertData($db,$sql){
    $db->execute($sql);
    $result = $db->insert_Id();

    return $result;
}

function updatetData($db,$sql){
    $db->execute($sql);
    $result = $db->execute($sql);

    return $result;
}
