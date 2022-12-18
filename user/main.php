<?php
  if(!isset($_SESSION)) session_start(); 
  include("../includes/dbconnection.php");
  include("../includes/functionPHP.php");
  
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

  $ma_nd = $_SESSION['ma_nd'];

  $result_kcc = $conn->query("SELECT * FROM `khoan_chi_chinh`");
  $i = 0; $color = array("primary", "info", "success");
?>

<!-- Render 3 khoản chi chính -->
<?php foreach ($result_kcc as $data_kcc) { 

  $ma_kcc = $data_kcc['ma_kcc'];  
  $ten_kcc = $data_kcc['ten_kcc'];  
  $ngan_sach = getNganSach($ma_kcc);
  $tong_chi = getTongChi($ma_kcc);

  $progres_kcc = round($tong_chi/$ngan_sach*100, 1);
  
  if ($tong_chi > $ngan_sach) {
    $bgcolor = "danger";
  } else $bgcolor = $color[$i];  

  // Hiện thông báo nếu có
  $result_noti = $conn->query("SELECT * FROM `thong_bao` WHERE ma_nd='$ma_nd' AND trang_thai='1';");

  if (mysqli_num_rows($result_noti) != 0) echo "<script>showWarn();</script>";
?>
<div class="card">
  <div class="card-header bg-<?php echo $color[$i]; ?> bg-gradient text-white text-uppercase font-weight-bold row m-0">
    <span class="col align-self-center"><?php echo $ten_kcc; ?></span>
    <!-- Edit btn -->
    <span class="col text-end"><a href="trangchitiet.php?kcc=<?php echo $ma_kcc; ?>">
      <button type="button" class="text-end btn btn-outline-light btn-<?php echo $color[$i]; ?> bg-gradient rounded">
        <i class='fas fa-edit'></i>
      </button>
    </a></span>
    
  </div>     
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <div class="text-start">Ngân sách:</div>
      <div class="text-success text-end" style="font-weight: bolder; font-size: larger;">
        <?php
          echo number_format($ngan_sach,0,""," "); 
        ?>
        <span>đ</span>
      </div>
      <br>
      <footer class="blockquote-footer" style="font-size: smaller;">
        <?php echo $data_kcc['mo_ta']; ?>
      </footer>
    </blockquote>
    <hr>  
    <a
      aria-current="true"
      data-mdb-toggle="collapse"
      href="#khoanchi<?php echo $i; ?>"
      aria-expanded="true"
      aria-controls="khoanchi<?php echo $i; ?>"
    > 
      <div class="row">
        <span>Số tiền đã chi:</span>
        <div class="col-10">
          <div class="progress rounded-pill" style="height: 30px;">
            <div 
              class="progress-bar progress-bar-striped bg-<?php echo $bgcolor; ?> rounded-pill" 
              role="progressbar" 
              style="width: <?php echo $progres_kcc; ?>%;" 
              aria-valuenow="<?php echo $progres_kcc; ?>" 
              aria-valuemin="0" 
              aria-valuemax="100"
              >
              <?php echo $progres_kcc; ?>%
            </div>
          </div> 
        </div>
        <div class="col text-success text-end" style="font-weight: bold; font-size: large; min-width: 150px;">
          <?php echo number_format(($tong_chi),0,""," "); ?>
          <span>đ</span>
        </div>
      </div>      
      <hr>
      <!-- Collapsed khoản chi -->
      <ul id="khoanchi<?php echo $i; ?>" class="collapse list-group list-group-flush overflow-auto" style="max-height: 30rem;">
        <?php
          $result_kct = $conn->query("SELECT * FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='$ma_kcc' AND $timerange ORDER BY so_tien DESC");              

          foreach ($result_kct as $data_kct) {
            $progres_kct = round($data_kct['so_tien']/$ngan_sach*100, 1);
        ?>
        <li 
          class="list-group-item my-2" 
          data-mdb-toggle="tooltip"
          data-mdb-placement="top" 
          title="
            Mô tả: <?php echo $data_kct['mo_ta']; ?>
            Ngày chi: <?php echo $data_kct['ngay_chi']; ?>
          "
        >
          <span><?php echo $data_kct['ten_kct']; ?></span>
          <div class="row">
            <div class="col-10">
              <div class="progress rounded-pill" style="height: 20px;">
                <div 
                  class="progress-bar progress-bar-striped bg-<?php echo $bgcolor; ?> rounded-pill" 
                  role="progressbar" 
                  style="width: <?php echo $progres_kct; ?>%;" 
                  aria-valuenow="<?php echo $progres_kct; ?>" 
                  aria-valuemin="0" 
                  aria-valuemax="100"
                >
                  <?php echo $progres_kct; ?>%
                </div>
              </div> 
            </div>
            <div class="col text-success text-end" style="font-weight: bold; min-width: 130px;">
              <?php echo number_format($data_kct['so_tien'],0,""," "); ?>
              <span>đ</span>
            </div>
          </div>                        
        </li>
        <?php } ?>
      </ul>  
    </a>
  </div>
</div>
<br>
<?php $i++;}  ?>

<?php if (isset($_SESSION['noti'])) {
  echo "<script> showNoti(); </script>";
  unset($_SESSION['noti']); }?>