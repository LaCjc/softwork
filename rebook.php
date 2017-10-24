<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>更改书籍信息</title>
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
</body>
</html>
<?php

define('LP',true);
define('ROOT_PATH',substr(dirname(__FILE__),0,0));
header("Content-Type:text/html;charset=utf-8");
include ROOT_PATH.'include\global.php';
include ROOT_PATH.'include\mysql.func.php';
include ROOT_PATH.'include\book.func.php';
include ROOT_PATH.'include\rebook.func.php';
@_setcookie("bno",$_GET['bno']);
//@$_title=$_GET['title'];
echo "<div id='content'>";
echo '<form action="rebook.php?action=rebook1" method="post" name="rebook1">';
echo "<dl>";
echo "<dt>修改书本信息</dt>";
echo '<dd>分 类：<input type="text" name="category"></dd>';
echo '<dd>书 名：<input type="text" name="title"></dd>';
echo '<dd>作 者：<input type="text" name="author"></dd>';
echo '<dd>出版社：<input type="text" name="press"></dd>';
echo '<dd><input type="submit" value="更改" class="submit"></dd>';
echo "</dl>";
echo '</form>';
echo "</div>";
 if(@$_GET["action"]=='rebook1'){

        if(@$_COOKIE['username']!='admin'){

 	                 _alert_back("你没有权限更改书籍信息");

        }else{   
     
	 $_clean=array();
	 //@$_clean['bno']=$_POST['bno'];
	 $_clean['category']=$_POST['category'];
	 $_clean['title']=$_POST['title'];
   $_clean['author']=$_POST['author'];
	 $_clean['press']=$_POST['press'];
	 /*if($_clean['bno']){
	 	_query("UPDATE book SET bno={$_clean['bno']} WHERE  book.bno='{$_COOKIE['bno']}'");
	 }*/
	 if($_clean['category']){
	 	_query("UPDATE book SET category='{$_clean['category']}' WHERE  book.bno='{$_COOKIE['bno']}'");
	 }
	 if($_clean['title']){
	 	_query("UPDATE book SET title='{$_clean['title']}' WHERE  book.bno='{$_COOKIE['bno']}'");
	 }
   if($_clean['author']){
    _query("UPDATE book SET author='{$_clean['author']}' WHERE  book.bno='{$_COOKIE['bno']}'");
   }
	 if($_clean['press']){
	 	_query("UPDATE book SET press='{$_clean['press']}' WHERE  book.bno='{$_COOKIE['bno']}'");
	 }
	
	_unsetcookie();
	//_close();
	_location('更改成功','borrow.php');
    }
  }
  
?>
