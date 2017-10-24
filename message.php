<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 include ROOT_PATH.'include\mysql.func.php';
 include ROOT_PATH.'include\login.func.php';
 include ROOT_PATH.'include\global.php';
 if(!isset($_COOKIE['username'])){
	  _alert_back("请先登录！");
	 }
 if(@$_GET['action']=='message'){
 	         $_clean=array();
             @$_clean['title']=$_POST['title'];
             if(isset($_clean['title'])){

                _query("UPDATE book SET mark=1 WHERE  book.title='{$_clean['title']}'");
                _query("DELETE FROM borrow  WHERE  borrow.title='{$_clean['title']}'");
            }

 }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_COOKIE['username'].'的个人中心';?></title>
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
<div id="message">
              <div id="detile">
<?php
$i=0;
//$_rows=_fetch_array("SELECT title FROM borrow WHERE cno='{$_COOKIE['num']}'  LIMIT 1");
if($_COOKIE['username']!='admin'){
$_arr = _query("SELECT title FROM borrow WHERE cno='{$_COOKIE['num']}'");
echo $_COOKIE['username'].'的个人中心';
echo "</br>";
echo "<p></p>";
echo "学号:".$_COOKIE['num'];
echo "</br>";
echo "<p></p>";
echo "借书单：";
echo "</br>";
echo "</br>";
$_num=$_COOKIE['num'];
$_result = _query("SELECT * FROM borrow"); 
while($row=mysql_fetch_row($_result,MYSQL_ASSOC)){
	//_alert_back($row['cno']);
                     if($row['cno']==$_num){
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "书号";
                        echo "</td>";
                        echo "<td>";
                        echo "书名";
                        echo "</td>";
                        echo "<td>";
                        echo "借出时间";
                        echo "</td>";
                        echo "<td>";
                        echo "归还时间";
                        echo "</td>";
                        echo "<td>";
                        echo "操作";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<span id='title'>".$row['bno']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='category'>".$row['title']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['borrow_date']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='return_date'>".$row['return_date']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='message.php?action=message' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='submit' value='归还'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                       }
                     } 

      
                }
/*foreach($_arr as $_item){
	echo $_arr[$_item]; 
	};
for($i;$i<count($_arr);$i++){
	echo $_arr[$i];
	}*/
?>

     </div>
</div>
</body>
</html>
