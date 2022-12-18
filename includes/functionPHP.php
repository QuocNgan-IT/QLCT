<?php
// 
  function trimStr($str) {
    if(strlen($str) > 30) return substr($str, 0, 30) . "...";
    else return $str;
  }

  function getThuNhap() {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    $data_user = $conn->query("SELECT * FROM `nguoi_dung` WHERE ma_nd='$ma_nd'")->fetch_array();

    return $data_user['thu_nhap'];
  }

  function getNameKCC($ma_kcc) {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    $data_kcc = $conn->query("SELECT ten_kcc FROM `khoan_chi_chinh` WHERE ma_kcc='$ma_kcc';")->fetch_array();

    return $data_kcc[0];
  }

  function getNganSach($ma_kcc) {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    $data_user = $conn->query("SELECT * FROM `nguoi_dung` WHERE ma_nd='$ma_nd'")->fetch_array();
    $data_tyle = $conn->query("SELECT ty_le FROM `ty_le_kcc` WHERE ma_nd='$ma_nd' AND ma_kcc='$ma_kcc';")->fetch_array();

    $ngan_sach = $data_user['thu_nhap']*$data_tyle[0]/100;

    return $ngan_sach;
  }

  function getTongChi($ma_kcc) {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

    $data_tongchi = $conn->query("SELECT SUM(so_tien) FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='$ma_kcc' AND $timerange;")->fetch_array();
    $tong_chi = $data_tongchi[0];

    if (!$tong_chi) return 0;
    return $tong_chi;
  }

  function checkBudget($ma_kcc) {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    $ngan_sach = getNganSach($ma_kcc);
    $tong_chi = getTongChi($ma_kcc);
    
    if ($tong_chi > $ngan_sach) {
      $result_noti = $conn->query("SELECT * FROM `thong_bao` WHERE ma_nd='$ma_nd' AND ma_ndtb='$ma_kcc';");

      if (mysqli_num_rows($result_noti) != 0) {
        $data_noti = $result_noti->fetch_array();

        if ($data_noti['trang_thai'] == 1) {
          $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT WHERE ma_nd='$ma_nd' AND ma_ndtb='$ma_kcc';");
        } else {
          $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT, trang_thai='1' WHERE ma_nd='$ma_nd' AND ma_ndtb='$ma_kcc';");
        }
      } else {
        $conn->query("INSERT INTO `thong_bao` VALUES(NULL, '$ma_nd', '$ma_kcc', DEFAULT, '1')");
      }    
    } else {
      $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT, trang_thai='0' WHERE ma_nd='$ma_nd' AND ma_ndtb='$ma_kcc';");
    }
  }

  function checkBudgetAll() {

    include("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    for ($i=1; $i<=3; $i++) {
      $ngan_sach = getNganSach($i);
      $tong_chi = getTongChi($i);
      
      if ($tong_chi > $ngan_sach) {
        $result_noti = $conn->query("SELECT * FROM `thong_bao` WHERE ma_nd='$ma_nd' AND ma_ndtb='$i';");

        if (mysqli_num_rows($result_noti) != 0) {
          $data_noti = $result_noti->fetch_array();

          if ($data_noti['trang_thai'] == 1) {
            $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT WHERE ma_nd='$ma_nd' AND ma_ndtb='$i';");
          } else {
            $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT, trang_thai='1' WHERE ma_nd='$ma_nd' AND ma_ndtb='$i';");
          }
        } else {
          $conn->query("INSERT INTO `thong_bao` VALUES(NULL, '$ma_nd', '$ma_kcc', DEFAULT, '1')");
        }    
      } else {
        $conn->query("UPDATE `thong_bao` SET ngay_tb=DEFAULT, trang_thai='0' WHERE ma_nd='$ma_nd' AND ma_ndtb='$i';");
      }
    }    
  }

// 
  function recordHistory($ten_hd, $noi_dung_cu, $noi_dung_moi) {

    require("dbconnection.php");
    $ma_nd = $_SESSION['ma_nd'];

    $conn->query("INSERT INTO `lich_su_hd` VALUES(NULL, '$ma_nd', '$ten_hd', '$noi_dung_cu', '$noi_dung_moi', DEFAULT);");
  }