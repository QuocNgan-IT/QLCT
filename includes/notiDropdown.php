<?php
include_once("dbconnection.php");

  $ma_nd = $_SESSION['ma_nd'];
  $result_thongbao = $conn->query("SELECT * FROM `thong_bao` WHERE ma_nd='$ma_nd' AND trang_thai='1';");
  $data_thongbao = $result_thongbao->fetch_array();

  $result_tb_ngansach = $conn->query("SELECT * FROM `thong_bao`,`noi_dung_tb` WHERE `thong_bao`.ma_ndtb=`noi_dung_tb`.ma_ndtb AND `thong_bao`.ma_nd='$ma_nd' AND `thong_bao`.trang_thai='1' AND (`thong_bao`.ma_ndtb='1' OR `thong_bao`.ma_ndtb='2' OR `thong_bao`.ma_ndtb='3') ORDER BY `noi_dung_tb`.ma_ndtb ASC;");

  $num = mysqli_num_rows($result_thongbao);
  $num1 = mysqli_num_rows($result_tb_ngansach);
?>
<!-- Notification dropdown -->
<li class="nav-item dropdown">
  <a
    class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
    href="#"
    id="navbarDropdownMenuLink"
    role="button"
    data-mdb-toggle="dropdown"
    data-mdb-auto-close="outside"
    aria-expanded="false"
  >
    <i class="fas fa-bell"></i>
    <?php if($num!=0) 
      echo "<span class='badge rounded-pill badge-notification bg-danger'>
            $num 
          </span>"; ?>    
  </a>
  <ul
    class="dropdown-menu dropdown-menu-end"
    aria-labelledby="navbarDropdownMenuLink"
  >
    <li class="nav-item dropdown">
      <a 
        class="dropdown-item list-group-item list-group-item-action" 
        href="#tb_ngansach"
        role="button"
        data-mdb-toggle="collapse"
        aria-current="true"
        aria-expanded="false"
        aria-controls="tb_ngansach"
      >
        Vượt ngân sách 
        <?php if($num1!=0) 
          echo "<span class='badge rounded-pill bg-danger'>
                $num1 
              </span>"; ?>  
      </a>
        <ul id="tb_ngansach" class="collapse list-group list-group-flush mb-1">
        <?php foreach ($result_tb_ngansach as $data_tb_ngansach) { ?>
          <a href="trangchitiet.php?kcc=<?php echo $data_tb_ngansach['ma_ndtb']; ?>" class="list-group-item list-group-item-action text-danger">
            <li><span><?php echo $data_tb_ngansach['noi_dung']; ?></span></li>            
          </a>
        <?php } ?>
        </ul> 
    </li>
    <li>
      <a class="dropdown-item" href="#">Thông báo khác</a>
    </li>
  </ul>
</li>    