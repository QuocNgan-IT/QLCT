<?php
include_once("dbconnection.php");
include_once("functionPHP.php");
if(!isset($_SESSION)) session_start(); 

// Đăng ký
  $min_income = 4000000; // 4 triệu

  if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cfmPassword = md5($_POST['cfr_password']);
    $name = trim($_POST['name'], " ");
    $name = preg_replace('/\s+/', ' ', $name);
    $gender = $_POST['gender'];
    $birthyear = $_POST['birthyear'];
    $income = $_POST['true_income']."000";

    $checkUsername = $conn->query("SELECT * FROM `nguoi_dung` WHERE tai_khoan LIKE '$username'");

    if ($income >= $min_income) {
      if (mysqli_num_rows($checkUsername) == 0) {
        if ($password == $cfmPassword) {
          $sql_nd = "INSERT INTO `nguoi_dung` VALUES(NULL, '$name', '$gender', '$birthyear', '$income', '$username', '$password');";
          
          $conn->query($sql_nd);

          $temp = $conn->query("SELECT ma_nd FROM `nguoi_dung` ORDER BY ma_nd DESC;")->fetch_array();
          $last_ma_nd = $temp[0];
                    
          $conn->query("INSERT INTO `ty_le_kcc` VALUES(NULL, '$last_ma_nd', '1', '50')");
          $conn->query("INSERT INTO `ty_le_kcc` VALUES(NULL, '$last_ma_nd', '2', '30')");
          $conn->query("INSERT INTO `ty_le_kcc` VALUES(NULL, '$last_ma_nd', '3', '20')");

          echo "<script type='text/javascript'>
                    alert('Đăng ký thành công!');
                    window.location = 'dangnhap.php';
                </script>";
          header("location:dangnhap.php");
        } else $_SESSION['err'] = "Mật khẩu chưa trùng khớp!";
      } else $_SESSION['err'] = "Tên người dùng đã tồn tại!";
    } else $_SESSION['err'] = "Thu nhập chưa đáp ứng điều kiện > 4 triệu đồng!";
    
  }

// Đăng nhập
  if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {

      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $sql = "SELECT * FROM nguoi_dung WHERE `tai_khoan`='$username' AND `mat_khau`='$password'";
      $data = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

      if (count($data) == 0)
          $_SESSION['err'] = "Tên tài khoản hoặc mật khẩu sai";
      else {
          $_SESSION['login'] = true;
          $_SESSION['ma_nd'] = $data[0]['ma_nd'];
          $_SESSION['ho_ten'] = $data[0]['ho_ten'];
          header("location:trangchu.php");
      }
    }
  }

// Edit user
  if (isset($_POST['edit_user'])) {

    $ma_nd = $_SESSION['ma_nd'];
    $password = md5($_POST['password']);
    $name = trim($_POST['name'], " ");
    $name = preg_replace('/\s+/', ' ', $name);
    $gender = $_POST['gender'];
    $income = $_POST['true_income']."000";

    $checkPassword = $conn->query("SELECT * FROM `nguoi_dung` WHERE ma_nd='$ma_nd' AND mat_khau='$password'");

    if ($income >= $min_income) {
      if (mysqli_num_rows($checkPassword) != 0) {
        $oldData = $conn->query("SELECT * FROM `nguoi_dung` WHERE ma_nd='$ma_nd'")->fetch_array();

        $oldName = $oldData['ho_ten'];
        $oldGender = $oldData['gioi_tinh'];
        $oldIncome = number_format($oldData['thu_nhap'],0,""," ") . " đ";
        $newIncome = number_format($income,0,""," ") . " đ";

        $sql = "UPDATE `nguoi_dung` SET ho_ten='$name', gioi_tinh='$gender', thu_nhap='$income' WHERE ma_nd='$ma_nd';";
        $conn->query($sql);

        checkBudgetAll();
        recordHistory(
          "Thay đổi thông tin người dùng", 
          "$oldName<br>$oldGender<br>$oldIncome", 
          "$name<br>$gender<br>$newIncome"
        );

        echo "<script type='text/javascript'>
                alert('Thay đổi thành công!');
                window.location = '';
              </script>";

      } else $_SESSION['err'] = "Mật khẩu sai!";
    } else $_SESSION['err'] = "Thu nhập chưa đáp ứng điều kiện > 4 triệu đồng!";  
  }

