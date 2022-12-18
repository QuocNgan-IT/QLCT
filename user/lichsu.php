<?php
  if(!isset($_SESSION)) session_start(); 
  include("../includes/dbconnection.php");

  $ma_nd = $_SESSION['ma_nd'];
  $result_lich_su = $conn->query("SELECT * FROM `lich_su_hd` WHERE ma_nd='$ma_nd' ORDER BY ngay DESC");
?>

<!-- <div class="overflow-auto" style="max-height: 10rem;"> -->
  <!-- Section: Timeline -->
  <section class="ms-3">
    <ul class="timeline-with-icons">
      <?php if (mysqli_num_rows($result_lich_su) == 0) echo "Chưa có lịch sử hoạt động!"; ?>
      <?php
       foreach ($result_lich_su as $data_lich_su) { 

          switch ($data_lich_su['ten_hd']) {
            case "Thêm khoản chi tiêu": {
              $column = 1;
              $icon = "hand-holding-usd";
              $color = "primary";
              $label = "Khoản chi:<br>Khoản chi chính:<br>Số tiền:<br>Mô tả:";

              break;
            }
            case "Sửa khoản chi tiêu": {
              $column = 2;
              $icon = "edit";
              $color = "success";
              $label = "Khoản chi tiêu:<br>Khoản chi chính:<br>Số tiền:<br>Mô tả:<br>Ngày chi:";
              
              break;
            }
            case "Xóa khoản chi tiêu": {
              $column = 1;
              $icon = "trash";
              $color = "secondary";
              $label = "Khoản chi:<br>Khoản chi chính:<br>Số tiền:<br>Mô tả:<br>Ngày chi:";

              break;
            }
            case "Thay đổi thông tin người dùng": {
              $column = 2;
              $icon = "user-edit";
              $color = "warning";
              $label = "Tên:<br>Giới tính:<br>Thu nhập:";

              break;
            }
            case "Điều chỉnh tỷ lệ các khoản chi": {
              $column = 2;
              $icon = "edit";
              $color = "warning";
              $label = "Thiết yếu:<br>Linh hoạt:<br>Tiết kiệm, đầu tư:";

              break;
            }

            default: {
              $column = 1;
              $icon = "";
              $color = "";
              $label = "";
            }
          }
      ?>        
      <li class="timeline-item mb-5 rounded-6 p-3 bg-<?php echo $color; ?> bg-gradient" style="--mdb-bg-opacity: 0.4;">
        <span class="timeline-icon">
          <i class="fas fa-<?php echo $icon; ?> text-primary fa-sm fa-fw"></i>
        </span>

        <h5 class="fw-bolder"><?php echo $data_lich_su['ten_hd']; ?></h5>
        <p class="text-muted mb-2"><?php echo $data_lich_su['ngay']; ?></p>
        <div class="text-muted fw-bold" style="font-size: min(14px, 2.5vw);">
          <div class="d-flex align-items-start">          
            <span class="me-1" style="min-width: 10rem;">
            <?php echo $label; ?>
            </span>
          <?php if($column == 2): ?>
            <span class="mx-1 pe-3 text-end" style="min-width: 12rem;">
              <?php echo $data_lich_su['noi_dung_cu']; ?>
            </span>
            <strong class="mx-1  align-self-center" style="min-width: 1rem;"><i class='fas fa-arrow-right'></i></strong>
          <?php endif; ?>
            <span class="ms-2 pe-3 text-end" style="min-width: 12rem;">
              <?php echo $data_lich_su['noi_dung_moi']; ?>
            </span>
          </div>
        </d>
      </li>
      <?php } ?>
    </ul>
  </section>
  <!-- Section: Timeline -->
<!-- </div> -->
