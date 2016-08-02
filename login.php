<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Insert title here</title>
<?php
header("content-type:text/html;charset=utf-8");
mysql_connect("localhost:3306","root","123456");
mysql_select_db("cms");

if($_POST != null){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	if($username==null || $password == null){
		echo '用户名或密码为空';
		header("location:02_login.php");
		exit;
	}elseif ($password != $password2){
		echo '两次密码不一致';
		header("location:02_login.php");
		exit;
	}

	$sql = 'select id from admin where username="'.$username.'" and password="'.$password.'"';

	$result = mysql_query($sql);
	
	$i = mysql_fetch_row($result);
	if($i != null){
		$name = "username";
		$value = $username;
		$expire = time()+24*60*60;
		setcookie($name,$value,$expire);
		header("location:03_index_cookie.php");
	}else{
		echo '请确认用户名及密码输入正确';
	}
}
?>
</head>
<body>
	<form action="#" method="post">
	<table>
		<tr>
			<td>用户名</td>
			<td><input type ="text" name="username"/></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="password" name="password"/></td>
		</tr>
		<tr>
			<td>确认密码</td>
			<td><input type="password" name="password2"/></td>
		</tr>
		<tr>
			<td><input type="reset" value="重置"/></td>
			<td><input type="submit" value="提交"/></td>
		</tr>
	</table>
	</form>
</body>
</html>
