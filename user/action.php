<?php
include('data_khoanchi1.php');
$kc = new KhoanChi();
$kcc = $_POST['kcc'];
if(!empty($_POST['action']) && $_POST['action'] == 'dsKhoanChi') {
	$kc->DSKhoanChi($kcc);
}
if(!empty($_POST['action']) && $_POST['action'] == 'addEmployee') {
	$kc->addEmployee();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getEmployee') {
	$kc->getEmployee();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateEmployee') {
	$kc->updateEmployee();
}
if(!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
	$kc->deleteEmployee();
}
?>