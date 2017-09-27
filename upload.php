<?php
require_once __DIR__.'/php-sdk/autoload.php';
require_once __DIR__."/model/connect.php";

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

$accessKey = 'QyxQmdfygGhEX05rYIeGFHSqeRfXsT-cmoG7OSZ_';
$secretKey = 'MXubbUyIV2Jw3U94Yi8W5XAAgHCFt-nlmY28elIP';
$domain = 'http://oww9roef0.bkt.clouddn.com';
$auth = new Auth($accessKey,$secretKey);
$bucket='test';
$token = $auth->uploadToken($bucket);

$uploadMgr = new UploadManager();

// 要上传文件的本地路径

$tmpArr = $_FILES['photo']['tmp_name'];
foreach ($tmpArr as $k => $value) {
	$filename = $_FILES['photo']['name'][$k];
	$extArr = explode('.',$filename);
	$ext = end($extArr);


	$filePath = $value;
	$key = date("Y-m-d")."_".uniqid().".".$ext;
	$res = $uploadMgr->putFile($token, $key, $filePath);
	$link = $domain."/".$key;
	
	$pdo = new connect;
	$re = $pdo->insert($link);
}
if($re){
	header("Location: list.php");
}
?>