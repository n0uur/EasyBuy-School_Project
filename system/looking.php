<?php
if($SEC == false) die("DIE!");

$cage_msg = "";
$set_cage = false;
$search = false;

if(isset($_GET['cage']))
{
  $id = $_GET['cage'];
  $result = $file_db->query("SELECT * FROM data_categories WHERE Number='$id'");
  while($row= $result->fetchArray()){
      $name = $row['Name'];
  }
  if(isset($name))
  {
    $cage_msg = "หมวดหมู่ $name";
    $set_cage = true;
  }
  if($id == 'all')
  {
    $set_cage = true;
    $cage_msg = "ทุกหมวดหมู่";
  }

}
if(isset($_GET['search']))
{
  $set_cage = false;
  $search = true;
}
?>
<div class="main-content">
  <div class="container-fluid">
    <h3 class="page-title">เลือกดูสินค้า (ล่าสุดก่อน)</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">เลือกดูสินค้า<?php echo $cage_msg ?></h3>
          </div>
          <div class="panel-body">
            <?php
            $numm = 0;
            if($set_cage == true)
            {
              if($id != "all") #ตามหมวด
              {
                $result = $file_db->query("SELECT * FROM data_sell WHERE s_cage='$id' ORDER BY RecordID DESC");
                while($row= $result->fetchArray()){
                  ?>
                  <div class="col-md-3">
                    <a href="?page=browse&id=<?php echo $row['s_post_id']?>">
                      <div class="metric">
                        <img src="uploads/<?php echo $row['s_post_id'].".".$row['s_pic_ext']?>" width="100%">
                        <hr width="80%"><p>
                          <span class="number"><?php echo $row['s_name']?></span>
                          <span class="title">ราคา <?php echo $row['s_price']?> บาท</span>
                        </p>
                      </div>
                    </a>
                  </div>
                  <?php
                  $numm++;
                }
                if($numm == 0)
                  echo "ไม่พบสินค้าในหมวดหมู่นี้";
              }
              else #ทุกหมวด
              {
                $result = $file_db->query("SELECT * FROM data_sell ORDER BY RecordID DESC");
                $numm = 0;
                while($row= $result->fetchArray()){
                  ?>
                  <div class="col-md-3">
                    <a href="?page=browse&id=<?php echo $row['s_post_id']?>">
                      <div class="metric">
                        <img src="uploads/<?php echo $row['s_post_id'].".".$row['s_pic_ext']?>" width="100%">
                        <hr width="80%"><p>
                          <span class="number"><?php echo $row['s_name']?></span>
                          <span class="title">ราคา <?php echo $row['s_price']?> บาท</span>
                        </p>
                      </div>
                    </a>
                  </div>
                  <?php
                  $numm++;
                }
                if($numm == 0)
                  echo "ไม่พบสินค้า";
              }

            }
            else if($search == false) #หน้าเลือกหมวด
            {
              ?>
              <div class="col-md-3">
                <a href="?page=looking&cage=all">
                  <div class="metric">
                    <span class="icon"><p style="opacity:0">.</p><i class="fas fa-clipboard-list"></i></span>
                    <p>
                      <span class="number">ทุกหมวดหมู่</span>
                      <span class="title">ดูสินค้าทุกหมวดหมู่</span>
                    </p>
                  </div>
                </a>
              </div>
              <?php
              $result = $file_db->query("SELECT * FROM data_categories");
              while($row= $result->fetchArray()){
                  ?>
                  <div class="col-md-3">
                    <a href="?page=looking&cage=<?php echo $row['Number']?>">
                      <div class="metric">
                        <span class="icon"><p style="opacity:0">.</p><?php echo $row['Icon'] ?></span>
                        <p>
                          <span class="number"><?php echo $row['Name'] ?></span>
                          <span class="title"><?php echo $row['Desc'] ?></span>
                        </p>
                      </div>
                    </a>
                  </div>
                  <?php
              }
            }
            else
            {
              $search_msg = $_GET['search'];
              $result = $file_db->query("SELECT * FROM data_sell WHERE s_name LIKE '%$search_msg%' ORDER BY RecordID DESC");
              $numm = 0;
              while($row= $result->fetchArray()){
                ?>
                <div class="col-md-3">
                  <a href="?page=browse&id=<?php echo $row['s_post_id']?>">
                    <div class="metric">
                      <img src="uploads/<?php echo $row['s_post_id'].".".$row['s_pic_ext']?>" width="100%">
                      <hr width="80%"><p>
                        <span class="number"><?php echo $row['s_name']?></span>
                        <span class="title">ราคา <?php echo $row['s_price']?> บาท</span>
                      </p>
                    </div>
                  </a>
                </div>
                <?php
                $numm++;
              }
              if($numm == 0)
                echo "ไม่พบสินค้าที่ค้นหา";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
