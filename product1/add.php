<?php
include("connect.php");

$sp_cat = $conn->escape_string($_POST['input_cat']);
$sp_name = $conn->escape_string($_POST['input_name']);
$sp_price = $conn->escape_string($_POST['input_price']);

$sql = "INSERT INTO product 
        SET pro_name = '$sp_name',
            price = '$sp_price',
            pro_cat = '$sp_cat'
        ";
$rs = $conn->query($sql);
$std_pic = '';

if ($sp_name != '' && $sp_price != '' && $sp_cat != '') {
    if (isset($_FILES['input_pic']) && is_uploaded_file($_FILES['input_pic']['tmp_name'])) {
        $tmp = explode('.', $_FILES['input_pic']['name']);
        $file_ex = end($tmp);

        if (in_array($file_ex, array('jpg', 'jpeg', 'png'))) {
            $std_pic = $std_code . '.' . $file_ex;

            if (move_uploaded_file($_FILES['input_pic']['tmp_name'], 'data/' . $std_pic)) {
                resizeThumbnailImage('data/' . $std_pic, 'data/sm_' . $std_pic, 50, 50);
            }
        }
    }

    if ($rs) {
        header("refresh:3; url=index.php");
        echo "เพิ่มข้อมูลสำเร็จ";
        exit;
    } else {
        header("refresh:3; url=index.php");
        echo "ไม่สามารถเพิ่มข้อมูลได้";
        exit;
    }
} else {
    header("refresh:3; url=index.php");
    echo "ข้อมูลไม่ครบ";
    exit;
}
?>
