<?php
 define('LP',true);
 define('ROOT_PATH',substr(dirname(__FILE__),0,0));
 header("Content-Type:text/html;charset=utf-8");
 include ROOT_PATH.'include\mysql.func.php';
 include ROOT_PATH.'include\login.func.php';
 include ROOT_PATH.'include\global.php';
 include ROOT_PATH.'include\borrow.func.php';
 if(@$_COOKIE['username']!='admin'){

  _alert_back("你没有权限删除书籍");

 }
if(@$_GET['action']=='delete2'){
    

    if(empty($_COOKIE['username'])){
    
      _alert_back("请先登录！");

    }elseif($_COOKIE['username']=='admin'){
             $_clean=array();
             @$_clean['title']=$_POST['title'];
             @$_clean['bno']=$_POST['bno'];
         if(isset($_clean['title'])){
                                _query("DELETE FROM book WHERE book.title='{$_clean['title']}'");
                                           }else{

                                            _alert_back("该书不存在");

                                           }
                }else{

                  _alert_back("你没有权限删除书籍！");
                }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>删除书籍</title>
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
<form action="delete.php?action=delete" method="post" name="delete">
<dl>
   <dt>搜索想要删除的书籍</dt>
   <dd>书名：<input type="text" name="bookName"></dd>
   <dd>种类：<input type="text" name="category"></dd>
   <dd><input type="submit" value="搜索" class="submit"></dd>
</form>
<?php
$i=0;
$arr=array(); 
if(@$_GET['action']=='delete'){
$_result=_query("SELECT * from book");
if(@!($_POST['bar']=='ck')){
    if($_result) {           
                     while(@$row=mysql_fetch_row($_result,MYSQL_ASSOC)){
                      if($row['category']=="{$_POST['category']}" && $row['title']=="{$_POST['bookName']}"){
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "书名";
                        echo "</td>";
                        echo "<td>";
                        echo "种类";
                        echo "</td>";
                        echo "<td>";
                        echo "出版社";
                        echo "</td>";
                        echo "<td>";
                        echo "操作";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<span id='title'>".$row['title']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='category'>".$row['category']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='delete.php?action=delete2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='删除书籍'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</br>";
                        $arr[$i]=$row;
                        $i++;
                        continue;
                      }elseif($row['category']=="{$_POST['category']}"){
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "书名";
                        echo "</td>";
                        echo "<td>";
                        echo "种类";
                        echo "</td>";
                        echo "<td>";
                        echo "出版社";
                        echo "</td>";
                        echo "<td>";
                        echo "操作";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<span id='title'>".$row['title']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='category'>".$row['category']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='delete.php?action=delete2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='删除书籍'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</br>";
                        $arr[$i]=$row;
                        $i++;
                      }elseif ($row['title']=="{$_POST['bookName']}") {
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "书名";
                        echo "</td>";
                        echo "<td>";
                        echo "种类";
                        echo "</td>";
                        echo "<td>";
                        echo "出版社";
                        echo "</td>";
                        echo "<td>";
                        echo "操作";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<span id='title'>".$row['title']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='category'>".$row['category']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='delete.php?action=delete2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='删除书籍'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</br>";
                        $arr[$i]=$row;
                        $i++;
                      }
                        
                    } 
                  }
              }
}
echo "</br>";
//echo @$arr[1]['title'];
?>
</div>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/borrow.js"></script>
</body>
</html>
