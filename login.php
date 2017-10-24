<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 include ROOT_PATH.'include\mysql.func.php';
 include ROOT_PATH.'include\login.func.php';
 include ROOT_PATH.'include\global.php';
 _login_state();
 if(@$_GET["action"]=='login')
 {   
     
	 $_clean=array();
	 $_clean['num']=_check_num($_POST['num'],3);
	 $_clean['username']=_check_username($_POST['username'],2,6);
	 if(!!$_rows=_fetch_array("SELECT * FROM card WHERE cname='{$_clean['username']}' AND cno='{$_clean['num']}' LIMIT 1"))
	  {
		  _close();
		  _setcookies("username",$_rows['cname']);
		  _setcookies("num",$_rows['cno']);
		  _location(null,'message.php');
		  }else{
			  _close();
			  _location('用户名或学号不正确','login.php');
		  }
	_close();
	_location('登录成功','message.php');
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录</title>
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
<dl>
   <dt>登录</dt>
   <dd><form action="login.php?action=login" method="post" name="login"></dd>
   <dd>学号：<input type="text" name="num"></dd>
   <dd>姓名：<input type="text" name="username"></dd>
   <dd><input type="submit" value="登录" class="submit"></dd>
</dl>
</form>
</body>
</html>
