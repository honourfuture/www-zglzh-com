<?php

$start_time=microtime(true);
require('config.php');
require('chk.php');
define('admin', true);
newtoken(10);
if(isset($_GET['do']) && isset($_GET['nohtml'])) {
	if(isset($_GET['do'])) {$thisdo=explode('_',$_GET['do']);}
	if(!isset($thisdo[1])) {$thisdo[1]='index';}
	check_admin_file($thisdo[0],$thisdo[1]);
	require($thisdo[0].'/'.$thisdo[1].'.php');
	die();
}
function check_admin_file($dir,$file) {
	if(!preg_match("/^[a-z\d]{1,25}$/i",$dir)){
		die('file error');
	}
	if(!preg_match("/^[a-z\d]{1,25}$/i",$file)){
		die('file error');
	}
	if(!is_file($dir.'/'.$file.'.php')) {
		die('file not exist');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo($my['name']) ?>-后台管理中心</title>
<meta name="referrer" content="origin-when-cross-origin">
<link href="static/layui/css/layui.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery.min.js"></script>
<script src="static/js/mytheme.js"></script>
<script src="static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="static/img/favicon.ico" >
<style type="text/css">.layui-elem-field{border-radius:5px}.layui-form{padding:10px}.layui-form-item .layui-input-inline{width:auto}.layui-elem-field{margin-top:20px}.layui-form-label{width:150px}.layui-input-block{margin-left:180px}.layui-form-item{padding-bottom:15px;border-bottom:1px dotted #eee}.layui-form-item:last-child{padding-bottom:0;border-bottom:0}.layui-nav-child{ text-align: center;}</style>
</head>
<body>
<?php
if(isset($_GET['do'])) {
	$thisdo=explode('_',$_GET['do']);
}
?>
<?php require('top.php');?>
<?php 
	if(isset($_GET['do'])) {
		if(!isset($thisdo[1])) {
			$thisdo[1]='index';
		}
		check_admin_file($thisdo[0],$thisdo[1]);
		require($thisdo[0].'/'.$thisdo[1].'.php');
	}else {
			if(power('s',0,$power)){
				echo("<meta http-equiv=refresh content='0; url=?do=home'>");
				exit();
			}
			foreach($channels as $value){
				if(power('s',$value['cid'])) {
					if($value['ckind']==1 || $value['ckind']==3) {
						$firsturl='?do=str&cid='.$value['cid'];
					}
					if($value['ckind']==2) {
						$firsturl='?do=list&cid='.$value['cid'];
					}
					if($value['ckind']==4) {
						if($value['newwindow']!=1) {
							$firsturl=$value['cvalue'];
						}
					}
					break;
				}
			}
			if(isset($firsturl)) {
				echo("<meta http-equiv=refresh content='0; url=$firsturl'>");
				exit();
			}
		
	}

?>

<div class="layui-footer" style="padding: 50px; text-align: center;">
  <?php
	$end_time=microtime(true);
	$total_time=substr($end_time-$start_time,0,5);
	if($total_time=="0.000") {$total_time="0.001";}
  ?>
  &copy; MYTHEME.CN 
</div>
</div>
</body>
</html>
