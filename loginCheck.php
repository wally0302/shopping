<?php
require("userModel.php");
//header("Access-Control-Allow-Origin: http://localhost:8000");

$act=$_REQUEST['act'];
switch ($act) {
/*case "login":
	$id=$_REQUEST['id'];
	$pwd=$_REQUEST['pwd'];
	//verify with DB

	$role = login($id,$pwd); //use the login function in userModel
	//setcookie('loginRole',$role,httponly:true); //another way to restrict the cookie visibility
	setcookie('loginRole',$role); //another way to restrict the cookie visibility
	if ($role > 0) {
		$msg=[
			"msg" => "OK",
			"role" => $role
		];
	} else {
		$msg=[
			"msg" => "NO",
			"role" => 0
		];
	}
	echo json_encode($msg);
	return;
	break;
case 'showInfo':
	//檢查是否已登入
	$loginRole=$_COOKIE['loginRole'];
	if ($loginRole>0) {
		$msg="You've logged in. Your role is $loginRole.";
	} else {
		$msg="You need login to use this funtion.";
	}
	echo $msg;
	break;
case 'logout':
	//setcookie('loginRole',0,httponly:true);
	setcookie('loginRole',0);
	break;*/
case "register":
	$jsonStr = $_POST['dat'];
	$product = json_decode($jsonStr);
	register($product->name, $product->account, $product->password, $product->role);
	return;
default:
}

?>