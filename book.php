<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 include ROOT_PATH.'include\global.php';
 if(@$_COOKIE['username']!='admin'){

 	_alert_back("你没有权限录入书籍");

 }
 if(@$_GET["action"]=='book')
 {   
     include ROOT_PATH.'include\mysql.func.php';
     include ROOT_PATH.'include\book.func.php';
	 
	 $_clean=array();
	 $_clean['bno']=_check($_POST['bno']);
	 $_clean['category']=_check($_POST['category']);
	 $_clean['title']=_check($_POST['title']);
   $_clean['author']=$_POST['author'];
	 $_clean['press']=_check($_POST['press']);
	 _is_repeat(
	  "SELECT bno FROM book WHERE bno='{$_clean['bno']}' LIMIT 1",
	  '书籍以被录入'
	);
	 _query("INSERT INTO book(
	                                 bno,
									 category,
									 title,
                   author,
									 press,
									 mark
									        )VALUES(
	                                                   '{$_clean['bno']}',
													   '{$_clean['category']}',
													   '{$_clean['title']}',
                             '{$_clean['author']}',
													   '{$_clean['press']}',
													   1
													    )
                 ");
	_close();
	_location('录入成功','book.php');
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>录入书籍信息</title>
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
<form action="book.php?action=book" method="post" name="book">
<dl>
    <dt>录入书籍信息</dt>
    <dd>书 号：<input type="text" name="bno"></dd>
    <dd>分 类：<input type="text" name="category"></dd>
    <dd>书 名：<input type="text" name="title"></dd>
    <dd>作 者：<input type="text" name="author"></dd>
    <dd>出版社：<input type="text" name="press"></dd>
    <dd><input type="submit" value="录入" class="submit"></dd>
</form>
</div>
</body>
</html>
