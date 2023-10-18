<?php
include("connect.php") ;
include('lib/fnc.php') ;

$id = $conn->escape_string($_GET['id']);

if ($id != '') {
    
    $sql = "DELETE FROM product WHERE id = '$id' LIMIT 1";
    $rs = $conn->query($sql);
    if($rs) {
        header("refresh:3; url=index.php");
        echo "ลบข้อมูลสำเร็จ";
    } else {
        header("refresh:3; url=index.php");
        echo "ลบข้อมูลไม่สำเร็จ";
    }

} else {
    header("refresh:3; url=index.php");
    echo "ไม่สามารถลบข้อมูลได้";
}

?>
