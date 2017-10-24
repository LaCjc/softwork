<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>详细信息</title>
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
    <div id="detail">
	<?php

            define('LP',true);
            define('ROOT_PATH',substr(dirname(__FILE__),0,0));
            header("Content-Type:text/html;charset=utf-8");
            include ROOT_PATH.'include\mysql.func.php';
            include ROOT_PATH.'include\login.func.php';
            include ROOT_PATH.'include\global.php';
            include ROOT_PATH.'include\borrow.func.php';
 /*if(!isset($_COOKIE['username'])){
	  _alert_back("请先登录！");
	 }*/
            if(@$_GET['action']=='detail'){
    
                    $_clean=array();
                    @$_clean['title']=$_POST['title'];
                    @$_clean['bno']=$_POST['bno'];
                    $_result=_query("SELECT * FROM book WHERE book.title='{$_clean['title']}'");
                    $row=mysql_fetch_row($_result,MYSQL_ASSOC);
                    $_result2=_query("SELECT cno FROM borrow WHERE borrow.title='{$_clean['title']}'");
                    $row2=mysql_fetch_row($_result2,MYSQL_ASSOC);
                    @$_cno=$row2['cno'];
                     if($row['mark']==0){
                             
                             echo "该书已经被借出";
                             echo "</br>";
                             echo "<p></p>";
                             echo "借出人的学号是：".$row2['cno'];
                             echo "</br>";
                             echo "<p></p>";
                             echo "<form action='detail.php?action=detail2' method='post' name='form1'>";
                             echo "<input type='hidden' name='cno' value='".$_cno."'>";
                             echo "<input type='submit' value='借阅人详细信息'>";
                             echo "</form>";
                             echo "<p></p>";
                             echo "<button onclick='javascript:history.back();'>后退</button>";
                             }else{

                             	echo "该书可以被借出";
                             	echo "</br>";
                             	echo "<p></p>";
                             	echo "书本详细信息";
                             	echo "</br>";
                             	echo "<p></p>";
                             	echo "书号:".$row['bno']."</br>";
                             	echo "<p></p>";
                             	echo "类型:".$row['category']."</br>";
                             	echo "<p></p>";
                             	echo "书名:".$row['title']."</br>";
                             	echo "<p></p>";
                             	echo "作者:".$row['author']."</br>";
                             	echo "<p></p>";
                             	echo "出版社:".$row['press']."</br>";
                             }

                       }
            if(@$_GET['action']=='detail2'){

            	$_clean=array();
                @$_clean['cno']=$_POST['cno'];
                $_result=_query("SELECT * FROM card WHERE card.cno='{$_clean['cno']}'");
                $row=mysql_fetch_row($_result,MYSQL_ASSOC);
                echo "借阅者详细信息:";
                echo "</br>";
                echo "<p></p>";
                echo "学号：".$row['cno']."</br>";
                echo "<p></p>";
                echo "名字：".$row['cname']."</br>";
                echo "<p></p>";
                echo "住址：".$row['home']."</br>";
                echo "<p></p>";
                echo "电话：".$row['tel']."</br>";
                echo "<p></p>";
                echo "邮箱：".$row['email']."</br>";
                echo "<p></p>";
                echo "学院：".$row['department']."</br>";
                echo "<p></p>";
                echo "<button onclick='javascript:history.back();'>后退</button>";
            }

	?>
    </div>
</div>
</body>
</html>
