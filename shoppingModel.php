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

// 【客戶查看商品列表】
function listProduct(){
	global $db;
	$sql="select pID, name, price, stock from product;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}
// 【客戶將商品放入購物車】
function addCart($pID,$amount){
	//要放庫存量減少嗎?
	global $db;
	$sql="insert into cart (pID,amount) values (?,?)";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$pID,$amount);
	mysqli_stmt_execute($stmt);
	return True;
}

//【客戶查看指定商品詳細資訊】	
function getProductDetail($pID){
	global $db;
	$sql="select name, price, stock, content from product where pID=?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$pID);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

//【客戶查看購物車內容】
function listCart(){
	global $db;
	$sql="select product.name, product.price, cart.amount from product inner join cart on product.pID = cart.pID;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

?>