<?php
//  include("functionPHP.php");
  $ma_kcc = $_GET['kcc'];
  $result_kcc = $conn->query("SELECT * FROM `khoan_chi_chinh`");
  $i = 1;

  $ma_nd = $_SESSION['ma_nd'];
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

  $data_user = $conn->query("SELECT * FROM `nguoi_dung` WHERE ma_nd='$ma_nd'")->fetch_array();
  $thuNhap = $data_user['thu_nhap'];

  $result_tyle = $conn->query("SELECT * FROM `ty_le_kcc` WHERE ma_nd='$ma_nd'");
  $j = 1;
  foreach ($result_tyle as $data_tyle) {
    ${"tyLe" . $j} = $data_tyle['ty_le'];

    $data_tongchi = $conn->query("SELECT SUM(so_tien) FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='$j' AND $timerange;")->fetch_array();
    ${"tongChi" . $j} = $data_tongchi[0];

    $j++;
  }
?>
<!--Main Navigation-->
<header style="margin-top: 5rem;">
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-2 my-4">
        <!-- Home -->
        <a 
          href="<?php echo BASE_URL."/index.php" ?>"
          class="list-group-item list-group-item-action py-3 ripple"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Trang chính</span>
        </a>
        <a 
          href="#"
          data-mdb-toggle="modal" 
          data-mdb-target="#fixModal"
          data-mdb-thuNhap="<?php echo $thuNhap; ?>"
          data-mdb-tongChi1="<?php echo $tongChi1; ?>"
          data-mdb-tongChi2="<?php echo $tongChi2; ?>"
          data-mdb-tongChi3="<?php echo $tongChi3; ?>"
          data-mdb-tyLe1="<?php echo $tyLe1; ?>"
          data-mdb-tyLe2="<?php echo $tyLe2; ?>"
          data-mdb-tyLe3="<?php echo $tyLe3; ?>"
        >
          <button type="button" class="btn btn-secondary">
            <i class='fas fa-cogs'> Điều chỉnh tỷ lệ các khoản chi chính</i>
          </button>
        </a>
        <!-- Render kcc -->
        <?php foreach($result_kcc as $data_kcc) { ?>
        <a 
          id="kcc<?php echo $i; ?>"
          href="#"
          class="list-group-item list-group-item-action py-3 ripple"
          aria-current="true"
        >
          <div class="d-flex align-items-center text-center">
            <i class='fas fa-edit fa-fw me-3'></i> 
            <span class="me-3"><?php echo $data_kcc['ten_kcc']; ?></span>
          </div> 
        </a>
        <?php $i++;} ?>
      </div>
      <div class="text-center mt-5">
        <img src="../assets/images/budget-management.png" class="img-fluid" style="object-fit: cover; min-height: 10rem;" alt="image">
      </div>      
      </div>
    </div>
  </nav>
</header>

<!--Main layout-->
<main style="margin-top: 5rem; min-height: 100vh;">
  <div id="content1" class="container pt-4"></div>
</main>

<!-- Back to top -->
<style>
  #btn-back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
  }
</style>
<button
  type="button"
  class="btn btn-info btn-floating btn-lg"
  id="btn-back-to-top"
  >
  <i class="fas fa-arrow-up"></i>
</button>

<script type="text/javascript">
    setTimeout(function(){
      document.getElementById("kcc<?php echo $ma_kcc; ?>").click();	
    }, 500);
</script>

<?php include("../includes/footer.php"); ?>