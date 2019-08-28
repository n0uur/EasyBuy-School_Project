<?php
if($SEC == false) die("DIE!");

?>

<div class="main-content">
  <div class="container-fluid">
    <h3 class="page-title">หน้าหลัก</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
					<div class="panel-heading">
					</div>
          <center>
            <a href="?page=sell"><img src="assets/img/new.png" width="20%" draggable="false"></a>
            <a href="?page=looking"><img src="assets/img/sell.png" width="20%" draggable="false"></a>
            <br><hr width="50%">
            <h3>ค้นหาสินค้า</h3>
            <form method="post">
    					<div class="input-group col-md-6">
    						<input name="search" type="text" value="" class="form-control" placeholder="ค้นหาสินค้า">
    						<span class="input-group-btn"><button type="submit" class="btn btn-primary">ค้นหา</button></span>
    					</div>
    				</form>
          </center>
          </div>
      </div>
    </div>
  </div>
</div>
