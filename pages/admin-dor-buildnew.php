<?php
require 'inc/conn.php';
require 'inc/checklogin.php';

// 判断用户类型，是否拥有进入此页面的权限
if ($user_type != 0) {
	echo "<script>history.back()</script>";
}

/* 新增 楼管 信息 */
$submit = $_POST ['submit'];
// $admin_no = $_POST ['admin-no'];
$admin_dor = $_POST ['admin-dor'];
$admin_name = $_POST ['admin-name'];
// $admin_tel = $_POST ['admin-tel'];
// $admin_address = $_POST ['admin-address'];
$admin_sex = $_POST ['admin-sex'];
// $admin_word = $_POST ['admin-word'];
if ($submit != "") {

	// if ($admin_no == "") {
	// 	echo "<script>alert('抱歉，楼管编号 不能为空。');history.back()</script>";
	// 	exit ();
	// }

	if ($admin_dor == "") {
		echo "<script>alert('抱歉，管理宿舍楼号 不能为空。');history.back()</script>";
		exit ();
	}

	if ($admin_name == "") {
		echo "<script>alert('抱歉，宿舍楼名字 不能为空。');history.back()</script>";
		exit ();
	}
	// if ($admin_tel == "") {
	// 	echo "<script>alert('抱歉，电话 不能为空。');history.back()</script>";
	// 	exit ();
	// }
	// if ($admin_word == "") {
	// 	echo "<script>alert('抱歉，密码 不能为空。');history.back()</script>";
	// 	exit ();
	// }

	// 插入到数据库 dor_build 表中
	$query = "INSERT INTO dor_build(db_no,db_name,db_sex) VALUES('$admin_dor','$admin_name','$admin_sex');";
	mysql_query ( $query ) or die ( '新增错误' . mysql_error () );
	echo "<script>alert('您好，编号 $admin_dor 楼管 已成功添加。');location.href='?r=dor_build'</script>";
	exit ();
}

?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>新增楼管 -  大学宿舍管理系统</title>
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
					<strong class="am-text-primary am-text-lg">新增 住宿楼 信息</strong>
				</div>
			</div>

			<hr />
			<div class="am-g">
				<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8"></div>
				<div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
					<form class="am-form am-form-horizontal" role="form" method="post"
						action="" enctype="multipart/form-data">
						<?php
						$query_dor_no = "SELECT max(db_no) max_dano FROM dor_build";
						$result_dor_no = mysql_query ( $query_dor_no ) or die ( 'SQL语句有误：' . mysql_error () );
						$dor_no = mysql_fetch_array ( $result_dor_no );
						?>

						<!-- <div class="am-form-group">
							<label for="admin-no" class="am-u-sm-3 am-form-label">楼管编号</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-no"
									placeholder="请输入 该楼管 编号（目前最大编号为：<?php echo $dor_no['max_dano']?>）">
							</div>
						</div> -->

						<div class="am-form-group">
							<label for="admin-dor" class="am-u-sm-3 am-form-label">宿舍楼号</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-dor"
									placeholder="请输入 该楼管 管理楼号(WY1-WY10，WT1-WT10)">
							</div>
						</div>

						<div class="am-form-group">
							<label for="admin-name" class="am-u-sm-3 am-form-label">宿舍楼名字</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-name" placeholder="请输入 该宿舍楼名字">
							</div>
						</div>

						<!-- <div class="am-form-group">
							<label for="admin-tel" class="am-u-sm-3 am-form-label">电话</label>
							<div class="am-u-sm-9">
								<input type="tel" name="admin-tel" placeholder="请输入 该楼管 电话号码">
							</div>
						</div> -->

						<!-- <div class="am-form-group">
							<label for="admin-age" class="am-u-sm-3 am-form-label">年龄</label>
							<div class="am-u-sm-9">
								<input type="text" name="admin-age" placeholder="请输入 该楼管 年龄">
							</div>
						</div> -->

<!--						<div class="am-form-group">-->
<!--							<label for="admin-address" class="am-u-sm-3 am-form-label">男女宿舍楼</label>-->
<!--							<div class="am-u-sm-9">-->
<!--								<input type="text" name="admin-sex"-->
<!--									placeholder="请输入 该宿舍楼是男还是女宿舍楼">-->
<!--							</div>-->
<!--						</div>-->

                        <div class="am-form-group">
                            <label for="stu-sex" class="am-u-sm-3 am-form-label">男女宿舍楼</label>
                            <div class="am-u-sm-9">
                                <select name="admin-sex">
                                    <option value="性别">请选择 性别</option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                        </div>

						<!-- <div class="am-form-group">
							<label for="admin-word" class="am-u-sm-3 am-form-label">登录密码</label>
							<div class="am-u-sm-9">
								<input type="password" name="admin-word" placeholder="请设置 初始密码"
									value="">
							</div>
						</div> -->
						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<button type="submit" name="submit" value="yes"
									class="am-btn am-btn-primary">添加 该宿舍楼</button>
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
