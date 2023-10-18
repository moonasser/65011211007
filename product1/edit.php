<?php
include("connect.php");
include("lib/fnc.php");

$id = $conn->escape_string($_GET['id']);

if ($id != '') {
    $sql = "SELECT * FROM view_product WHERE id = '$id' LIMIT 1";
    $rs = $conn->query($sql);
    $row = $rs->fetch_array();
} else {
    header("refresh:3;url=index.php");
    echo "ข้อมูลไม่ครบ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>แก้ไขสินค้า</title>
    <link href="bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="bootstrap/css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="bootstrap/css/s2-docs.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-md-6">
            <h2>แก้ไขสินค้า</h2>
            <form method="post" action="update.php" class="form-horizontal">
                <div class="form-group">
                    <label for="input_cat" class="col-1 col-form-label">ประเภทสินค้า</label>
                    <div class="col-5">
                        <select class="" name="input_cat">
                            <?php
                            $rs0 = $conn->query("SELECT * FROM product_cat ORDER BY cat_name");
                            while ($row0 = $rs0->fetch_array()) {
                                $cat_id = $row0['cat_id'];
                                $cat_name = $row0['cat_name'];
                                if ($cat_id == $row['cat_id']) {
                                    echo "<option value='$cat_id' selected>$cat_name</option>";
                                } else {
                                    echo "<option value='$cat_id'>$cat_name</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_name" class="col-1 col-form-label">ชื่อสินค้า</label>
                    <div class="col-5">
                        <input class="form-control" type="text" id="input_name" name="input_name" value="<?php echo $row['pro_name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_price" class="col-1 col-form-label">ราคา</label>
                    <div class="col-5">
                        <input class="form-control" type="number" id="input_price" name="input_price" value="<?php echo $row['price'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-1 col-form-label">ภาพสินค้า</label>
                    <div class="col-5">
                        <input type="file" name="pic">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bt" class="col-1 col-form-label"></label>
                    <div class="col-5">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button class="btn btn-primary" id="bt">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
