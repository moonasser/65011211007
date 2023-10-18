<?php
include("connect.php");
include('lib/fnc.php');
$rs = $conn->query("SELECT * FROM view_product");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
    <link href="bootstrap/css/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="bootstrap/css/s2-docs.css" type="text/css" rel="stylesheet" >
    <script>
    function del(id)
    {
      if(confirm("ยืนยันการลบข้อมูล"))
      {
        window.location = "delete.php?id="+id ;
      }
      else {
        return false ;
      }
    }
    </script>
  </head>
  <body>
<div class="container">
<div class="row">
  <div class="col-md-6">
<h2>รายการสินค้า</h2>
    <table class="table">
      <tr>
       <th>ภาพ</th><th>ชื่อสินค้า</th><th>ราคา</th><th>ประเภทสินค้า</th><th></th>
      </tr>
      <?php
            if ($rs !== null && $rs->num_rows > 0) {
              while ($row = $rs->fetch_array()) {
                if (isset($row['std_pic']) && $row['std_pic'] != '') {
                  $std_pic = "<img src='data/sm_" . $row['std_pic'] . "'>";
                } else {
                  $std_pic = '';
                }
                ?>
<tr>
 <td><?php echo $row['pic'] ?></td>
 <td><?php echo $row['pro_name'] ?></td>
 <td><?php echo $row['price'] ?></td>
 <td><?php echo $row['cat_name'] ?></td>
 <td><a href="edit.php?id=<?php echo $row['id'] ; ?>"><i class='glyphicon glyphicon-pencil'>edit</i></a> | <a href="#" onclick="javascript:del('<?php echo $row['id'];?>');"><i class='glyphicon glyphicon-trash'>delete</i></a></td>
</tr>
<?php
    }
  }
?>
    </table>
  </div>
  <div class="col-md-6">
      <h2>เพิ่มสินค้า</h2>
      <form  method="post" action="add.php" class="form-horizontal" enctype="multipart/form-data">

        <div class="form-group">
          <label for="input_cat" class="col-1 col-form-label">ประเภทสินค้า</label>
          <div class="col-5">
            <select class="" name="input_cat">
              <option value="">เลือกประเภทสินค้า</option>
              <?php 
              $rs0 = $conn->query("SELECT * FROM product_cat ORDER BY cat_name");
              while($row0 = $rs0->fetch_array()) {
                $cat_id = $row0['cat_id'];
                $cat_name = $row0['cat_name'];
                if($cat_id == $conn->escape_string($_GET['input_cat'])  || $cat_id ==  $conn->escape_string($_POST['input_cat'])) {
                  echo "<option value='$cat_id' selected>$cat_name</option>";
                } else {
                  echo "<option value='$cat_id'>$cat_name</option>";

                }
              }
              
              ?>
            </select>
          </div>
        </div>
        <div class "form-group">
          <label for="input_name" class="col-1 col-form-label">ชื่อสินค้า</label>
          <div class="col-5">
            <input class="form-control" type="text" id="input_name" name="input_name">
          </div>
        </div>
        <div class="form-group">
          <label for="input_price" class="col-1 col-form-label">ราคา</label>
          <div class="col-5">
            <input class="form-control" type="number" id="input_price" name="input_price">
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
           <button class="btn btn-primary" id="bt">Submit</button>
          </div>
        </div>
      </form>
  </div>
</div>
</div>
  </body>
</html>