// Thêm khoản chi tiêu
  if (isset($_POST['add_kct'])) {
      
    $ma_nd = $_SESSION['ma_nd'];
    $ma_kcc = $_POST['ma_kcc'];
    $ten_kct = $_POST['ten_kct'];
    $tien_kct = $_POST['true_tien_kct']."000";
    $mota_kct = $_POST['mota_kct'];

    $conn->query("INSERT INTO `khoan_chi_tieu` VALUES(NULL, '$ma_kcc', '$ma_nd', '$ten_kct', '$tien_kct', '$mota_kct', DEFAULT)");
    $_SESSION['noti'] = true;
  
    $dataKcc = $conn->query("SELECT ten_kcc FROM `khoan_chi_chinh` WHERE ma_kcc='$ma_kcc'")->fetch_array();
    $ten_kcc = $dataKcc[0];
    $tien =number_format($tien_kct,0,""," ") . " đ";

    $mota_kct = trimStr($mota_kct);
    recordHistory(
      "Thêm khoản chi tiêu", 
      "", 
      "$ten_kct<br>$ten_kcc<br>$tien<br>$mota_kct"
    );
 
    // Kiểm tra vượt ngân sách
    checkBudget($ma_kcc);
    echo "<script type='text/javascript'>window.location = '';</script>";
  }

// Sửa khoản chi tiêu
  if (isset($_POST['edit_kct'])) {
      
    $ma_nd = $_SESSION['ma_nd'];
    $ma_kct = $_POST['ma_kct_edit'];
    $ma_kcc = $_POST['ma_kcc_edit'];
    $ten_kct = $_POST['ten_kct_edit'];
    $tien_kct = $_POST['true_tien_kct_edit']."000";
    $mota_kct = $_POST['mota_kct_edit'];
    
    $dataKct = $conn->query("SELECT *, `khoan_chi_tieu`.mo_ta as mota FROM `khoan_chi_tieu`, `khoan_chi_chinh` WHERE `khoan_chi_tieu`.ma_kcc=`khoan_chi_chinh`.ma_kcc AND `khoan_chi_tieu`.ma_nd=$ma_nd AND `khoan_chi_tieu`.ma_kct='$ma_kct';")->fetch_array();

    $oldTenKct = $dataKct['ten_kct'];
    $tenKcc = $dataKct['ten_kcc'];
    $oldTien = number_format($dataKct['so_tien'],0,""," ") . " đ";
    $newTien = number_format($tien_kct,0,""," ") . " đ";
    $oldMota = $dataKct['mota'];
    $newMota = $mota_kct;
    $oldNgayChi = $dataKct['ngay_chi'];

    $conn->query("UPDATE `khoan_chi_tieu` SET ten_kct='$ten_kct', so_tien='$tien_kct', mo_ta='$mota_kct' WHERE ma_kct='$ma_kct' AND ma_nd='$ma_nd';");

    if (isset($_POST['updateTime'])) {
      $conn->query("UPDATE `khoan_chi_tieu` SET ngay_chi=DEFAULT WHERE ma_kct='$ma_kct' AND ma_nd='$ma_nd';");
    }

    $dataNgayChi = $conn->query("SELECT ngay_chi FROM `khoan_chi_tieu` WHERE ma_kct='$ma_kct' AND ma_nd='$ma_nd';")->fetch_array();
    $newNgayChi = $dataNgayChi[0];

    $oldMota = trimStr($oldMota);
    $newMota = trimStr($newMota);
    recordHistory(
      "Sửa khoản chi tiêu", 
      "$oldTenKct<br>$tenKcc<br>$oldTien<br>$oldMota<br>$oldNgayChi", 
      "$ten_kct<br>$tenKcc<br>$newTien<br>$newMota<br>$newNgayChi"
    );
    $_SESSION['noti'] = true; 
    // Xử lý vượt ngân sách
    checkBudget($ma_kcc);
    echo "<script type='text/javascript'>window.location = '?kcc=$ma_kcc';</script>";
  }

