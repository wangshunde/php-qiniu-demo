<?php 

require_once "model/connect.php";

$pdo = new connect;
$re = $pdo->getList();
?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>图片</title>

</head>
<body>
<h1 style="text-align:center;">图片列表</h1>
<div style="width:800px;text-align: left;margin:0 auto;">
	<a href="index.php" >图片上传</a>
</div>
<table width="800px" border="1" align="center" cellpadding="6" cellspacing="0" style="border-collapse: collapse;text-align:center;" bgColor="#9DD9FF" border="0">

  	<tr style="text-align:center;">
    	<td width='20%'>图片</td>
    	<td width="20%">外链</td>

  	</tr>
  	<?php foreach($re as $k=>$v):?>
 	<tr>
		<td><img src="<?php echo $v['vc_photo']?>" style="width:30%";></td>
		<td><?php echo $v["vc_photo"]?></td>
	</tr>
	<?php endforeach;?>
</table>
</body>

</html>

