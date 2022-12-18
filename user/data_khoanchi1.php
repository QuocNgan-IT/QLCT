<?php
if(!isset($_SESSION)) session_start(); 
$ma_nd = $_SESSION['ma_nd'];

date_default_timezone_set('Asia/Ho_Chi_Minh');
$timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

class dbConfig {
  protected $serverName;
  protected $userName;
  protected $password;
  protected $dbName;
  function dbConfig() {
      $this -> serverName = 'localhost';
      $this -> userName = 'root';
      $this -> password = "";
      $this -> dbName = "quanlychitieu";
  }
}

class KhoanChi extends dbConfig{	
    protected $hostName;
    protected $userName;
    protected $password;
	  protected $dbName;
	private $Table = 'khoan_chi_tieu';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database -> password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Lỗi kết nối đến MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Lỗi xử lý: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Lỗi xử lý: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}   	
	public function DSKhoanChi($KCC){		
    if(!isset($_SESSION)) session_start(); 
    $ma_nd = $_SESSION['ma_nd'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timerange = "MONTH(ngay_chi)>=MONTH(DATE_ADD(CURDATE(),INTERVAL 0 MONTH))";

		$sqlQuery = "SELECT * FROM ".$this->Table." WHERE ma_nd=$ma_nd AND ma_kcc=$KCC AND $timerange ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'AND (ten_kct LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
      $colNum = (int)$_POST['order']['0']['column'] +4;
			$sqlQuery .= 'ORDER BY '.$colNum.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY ma_kct DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$sqlQuery1 = "SELECT * FROM ".$this->Table." WHERE ma_nd=$ma_nd AND ma_kcc=$KCC AND $timerange ";
		$result1 = mysqli_query($this->dbConnect, $sqlQuery1);
		$numRows = mysqli_num_rows($result1);
		
		$kcData = array();	
		while( $rowKC = mysqli_fetch_assoc($result) ) {		
			$kcRows = array();			
			$kcRows[] = ucfirst($rowKC['ten_kct']);
			$kcRows[] = number_format(($rowKC['so_tien']),0,""," ")."đ";;		
			$kcRows[] = $rowKC['mo_ta'];	
			$kcRows[] = $rowKC['ngay_chi'];			
      $kcRows[] = '
        <a 
          href="#"
          data-mdb-toggle="modal" 
          data-mdb-target="#editModal" 
          data-mdb-ma_kct="'.$rowKC['ma_kct'].'"
          data-mdb-ma_kcc="'.$rowKC['ma_kcc'].'"
          data-mdb-ten_kct="'.$rowKC['ten_kct'].'"
          data-mdb-so_tien="'.$rowKC['so_tien'].'"
          data-mdb-mo_ta="'.$rowKC['mo_ta'].'"
        >
          <i class="fas fa-edit ms-1"></i>
        </a>
        <a 
          href="#"
          data-mdb-toggle="modal" 
          data-mdb-target="#deleteModal" 
          data-mdb-ma_kct="'.$rowKC['ma_kct'].'"
          data-mdb-ma_kcc="'.$rowKC['ma_kcc'].'"
          data-mdb-ten_kct="'.$rowKC['ten_kct'].'"
          data-mdb-so_tien="'.$rowKC['so_tien'].'"
          data-mdb-mo_ta="'.$rowKC['mo_ta'].'"
          data-mdb-ngay_chi="'.$rowKC['ngay_chi'].'"
        >
          <i class="fas fa-trash ms-1"></i>
        </a>
      ';
			$kcData[] = $kcRows;
		}
		$output = array(
      "sql"               =>  $sqlQuery,
			"draw"				      =>	intval($_POST["draw"]),
			"recordsTotal"  	  =>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			    => 	$kcData
		);
    
		echo json_encode($output);
	}
}
?>