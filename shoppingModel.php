<?php
require('dbconfig.php');

// function getJobList() {
// 	global $db;
// 	$sql = "select * from todo;";
// 	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
// 	mysqli_stmt_execute($stmt); //執行SQL
// 	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

// 	$rows = array(); //要回傳的陣列
// 	while($r = mysqli_fetch_assoc($result)) {
// 		$rows[] = $r; //將此筆資料新增到陣列中
// 	}
// 	return $rows;
// }

// function addJob($jobName,$jobUrgent,$jobContent) {
// 	global $db;

// 	$sql = "insert into todo (jobName, jobUrgent, jobContent) values (?, ?, ?)"; //SQL中的 ? 代表未來要用變數綁定進去的地方
// 	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
// 	mysqli_stmt_bind_param($stmt, "sss", $jobName, $jobUrgent,$jobContent); //bind parameters with variables, with types "sss":string, string ,string
// 	mysqli_stmt_execute($stmt);  //執行SQL
// 	return True;
// }

// function delJob($id) {
// 	global $db;

// 	$sql = "delete from todo where id=?;"; //SQL中的 ? 代表未來要用變數綁定進去的地方
// 	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
// 	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables, with types "sss":string, string ,string
// 	mysqli_stmt_execute($stmt);  //執行SQL
// 	return True;
// }
function listProduct(){
	global $db;
	$sql="select * from product";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}
function addCart($id,$qty){
	global $db;
	$sql="insert into cart (id,qty) values (?,?)";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$id,$qty);
	mysqli_stmt_execute($stmt);
	return True;
}
function getProductDetail($id){
	global $db;
	$sql="select * from product where id=?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$id);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}


?>