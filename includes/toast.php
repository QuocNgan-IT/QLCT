<div 
  class="toast-fixed end-0 mb-10"
  id="toast-container"  
  style="width: 350px; display: block; top: unset; left: unset; transform: unset; z-index: 600;"
>
  <!-- Warning Toasts -->
  <div
    class="toast toast-danger fade mx-auto mb-2"
    id="warning-toast"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-mdb-container="toast-container"
    data-mdb-autohide="true"
    data-mdb-delay="5000"
    data-mdb-append-to-body="true"
    data-mdb-stacking="true"
    data-mdb-color="danger"
  >
    <div class="toast-header toast-danger">
      <i class="fas fa-exclamation-circle fa-lg me-2"></i>
      <strong class="me-auto">QLCT Thông báo</strong>
      <small></small>
      <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    <?php
    include_once("dbconnection.php");
    
      $ma_nd = $_SESSION['ma_nd'];
      $result_noti = $conn->query("SELECT * FROM `thong_bao`,`noi_dung_tb` WHERE `thong_bao`.ma_ndtb=`noi_dung_tb`.ma_ndtb AND `thong_bao`.ma_nd='$ma_nd' AND `thong_bao`.trang_thai='1' ORDER BY `thong_bao`.ngay_tb DESC;");

      foreach ($result_noti as $data_noti) {
        echo "<p>- " . $data_noti['noi_dung'] . "</p>";
      }
    ?>
    </div>
  </div>

  <!-- Notification Toasts -->
  <div
    class="toast toast-success fade mx-auto mb-2"
    id="notification-toast"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-mdb-container="toast-container"
    data-mdb-autohide="true"
    data-mdb-delay="3000"
    data-mdb-append-to-body="true"
    data-mdb-stacking="true"
    data-mdb-color="success"
  >
    <div class="toast-header toast-success">
      <i class="fas fa-check fa-lg me-2"></i>
      <strong class="me-auto">QLCT Thông báo</strong>
      <small>vừa xong</small>
      <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">Tác vụ thành công</div>
  </div>

</div>
  