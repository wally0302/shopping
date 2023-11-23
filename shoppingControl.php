<?php
require('shoppingModel.php');

$act=$_REQUEST['act'];
switch ($act) {
// case "listJob":
//   $jobs=getJobList(); //todoModel.php 的 getJobList()
//   echo json_encode($jobs);
//   return;  
// case "addJob":
// 	$jobName=$_POST['name']; //$_GET, $_REQUEST
// 	$jobUrgent=$_POST['urgent'];
// 	$jobContent=$_POST['content'];
// 	//verify
// 	addJob($jobName,$jobUrgent,$jobContent);
// 	return;
// case "delJob":
// 	$id=(int)$_REQUEST['id']; //$_GET, $_REQUEST
// 	//verify
// 	delJob($id);
// 	return;
case "listProduct":
	$products=listProduct();
	echo json_encode($products);
	return;

// 【客戶將商品放入購物車】
case "addCart":	
	$id=(int)$_REQUEST['id']; //商品編號
	addCart($id);
	return;
case "getProductDetail":	
	$id=(int)$_REQUEST['id'];//前端傳來的商品編號
	$product=getProductDetail($id);
	echo json_encode($product);
	return;
case "listCart":
	$cart=listCart();
	echo json_encode($cart);
	return;
case "delCart":
	$id=(int)$_REQUEST['id'];
	delCart($id);
	return;
case "cartTotal":
    $total_amount=cartTotal();
    echo json_encode($total_amount);
    return;
default:
  
}

?>