<?php 
header('Content-Type: application/json');
include("../includes/action.php");
if(!isset($_SESSION)) session_start(); 

  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";
  $ma_nd = $_SESSION['ma_nd'];
  $ma_KCC = $_GET['KCC'];

  if(isset($ma_KCC))
    switch ($ma_KCC) {
      case '1': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='1' AND $timerange GROUP BY DATE(ngay_chi);");
        break;
      }

      case '2': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='2' AND $timerange GROUP BY DATE(ngay_chi);");
        break;
      }

      case '3': {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='3' AND $timerange GROUP BY DATE(ngay_chi);");
        break;
      }

      default: {
        $result_sql = $conn->query("SELECT SUM(so_tien) AS so_tien, DATE_FORMAT(ngay_chi, '%d/%m') AS ngay FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='1' AND $timerange GROUP BY DATE(ngay_chi);");
      }
    }

  $data = array();
  $tong_tien = 0;
  foreach ($result_sql as $data_sql) {
    // $data[] = $data_sql;
    $tong_tien += $data_sql['so_tien'];
    array_push($data, array('so_tien' => $tong_tien, 'ngay' => $data_sql['ngay']));
  }

  $tenKCC = getNameKCC($ma_KCC);

  // ước lượng ngày cuối tháng
  $KCC = $_GET['KCC'];
  $nganSach = getNganSach($KCC);
  $tongChi = getTongChi($KCC);
  $temp = $conn->query("SELECT ROUND(AVG(so_tien), 0) FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='$KCC' AND $timerange ORDER BY ngay_chi DESC")->fetch_array();
  $chiTieuTB = $temp[0];
  $temp = $conn->query("SELECT DAY(ngay_chi) FROM `khoan_chi_tieu` WHERE ma_nd='$ma_nd' AND ma_kcc='$KCC' AND $timerange ORDER BY ngay_chi DESC")->fetch_array();
  $ngayChiCuoi = $temp[0];
  $ngayCuoiThang =  date("t", strtotime(date('m')));
 
  if ($ngayChiCuoi == $ngayCuoiThang);
  else {
    $chiTB = round($tongChi/$ngayChiCuoi);
    $ngayConLai = $ngayCuoiThang-$ngayChiCuoi;
    $tienUocLuong = $tong_tien+($chiTB*$ngayConLai);

    // data ước lượng cho ngày cuối tháng
    array_push($data, array('so_tien' => $tienUocLuong, 'ngay' => $ngayCuoiThang.'/'.date('m')));
  }

  $tongChiChung = getTongChi(1)+getTongChi(2)+getTongChi(3);
  $thuNhap = getThuNhap();
  $buTru1 = getNganSach(1)-getTongChi(1);
  $buTru2 = getNganSach(2)-getTongChi(2);
  $buTru3 = getNganSach(3)-getTongChi(3);
  $maxBuTru = max($buTru1,$buTru2,$buTru3);

  if ($tienUocLuong > $nganSach) {
    $color = 'orange';
    $duDoan = "Sẽ vượt ngân sách";

    if ($maxBuTru == $buTru1) {
      $goiY = "<a href='../user/trangchitiet.php?kcc=1#'>Điều chỉnh tỷ lệ các khoản chi:</a> <br> 
      <i class='fas text-danger fa-caret-down'> Thiết yếu</i><br>
      <i class='fas text-success fa-caret-up'> 2 khoản chi còn lại</i>";
    }
    if ($maxBuTru == $buTru2) {
      $goiY = "<a href='../user/trangchitiet.php?kcc=2#'>Điều chỉnh tỷ lệ các khoản chi:</a> <br> 
      <i class='fas text-danger fa-caret-down'> Linh hoạt</i><br>
      <i class='fas text-success fa-caret-up'> 2 khoản chi còn lại</i>";
    }
    if ($maxBuTru == $buTru3) {
      $goiY = "<a href='../user/trangchitiet.php?kcc=3#'>Điều chỉnh tỷ lệ các khoản chi:</a> <br> 
      <i class='fas text-danger fa-caret-down'> Tiết kiệm, đầu tư</i><br>
      <i class='fas text-success fa-caret-up'> 2 khoản chi còn lại</i>";
    }
  } else {
    $color = 'green';
    $duDoan = "Vẫn trong ngân sách";
    $goiY = "<br>Hãy giữ vững phong độ :D";
  }
  if ($tongChi > $nganSach) {
    $color = 'red';
    $duDoan = "Hiện đã vượt ngân sách";

    if($tongChiChung > $thuNhap) {
      $goiY = "Tăng ngân sách bằng cách <br> <a href='../user/nguoidung.php'>điều chỉnh mức thu nhập</a> <br> Hoặc xóa các khoản chi <br>không cần thiết!";
    } else  {
      $goiY = "<a href='../user/trangchitiet.php?kcc=".$KCC."#'>Điều chỉnh tỷ lệ các khoản chi:</a> <br> 
      <i class='fas text-danger fa-caret-down'> khoản chi hiện tại</i><br>
      <i class='fas text-success fa-caret-up'> 2 khoản chi còn lại</i>";
    }
  }  

  array_push($data, array('ten_KCC' => $tenKCC, 'ngan_sach' => $nganSach, 'tong_chi' => $tongChi, 'chi_tb' => $chiTieuTB, 'chi_tb_ngay' => $chiTB, 'du_doan' => $duDoan, 'color' => $color, 'goi_y' => $goiY));
  $data_json = json_encode($data);
  echo $data_json;
?>