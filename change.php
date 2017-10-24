<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 if(@$_GET["action"]=='change')
 {   
     include ROOT_PATH.'include\mysql.func.php';
     include ROOT_PATH.'include\change.func.php';
	 include ROOT_PATH.'include\global.php';
	 $_clean=array();
	 $_clean['num']=$_POST['num'];
	 $_clean['username']=$_POST['username'];
   $_clean['home']=$_POST['home'];
   $_clean['tel']=$_POST['tel'];
   $_clean['email']=$_POST['email'];
	 $_clean['department']=$_POST['dapartment'];
	 if($_clean['num']){
	 	_query("UPDATE card SET cno='{$_clean['num']}' WHERE  card.cname='{$_COOKIE['username']}'");
	 }
   if($_clean['home']){
    _query("UPDATE card SET home='{$_clean['home']}' WHERE  card.cname='{$_COOKIE['username']}'");
   }
   if($_clean['tel']){
    _query("UPDATE card SET tel='{$_clean['tel']}' WHERE  card.cname='{$_COOKIE['username']}'");
   }
   if($_clean['email']){
    _query("UPDATE card SET email='{$_clean['email']}' WHERE  card.cname='{$_COOKIE['username']}'");
   }
	 if($_clean['department']){
	 	_query("UPDATE card SET department='{$_clean['department']}' WHERE  card.cname='{$_COOKIE['username']}'");
	 }
   if($_clean['username']){
    _query("UPDATE card SET cname='{$_clean['username']}' WHERE  card.cname='{$_COOKIE['username']}'");
   }
	 _unsetcookies("username");
	 _unsetcookies("num");
	 _setcookies("username",$_POST['username']);
	 _setcookies("num",$_POST['num']);
	_close();
	_location('修改信息成功','message.php');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>register</title>
<link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<body>
<div id="header">
<h1><a href="index.php"><span id="header1">图书管理系统</span></a></h1>
<nav class="navbar">
    <ul>
       <li><a href="register.php">注册</a></li>
       <li><a href="login.php">登录</a></li>
       <li><a href="borrow.php">搜索</a></li>
       <li><a href="reader.php">查询读者</li>
       <li><a href="book.php">书籍录入</a></li>
       <li><a href="delete.php">删除书籍</a></li>
       <?php
       if(@$_COOKIE['username']){
       echo "<li><a href='message.php'>".$_COOKIE['username']."的个人中心</a></li>";
         }
       ?>
       <?php
       if(@$_COOKIE['username']){
        echo '<li><a href="change.php">更改个人信息</a></li>';
       }
       ?>
       <?php
	    if(isset($_COOKIE['username'])){
        echo '<li id="laginout"><a href="loginout.php">退出</a></li>'; 
         }
	 ?>
    </ul>
</nav>
</div>
<div id="content">
<form action="change.php?action=change" method="post" name="change">
<dl>
   <dt>重新录入用户信息</dt>
   <dd>学号：<input type="text" name="num"></dd>
   <dd>姓名：<input type="text" name="username"></dd>
   <dd>住址：<input type="text" name="home"></dd>
   <dd>电话：<input type="text" name="tel"></dd>
   <dd>email:<input type="text" name="email"></dd>
   <dd>学院：<input type="text" name="dapartment"></dd>
   <dd><input type="submit" value="确认" class="submit"></dd>
</dl>
</form>
</div>
</body>
</html>
