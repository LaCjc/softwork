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
<form action="readerMessage.php?action=reader" method="post" name="form">
<dl>
    <dt>查询读者</dt>
    <dd>学号：<input type="text" name="cno"></dd>
    <dd>名字：<input type="text" name="username"></dd>
    <dd><input type="submit" name="submit" value="查询" class="submit"></dd>
</dl>
</form>
</div>
</body>
</html>
