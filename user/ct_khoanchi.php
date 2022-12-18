<?php
  if(!isset($_SESSION)) session_start(); 
  include("../includes/dbconnection.php");
  include("../includes/functionPHP.php");

  $ma_kcc = $_GET['kcc'];
  
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

  $ma_nd = $_SESSION['ma_nd'];

  $data_kcc = $conn->query("SELECT * FROM `khoan_chi_chinh` WHERE ma_kcc='$ma_kcc';")->fetch_array();
  $color = array("primary", "info", "success");

  $ten_kcc = $data_kcc['ten_kcc'];  
  $ngan_sach = getNganSach($ma_kcc);
  $tong_chi = getTongChi($ma_kcc);

  $progres_kcc = round($tong_chi/$ngan_sach*100, 1);
  
  if ($tong_chi > $ngan_sach) {
    $bgcolor = "danger";
  } else $bgcolor = $color[$ma_kcc-1];  
  
  // Hiện thông báo nếu có
  if (isset($_SESSION['noti'])) {
    echo "<script> showNoti(); </script>";
    unset($_SESSION['noti']); }
  $result_noti = $conn->query("SELECT * FROM `thong_bao` WHERE ma_nd='$ma_nd' AND trang_thai='1';");

  if (mysqli_num_rows($result_noti) != 0) echo "<script>showWarn();</script>";

  // get data for fixModal
  $thu_nhap = getThuNhap();

  $result_tyle = $conn->query("SELECT * FROM `ty_le_kcc` WHERE ma_nd='$ma_nd'");
  $i = 1;
  foreach ($result_tyle as $data_tyle) {
    ${"tyLe" . $i++} = $data_tyle['ty_le'];
  }
?>
<!--  -->
<div class="card">    
  <input type="hidden" id="KCC" value="<?php echo $ma_kcc; ?>">
  <div class="card-header bg-<?php echo $color[$ma_kcc-1]; ?> bg-gradient text-white text-uppercase font-weight-bold">
    <span><?php echo $ten_kcc; ?></span>
  </div>     
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <div class="row text-start">Số tiền ước lượng:</div>
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
      <ul id="khoanchi<?php echo $ma_kcc-1; ?>" class="collapse show list-group list-group-flush">
        <hr>
          <table id="dataTable" class="table table-bordered table-striped  table-hover">
            <thead>
              <tr class="bg-light text-primary">  
                <th>
                  Tên khoản chi
                </th>  
                <th>
                  Số tiền
                </th>  
                <th>
                  Mô tả
                </th>  
                <th>
                  Ngày chi
                </th>  
                <th>
                  
                </th>  
              </tr>  
            </thead>					
          </table>
      </ul>     
  </div>
</div>
<br>

<script>  
  $(document).ready(function(){	
    var kcc = $("#KCC").val();
    var kcData = $('#dataTable').DataTable({
      "lengthChange":true,
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"action.php",
        type:"POST",
        data:{action:'dsKhoanChi',kcc:kcc},
        dataType:"json"
      },
      "columnDefs":[
        {
          "targets":[2, 4],
          "orderable":false,
        },
        {
          "targets": 1,
          className: 'dt-body-right'
        },
        {
          "targets": 4,
          className: 'dt-body-center'
        },
      ],
      "columns": [
        { "width": "20%" },
        { "width": "15%" },
        { "width": "40%" },
        { "width": "15%" },
        { "width": "10%" }
      ],
      "pageLength": 10
    });		
  });
</script>  

<?php if (isset($_SESSION['noti'])) {
  echo "<script> showNoti(); </script>";
  unset($_SESSION['noti']); }?> 
