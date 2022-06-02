<?php

require('connect.php');


function dd($value){
    echo '<pre>', print_r($value, true), '</pre>';
    die();
}

function selectAll($table){
    global $conn;
    $sql = "SELECT * FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

