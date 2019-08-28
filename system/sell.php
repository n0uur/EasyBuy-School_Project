<?php
if($SEC == false) die("DIE!");

$S_ERROR = false;
$S_ERROR_MSG = "";
$S_SUCCESS = false;
$S_SUCCESS_MSG = "";

$need_upload = false;

if($_POST && $_POST['s_name'])
{
  $posting_id = rand(1000000,9999999);

  if(!isset($_POST['s_name']) or !isset($_POST['s_price']) or !isset($_POST['s_desc']) or !isset($_POST['s_contact']) or !isset($_POST['s_cage']))
  {
    # not okayyyy
    $S_ERROR = true;
    $S_ERROR_MSG = "กรุณากรอกข้อมูลให้ครบ";
    goto main;
  }

  $s_name = $_POST['s_name'];
  $s_price = $_POST['s_price'];
  $s_desc = $_POST['s_desc'];
  $s_contact = $_POST['s_contact'];
  $s_cage = $_POST['s_cage'];
  $uploadOk = 1;

  $need_upload = true;

  if(isset($_POST["submit"]) && $need_upload == true) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["s_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["s_picture"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $S_ERROR = true;
        $S_ERROR_MSG = "ไฟล์ไม่ใช่รูปภาพ";
        $uploadOk = 0;
    }
  }
  if ($uploadOk == 0) {
    $S_ERROR = true;
    $S_ERROR_MSG = "ไฟล์ไม่ถูกอัพโหลด";
  } else {
      $target_dir = "uploads/";
      $file_name = $_FILES["s_picture"]["name"];
      $filename=$_FILES["s_picture"]["name"];
      $target_file = $target_dir . basename($_FILES["s_picture"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $newfilename = $posting_id .".".$imageFileType;
      $new_target = $target_dir . $newfilename;

    if (move_uploaded_file($_FILES["s_picture"]["tmp_name"], $new_target)) {
        $s_date = date('Y-m-d H:i:s');
        $query = "INSERT INTO data_sell (s_name, s_desc, s_price, s_contact, s_post_id, s_pic_ext, s_date, s_cage) VALUES ('$s_name', '$s_desc', '$s_price', '$s_contact', '$posting_id', '$imageFileType', '$s_date', '$s_cage')";
        if($file_db->exec($query) === true)
        {
          $S_SUCCESS = true;
          $S_SUCCESS_MSG = "ลงประกาศเรียบร้อยแล้ว";
        }
      } else {
          $S_ERROR = true;
          $S_ERROR_MSG = "ไฟล์ไม่ถูกอัพโหลด";
      }
  }
}
main:
?>

<div class="main-content">
  <div class="container-fluid">
    <h3 class="page-title">ลงประกาศ</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">ข้อมูลประกาศ</h3>
					</div>
					<div class="panel-body">
            <?php if($S_ERROR == true) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-warning"></i> <?php echo $S_ERROR_MSG ?>
						</div>
            <?php } ?>
            <?php if($S_SUCCESS == true) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-check-circle"></i> <?php echo $S_SUCCESS_MSG ?>
						</div>
            <?php } ?>
            <form method="post" enctype="multipart/form-data">
              หมวดหมู่ :
              <select name="s_cage" class="form-control">
                <?php
                $result = $file_db->query('SELECT * FROM data_categories');
                while($row= $result->fetchArray()){
                    $value = $row['Number'];
                    $name = $row['Name'];
                    echo "<option value='$value'>$name</option>";
                }
                ?>
							</select>
              <br>
              ชื่อสินค้า :
  						<input name="s_name" type="text" class="form-control" placeholder="ชื่อสินค้า..">
              <br>
              ราคา :
  						<input name="s_price" type="number" class="form-control" placeholder="ราคา (บาทไทย)">
  						<br>
              รายละเอียดสินค้า :
              <textarea name="s_desc" class="form-control" placeholder="รายละเอียดสินค้า.." rows="5"></textarea>
              <br>
              อัพโหลดรูปภาพ :
              <input type="file" accept="image/*" name="s_picture" id="s_picture">
              <br>
              เบอร์โทรศัพท์ :
  						<input name="s_contact" type="text" class="form-control" placeholder="เบอร์โทรศัพท์ ex. 0812345678">
  						<br>
              <font color="red">* เมื่อลงประกาศแล้ว ไม่สามารถเปลี่ยนแปลงข้อมูลใหม่ได้ โปรดตรวจสอบให้ดีก่อน</font><br>
              <button name="submit" type="submit" class="btn btn-success">ลงประกาศ</button>
            </form>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
