<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

// 在 地址栏 得到楼管号
$db_no = $_GET ['da'];
// 判断用户类型，是否拥有进入此页面的权限
if ($db_no == "" || $user_type == 2) {
	echo "<script>history.back()</script>";
} else {
	if ($user_type == 1 && $db_no != $users ['db_no']) {
		echo "<script>history.back()</script>";
	}
}

// 查询 当前编辑 楼管信息
$query = "SELECT * FROM dor_build WHERE db_no='$db_no'";
$result = mysql_query ( $query ) or die ( 'SQL语句有误：' . mysql_error () );
$dor_build = mysql_fetch_array ( $result );

// 修改 楼管 信息
$submit = $_POST ['submit'];

$admin_dor = $_POST ['admin-dor'];
$admin_name = $_POST ['admin-name'];
// $admin_tel = $_POST ['admin-tel'];
$admin_sex = $_POST ['admin-sex'];
// $admin_age = $_POST ['admin-age'];
// $admin_word = $_POST ['admin-word'];

if ($submit != "") {
	if ($admin_dor == "") {
		echo "<script>alert('抱歉，管理宿舍楼号 不能为空。');history.back()</script>";
		exit ();
	}
	if ($admin_name == "") {
		echo "<script>alert('抱歉，姓名 不能为空。');history.back()</script>";
		exit ();
	}



	$query = "UPDATE dor_build SET db_no='$admin_dor',db_name='$admin_name',db_sex='$admin_sex' WHERE db_no='$db_no'";
	// 判断是否输入 密码
	// if ($admin_word != "") {
	// 	$query = "UPDATE dor_build SET db_no='$admin_dor',db_name='$admin_name',db_age='$admin_age',db_address='$admin_address',db_tel='$admin_tel',db_password=md5($admin_word) WHERE db_no='$db_no'";
	// }
	// 更新数据库 dor_build 表该学生的信息
	mysql_query ( $query ) or die ( '修改错误' . mysql_error () );
	echo "<script>alert('您好，编号 $db_no 楼管信息已成功更新。');location.href='?r=dor_build'</script>";
	exit ();
}

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>编辑楼管 -  大学宿舍管理系统</title>
<link rel="icon" type="image/png" href="assets/i/favicon.png">
<link rel="stylesheet" href="assets/css/amazeui.min.css" />
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
	<header class="am-topbar admin-header">
		<?php require 'template/header.php';?>
	</header>

	<div class="am-cf admin-main">
		<!-- sidebar start -->
		<?php require 'template/sidebar.php';?>
		<!-- sidebar end -->

		<!-- content start -->
		<div class="admin-content">
			<div class="am-cf am-padding">
				<div class="am-fl am-cf">
					<strong class="am-text-primary am-text-lg"><?php echo '编号 '.$db_no.' 楼管个人信息'?></strong>
				</div>
			</div>

			<hr />
			<div class="am-g">
				<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>
				<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
					<form class="am-form am-form-horizontal" role="form" method="post"
						action="" enctype="multipart/form-data">

						<!-- <div class="am-form-group">
							<label for="admin-no" class="am-u-sm-3 am-form-label">楼管编号</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-no" placeholder="楼管号"
									value="<?php echo $dor_build['db_no']?>" readonly="true">
							</div>
						</div> -->

						<div class="am-form-group">
							<label for="admin-dor" class="am-u-sm-3 am-form-label">宿舍楼号</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-dor" placeholder="WY5"
									value="<?php echo $dor_build['db_no']?>">
							</div>
						</div>

						<div class="am-form-group">
							<label for="admin-name" class="am-u-sm-3 am-form-label">宿舍楼名字</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-name" placeholder="输入你的姓名"
									value="<?php echo $dor_build['db_name']?>">
							</div>
						</div>

						<!-- <div class="am-form-group">
							<label for="admin-tel" class="am-u-sm-3 am-form-label">电话</label>
							<div class="am-u-sm-9">
								<input type="tel" name="admin-tel" placeholder="输入你的电话号码"
									value="<?php echo $dor_build['db_tel']?>">
							</div>
						</div> -->

						<!-- <div class="am-form-group">
							<label for="admin-age" class="am-u-sm-3 am-form-label">年龄</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-age" placeholder="输入你的年龄"
									value="<?php echo $dor_build['db_age']?>">
							</div>
						</div> -->

						<div class="am-form-group">
							<label for="admin-address" class="am-u-sm-3 am-form-label">宿舍楼性别</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-address" placeholder="宿舍楼性别"
									value="<?php echo $dor_build['db_sex']?>">
							</div>
						</div>

						<!-- <div class="am-form-group">
							<label for="admin-word" class="am-u-sm-3 am-form-label">登录密码</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-word"
									placeholder="若修改密码，请直接输入新密码。否则，无需填写该项！" value="">
							</div>
						</div> -->

						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<button type="submit" name="submit" value="yes"
									class="am-btn am-btn-primary">保存修改</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- content end -->

	</div>

	<footer class="template_footer">
		<?php require 'template/footer.php';?>
	</footer>

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/amazeui.min.js"></script>
	<!--<![endif]-->
	<script src="assets/js/app.js"></script>
</body>
</html>
