<?php
function connectDB(){
    // lấy ds sinh viên từ DB
    $servername = "localhost";
    $username = "root";
    $passworld = "";
    $db = "product_php";
    // create connection
    $conn = new mysqli($servername,$username,$passworld,$db);

    // kiểm tra kết nối
    if ($conn->connect_errno){
        return null;
    }
    return $conn;
}

function queryDB($sql_txt){
    $conn = connectDB();
    $list = [];
    if ($conn != null){
        $rs = $conn->query($sql_txt);
        if ($rs->num_rows>0){
            while ($row = $rs -> fetch_assoc()){
                $list[] = $row;
            }
        }
    }
    return $list;
}

function insertOrUpdateDB($sql_txt){
    $conn = connectDB();
    if ($conn != null){
        return $conn->query($sql_txt);
    }
    return false;
}