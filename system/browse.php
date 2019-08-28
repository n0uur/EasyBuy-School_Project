<?php
if($SEC == false) die("DIE!");

if(isset($_GET['id']))
{
  $post_id = $_GET['id'];
  $result = $file_db->query("SELECT * FROM data_sell WHERE s_post_id='$post_id'");
  while($row= $result->fetchArray()){
    $post_name = $row['s_name'];
    $post_desc = $row['s_desc'];
    $post_price = $row['s_price'];
    $post_contact = $row['s_contact'];
    $post_s_date = $row['s_date'];
    $post_pic_ext = $row['s_pic_ext'];
    $post_cage = $row['s_cage'];

    $result2 = $file_db->query("SELECT * FROM data_categories WHERE Number='$post_cage'");
    while($row2= $result2->fetchArray()){
      $post_cage_msg = $row2['Name'];
    }
    ?>
    <div class="main-content">
      <div class="container-fluid">
        <h3 class="page-title">ดูสินค้า</h3>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title"><?php echo "ชื่อสินค้า : $post_name"?></h3>
              </div>
              <div class="panel-body">
                <div class="profile-header">
                  <div class="overlay"></div>
									<div class="profile-stat">
										<div class="row">
                      <div class="col-md-12">
                        <img src="uploads/<?php echo "$post_id.$post_pic_ext"; ?>" draggable='false' width="50%">
                      </div>
											<div class="col-md-4 stat-item">
												ราคา <span style="font-size:24px"><?php echo $post_price?> บาท</span>
											</div>
                      <div class="col-md-4 stat-item">
												หมวดหมู่ <span style="font-size:24px"><?php echo $post_cage_msg?></span>
											</div>
                      <div class="col-md-4 stat-item">
												วันที่ลงประกาศ <span style="font-size:24px"><?php echo $post_s_date?></span>
											</div>
											</div>
										</div>
									</div>
								</div>
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">รายละเอียดสินค้า</h4>
                    <p><?php echo "$post_desc" ?></p>
                    <br>
										<ul class="list-unstyled list-justify">
											<li>ติดต่อ : <?php echo $post_contact ?></li>
										</ul>
									</div>
								</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  if(!isset($post_name))
  {
    ?>
    <div class="main-content">
      <div class="container-fluid">
        <h3 class="page-title">ข้อผิดพลาด (504)</h3>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title">ข้อผิดพลาด</h3>
              </div>
              <div class="panel-body">
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <i class="fa fa-times-circle"></i> ไม่พบสินค้าที่คุณเลือก
                </div>
                <div id="demo-line-chart" class="ct-chart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}
else
{
  echo "<meta http-equiv='refresh' content='0;url=?page=looking'>";
  die();
}
?>
