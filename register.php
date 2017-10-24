<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 if(@$_GET["action"]=='register')
 {   
     include ROOT_PATH.'include\mysql.func.php';
     include ROOT_PATH.'include\register.func.php';
	 include ROOT_PATH.'include\global.php';
	 $_clean=array();
	 $_clean['num']=_check_num($_POST['num']);
	 $_clean['username']=_check_username($_POST['username'],2,6);
   $_clean['home']=$_POST['home'];
   $_clean['tel']=$_POST['tel'];
   $_clean['email']=$_POST['email'];
	 $_clean['department']=_check_depart($_POST['dapartment']);

	 _is_repeat(
	  "SELECT cno FROM card WHERE cno='{$_clean['num']}' LIMIT 1",
	  '对不起，此用户已被注册'
	);
	 _query("INSERT INTO card(
	                                 cno,
									                 cname,
                                   home,
                                   tel,
                                   email,
									                 department
									                           )VALUES(
	                                                   '{$_clean['num']}',
													                           '{$_clean['username']}',
                                                     '{$_clean['home']}',
                                                     '{$_clean['tel']}',
                                                     '{$_clean['email']}',
													                           '{$_clean['department']}'
													    )
                 ");
	_close();
	_location('恭喜你,注册成功','login.php');
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
<form action="register.php?action=register" method="post" name="register">
<dl>
   <dt>注册账号</dt>
   <dd>学号：<input type="text" name="num"></dd>
   <dd>姓名：<input type="text" name="username"></dd>
   <dd>住址：<input type="text" name="home"></dd>
   <dd>电话：<input type="text" name="tel"></dd>
   <dd>email:<input type="text" name="email"></dd>
   <dd>学院：<input type="text" name="dapartment"></dd>
   <dd><input type="submit" value="注册" class="submit"></dd>
</dl>
</form>
</div>
</body>
</html>