// Xóa khoản chi tiêu
  if (isset($_POST['delete_kct'])) {
    $ma_kct = $_POST['ma_kct_delete'];
    $ma_kcc = $_POST['ma_kcc_delete'];

    $dataKct = $conn->query("SELECT *, `khoan_chi_tieu`.mo_ta as mota FROM `khoan_chi_tieu`, `khoan_chi_chinh` WHERE `khoan_chi_tieu`.ma_kcc=`khoan_chi_chinh`.ma_kcc AND `khoan_chi_tieu`.ma_nd=$ma_nd AND `khoan_chi_tieu`.ma_kct='$ma_kct';")->fetch_array();

    $ten_kct = $dataKct['ten_kct'];
    $ten_kcc = $dataKct['ten_kcc'];
    $tien = number_format($dataKct['so_tien'],0,""," ") . " đ";
    $mota_kct = trimStr($dataKct['mota']);
    $ngay_chi = $dataKct['ngay_chi'];

    recordHistory(
      "Xóa khoản chi tiêu", 
      "", 
      "$ten_kct<br>$ten_kcc<br>$tien<br>$mota_kct<br>$ngay_chi"
    );
    
    $conn->query("DELETE FROM `khoan_chi_tieu` WHERE ma_kct='$ma_kct';");

    $_SESSION['noti'] = true; 

    // Xử lý vượt ngân sách
    checkBudget($ma_kcc);
    echo "<script type='text/javascript'>window.location = '?kcc=$ma_kcc';</script>";
  }

// Điều chỉnh tỷ lệ các khoản chi chính
  if (isset($_POST['fix_tyLe'])) {
    $ma_nd = $_SESSION['ma_nd'];
    $thuNhap = $_POST['thuNhap'];
    $tyLe1 = $_POST['tyLe1'];
    $tyLe2 = $_POST['tyLe2'];
    $tyLe3 = $_POST['tyLe3'];

    $temp = $conn->query("SELECT ty_le FROM `ty_le_kcc` WHERE ma_nd='$ma_nd' ORDER BY ma_kcc ASC");
    $i = 1;
    foreach ($temp as $tempData) {
      ${"tyLeCu".$i} = $tempData['ty_le'];
      $i++;
    }

    $nganSachCu1 = number_format(($thuNhap*$tyLeCu1/100),0,""," ");
    $nganSachCu2 = number_format(($thuNhap*$tyLeCu2/100),0,""," ");
    $nganSachCu3 = number_format(($thuNhap*$tyLeCu3/100),0,""," ");
    
    $nganSachMoi1 = number_format(($thuNhap*$tyLe1/100),0,""," ");
    $nganSachMoi2 = number_format(($thuNhap*$tyLe2/100),0,""," ");
    $nganSachMoi3 = number_format(($thuNhap*$tyLe3/100),0,""," ");

    $conn->query("UPDATE `ty_le_kcc` SET ty_le='$tyLe1' WHERE ma_nd='$ma_nd' AND ma_kcc='1'");
    $conn->query("UPDATE `ty_le_kcc` SET ty_le='$tyLe2' WHERE ma_nd='$ma_nd' AND ma_kcc='2'");
    $conn->query("UPDATE `ty_le_kcc` SET ty_le='$tyLe3' WHERE ma_nd='$ma_nd' AND ma_kcc='3'");

    recordHistory(
      "Điều chỉnh tỷ lệ các khoản chi",
      "$nganSachCu1 đ ($tyLeCu1 %)<br>$nganSachCu2 đ ($tyLeCu2 %)<br>$nganSachCu3 đ($tyLeCu3 %)",
      "$nganSachMoi1 đ ($tyLe1 %)<br>$nganSachMoi2 đ ($tyLe2 %)<br>$nganSachMoi3 đ($tyLe3 %)"
    );

    $_SESSION['noti'] = true; 

    checkBudget(1);
    checkBudget(2);
    checkBudget(3);

    // echo "<script>
    //   alert(".$nganSachCu1.");
    // </script>";
  }