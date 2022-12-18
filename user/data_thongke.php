<?php 
header('Content-Type: application/json');
include("../includes/action.php");
if(!isset($_SESSION)) session_start(); 

  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";
  $timerange2 = "YEAR(ngay_chi)>=YEAR(DATE_ADD(CURDATE(),INTERVAL 0 YEAR))";
  $ma_nd = $_SESSION['ma_nd'];

  if(isset($_GET['period']))
    switch ($_GET['period']) {
      case 'day': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND $timerange GROUP BY DATE(ngay_chi);");
        break;
      }

      case 'week': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, CONCAT(DATE_FORMAT(ngay_chi, '%d-'), DATE_FORMAT(DATE_ADD(ngay_chi, INTERVAL 6 DAY), '%d'), DATE_FORMAT(ngay_chi,'/%m')) AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND $timerange GROUP BY WEEK(ngay_chi);");
        break;
      }

      case 'month': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%m/%Y') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND $timerange2 GROUP BY MONTH(ngay_chi);");
        break;
      }

      default: {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND $timerange GROUP BY DATE(ngay_chi);");
      }
    }

  $data = array();
  foreach ($result_sql as $data_sql) {
    // $data[] = $data_sql;
    array_push($data, array('so_tien' => $data_sql['so_tien'], 'ngay' => $data_sql['ngay']));
  }

  $thuNhap = getThuNhap();
  $tongChiChung = getTongChi(1)+getTongChi(2)+getTongChi(3);
  $nganSach1 = getNganSach(1); $tongChi1 = getTongChi(1);
  $nganSach2 = getNganSach(2); $tongChi2 = getTongChi(2);
  $nganSach3 = getNganSach(3); $tongChi3 = getTongChi(3);

  array_push($data, array('thu_nhap' => $thuNhap, 'tong_chi_chung' => $tongChiChung, 'ngan_sach1' => $nganSach1, 'tong_chi1' => $tongChi1, 'ngan_sach2' => $nganSach2, 'tong_chi2' => $tongChi2, 'ngan_sach3' => $nganSach3, 'tong_chi3' => $tongChi3));

  $data_day = json_encode($data);
  echo $data_day;
?>