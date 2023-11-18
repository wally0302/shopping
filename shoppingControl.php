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
case "addCart":	
	$id=(int)$_REQUEST['id'];
	$qty=(int)$_REQUEST['qty'];
	addCart($id,$qty);
	return;
case "getProductDetail":	
	$id=(int)$_REQUEST['id'];
	$product=getProductDetail($id);
	echo json_encode($product);
	return;
default:
  
}

?>