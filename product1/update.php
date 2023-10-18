<?php
include("connect.php") ;
// $pic = $conn->escape_string($_POST['pic']);
$id = $conn->escape_string($_POST['id']);
$procat = $conn->escape_string($_POST['input_cat']);
$proname = $conn->escape_string($_POST['input_name']);
$proprice = $conn->escape_string($_POST['input_price']);

$sql = "UPDATE product 
        SET pro_name = '$proname',
            price = '$proprice',
            pro_cat = '$procat'
        WHERE id = '$id' LIMIT 1";
$rs = $conn->query($sql);

if ($proname != '' && $proprice != '' && $procat != '') {
    if($rs){
        header("refresh:3; url=index.php");
        echo "เปลี่ยนข้อมูลสำเร็จ";
        exit;
    } else {
        header("refresh:3; url=index.php");
        echo "เปลี่ยนข้อมูลไม่สำเร็จ";
        exit;
    }
} else {
    header("refresh:3; url=index.php");
    echo "ไม่สามารถเปลี่ยนข้อมูลได้";
    exit;
}


?>
