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

// 3a
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
function addCart($pID, $uID){

	global $db;
	//假如購物車裡面有此商品，則數量+1
	$sql1 = "select count(*) from cart where pID = ? and uID = ?;";
	$stmt = mysqli_prepare($db, $sql1);
	mysqli_stmt_bind_param($stmt, "ii", $pID, $uID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $count); //會將結果存到count變數中
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt); // 因為 prepare 所以需要用 close 關閉 statement，才能執行下一個 prepare

	if ($count > 0) {
		// 購物車裡已經有此商品，數量+1
		$sql2 = "update cart set amount = amount + 1 where pID = ? and uID = ?;";
		$stmt = mysqli_prepare($db, $sql2);
		mysqli_stmt_bind_param($stmt, "ii", $pID, $uID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt); // Close the first statement

	} else {
		// 購物車裡沒有此商品，新增一筆資料
		$sql3 = "insert into cart (pID, amount, uID) values (?, 1, ?);";
		$stmt = mysqli_prepare($db, $sql3);
		mysqli_stmt_bind_param($stmt, "ii", $pID, $uID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt); // Close the first statement

	}
	// //結帳後，商品庫存量減一
	// $sql4 = "update product set stock = stock - 1 where pID=?";
	// $stmt = mysqli_prepare($db, $sql4);
	// mysqli_stmt_bind_param($stmt, "i", $pID);
	// mysqli_stmt_execute($stmt);
	// mysqli_stmt_close($stmt); 


	return True;
}

// 【客戶查看指定商品詳細資訊】	
function getProductDetail($pID){
	global $db;
	$sql="select name, price, stock, content from product where pID = ?;";
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

// 【客戶查看購物車內容】
function listCart($uID){
	global $db;
	$sql="select product.pID, product.name, product.price, cart.amount from product inner join cart on product.pID = cart.pID where cart.uID = ?;";
	$stmt=mysqli_prepare($db,$sql);
    mysqli_stmt_bind_param($stmt,"i",$uID);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

//【客戶刪除購物車內容】
function delCart($pID, $uID){
	global $db;
	$sql="delete from cart where pID=? and uID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$pID, $uID);
	mysqli_stmt_execute($stmt);
	return True;
}
// 【客戶計算購物車總金額】
function cartTotal($uID){
    global $db;
    $sql="select sum(c.amount * p.price) as total_amount from cart c inner join product p on c.pID = p.pID where c.uID = ?;";
    $stmt=mysqli_prepare($db,$sql);
    mysqli_stmt_bind_param($stmt,"i",$uID);
    mysqli_stmt_execute($stmt);
    
    $total_amount = 0; // 新增的變數
    
    mysqli_stmt_bind_result($stmt, $total_amount); // 將結果繫結到變數
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);
    return ['total_amount' => $total_amount];
}

//【商家刪除商品項目】
function delProduct($pID){
	global $db;
	$sql="delete from product where pID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$pID);
	mysqli_stmt_execute($stmt);
	return True;
}

// 【商家更新商品】
function updateProduct($pID, $name, $price, $stock, $content){
    global $db;
	$sql="update product set name=? , price=? , stock=? , content=? where pID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt, "ssssi", $name, $price, $stock, $content, $pID);
	mysqli_stmt_execute($stmt);
	return True;
}

// 【商家新增商品】
function addProduct($name, $price, $stock, $content){
    global $db;
	$sql="insert into product (name, price, stock, content) values (? , ? , ? , ?);";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt, "ssss", $name, $price, $stock, $content);
	mysqli_stmt_execute($stmt);
	return True;
}

// 【商家查看商品詳細內容】
function listProductInfo(){
	global $db;
	$sql="select * from product;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

// 3b
// 【客戶進行結帳】
// 新增訂單紀錄到orders紀錄表
function addOrder($uID, $totalPrice){ 
    global $db;
	$sql="insert into orders(userID, sum) values(?, ?);";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$uID, $totalPrice);
	mysqli_stmt_execute($stmt);
	return True;
}

// 儲存購物車項目到order_items資料表
function saveItems($uID){
    global $db;
	$sql="insert into order_item (oID, pID, amount) select (select max(oID) from orders) as M, pID, amount from cart where uID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$uID);
	mysqli_stmt_execute($stmt);
	return True;
}

// 清空購物車
function clearCart($uID){
    global $db;
	$sql="delete from cart where uID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$uID);
	mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['status'];
    } else {
        return false; // 或者你可以根據實際情況返回其他值
    }
	return True;
}

// 【客戶查看訂單詳細內容】
function getOrderDetail($oID){
	global $db;
	$sql="SELECT product.name, product.price, product.content, order_item.amount from product inner join order_item on product.pID = order_item.pID where oID = ?;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i",$oID);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

// 【客戶查看訂單】
function listorder($uID){ 
	global $db;
	$sql="select oID, sum, status, evaluation from orders where userID = ?;";
	$stmt=mysqli_prepare($db,$sql);
    mysqli_stmt_bind_param($stmt,"i", $uID);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}

// 【客戶評價訂單】
function evaluateOrder($oID, $evaluation){
    global $db;
	$sql="update orders set evaluation = ? where oID = ?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$evaluation, $oID);
	mysqli_stmt_execute($stmt);
	return True;
}

// 【客戶完成訂單】
function completeOrder($oID){
    global $db;
	$sql="update orders set status = '已收貨' where oID = ?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i", $oID);
	mysqli_stmt_execute($stmt);
	return True;
}

// 【商家查看訂單】
function listAllorder(){
	global $db;
	$sql="select * from orders;";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_execute($stmt);
	$result=mysqli_stmt_get_result($stmt);
	$rows=array();
	while($r=mysqli_fetch_assoc($result)){
		$rows[]=$r;
	}
	return $rows;
}
// 【商家處理訂單】
function dealProduct($oID){
    global $db;
	$sql="update orders set status = '已處理' where oID = ?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i", $oID);
	mysqli_stmt_execute($stmt);
	return True;
}
// 【商家出貨】
function sendProduct($oID){
    global $db;
	$sql="update orders set status = '寄送中' where oID = ?";
	$stmt=mysqli_prepare($db,$sql);
	mysqli_stmt_bind_param($stmt,"i", $oID);
	mysqli_stmt_execute($stmt);
	return True;
}
?>