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
 <?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 include ROOT_PATH.'include\mysql.func.php';
 include ROOT_PATH.'include\login.func.php';
 include ROOT_PATH.'include\global.php';
 include ROOT_PATH.'include\borrow.func.php';
if(@$_GET['action']=='reader'){
$_clean=array();
$_clean['cno']=$_POST['cno'];
$_clean['username']=$_POST['username'];
if(!($_clean['cno']&&$_clean['username'])){
  
  _alert_back("请输入查询学号或者名字");
  
}
$_result=_query("SELECT * from card");
if($_result)   {           
                     while(@$row=mysql_fetch_row($_result,MYSQL_ASSOC)){
                      if($row['cno']=="{$_POST['cno']}" || $row['cname']=="{$_POST['username']}"){
                        echo "<div id='reader'>";
                        echo "学号：".$row['cno']."</br>";
                        echo "<p></p>";
                        echo "名字：".$row['cname']."</br>";
                        echo "<p></p>";
                        echo "住址：".$row['home']."</br>";
                        echo "<p></p>";
                        echo "电话：".$row['tel']."</br>";
                        echo "<p></p>";
                        echo "email：".$row['email']."</br>";
                        echo "<p></p>";
                        echo "学院：".$row['department']."</br>";
                        echo "</div>";
             }
         }
     }
 }
 ?>
</div>
</body>
</html>




