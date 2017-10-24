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
if(@$_GET['action']=='borrow2'){
    

    if(empty($_COOKIE['username'])){
    
      _alert_back("请先登录！");

    }else{
             $_clean=array();
             @$_clean['title']=$_POST['title'];
             @$_clean['bno']=$_POST['bno'];
         if(isset($_clean['title'])){
                               $_result=_query("SELECT mark FROM book WHERE book.title='{$_clean['title']}'");
                               $row=mysql_fetch_row($_result,MYSQL_ASSOC);
                               $time=date("Y-m-d H:i:s",time()+30*24*3600);
                                     if($row['mark']==1){
                                                _query("INSERT INTO borrow(
                                                                              cno,
                                                                              bno,
                                                                              title,
                                                                              borrow_date,
                                                                              return_date
                                                                                         )VALUES(
                                                                                                '{$_COOKIE['num']}',
                                                                                                '{$_clean['bno']}',
                                                                                                '{$_clean['title']}',
                                                                                                 NOW(),
                                                                                                '{$time}'
                                                                                                 )");

                                             if(_query("UPDATE book SET mark=0 WHERE  book.title='{$_clean['title']}'")){
                                                                _alert_back("借阅成功");
                                              }
                                           }else{

                                            _alert_back("该书已经被借出");

                                           }
                             }
                }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>借阅</title>
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

<div id='content'>
<?php
if(@$_COOKIE['username']!='admin'){
echo "<form action='borrow.php?action=borrow' method='post' name='borrow'>";
echo "<dl>";
    echo "<dt>搜索借阅</dt>";
    echo "<dd>书  名：<input type='text' name='bookName'></dd>";
    echo "<dd>种  类：<input type='text' name='category'></dd>";
    echo "<dd><input type='submit' class='submit' value='搜索'></dd>";
    echo "</form>";
}else{
    echo "<div id='borrow'>";
    $i=0;
    $j=0;
    $_result=_query("SELECT * from book");
    while ($row=mysql_fetch_row($_result,MYSQL_ASSOC)) {
      if($row['mark']==1){
      $i++;
    }else{
      $j++;
    }
 }
    $_result2=_query("SELECT * from book");
    while ($row=mysql_fetch_row($_result,MYSQL_ASSOC)) {
      if($row['mark']==1){
      $i++;
    }else{
      $j++;
    }
 }
   echo "库存数量与借出书本的比例：";
   echo $j/$i; 
   echo "</div>";
}
?>
<?php
$i=0;
$arr=array(); 
if(@$_GET['action']=='borrow'){
$_result=_query("SELECT * from book");
if(@!($_POST['bar']=='ck')){
if($_result)   {           
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
                        echo "作者";
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
                        echo "<span id='category'>".$row['author']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                        if(@$_COOKIE['username']!='admin'){
                        echo "<td>";
                        echo "<form action='borrow.php?action=borrow2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='借阅'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='detail.php?action=detail' method='post' name='form1'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='详细信息'>";
                        echo "</form>";
                        echo "</td>";
                      }else{
                        echo "<td>";
                        echo "<form action='rebook.php' method='get' name='form2'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='更改书籍信息'>";
                        echo "</form>";
                        echo "</td>";
                      }
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
                        echo "作者";
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
                        echo "<span id='category'>".$row['author']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                       if(@$_COOKIE['username']!='admin'){
                        echo "<td>";
                        echo "<form action='borrow.php?action=borrow2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='借阅'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='detail.php?action=detail' method='post' name='form1'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='详细信息'>";
                        echo "</form>";
                        echo "</td>";
                      }else{
                        echo "<td>";
                        echo "<form action='rebook.php' method='get' name='form2'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='更改书籍信息'>";
                        echo "</form>";
                        echo "</td>";
                      }
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
                        echo "作者";
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
                        echo "<span id='category'>".$row['author']."</span>";
                        echo "</td>";
                        echo "<td>";
                        echo "<span id='press'>".$row['press']."</span>";
                        echo "</td>";
                        if(@$_COOKIE['username']!='admin'){
                        echo "<td>";
                        echo "<form action='borrow.php?action=borrow2' method='post' name='form1'>";
                        echo "<input type='hidden' name='bar' value='ck'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='借阅'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='detail.php?action=detail' method='post' name='form1'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='详细信息'>";
                        echo "</form>";
                        echo "</td>";
                      }else{
                        echo "<td>";
                        echo "<form action='rebook.php' method='get' name='form2'>";
                        echo "<input type='hidden' name='title' value='".$row['title']."'>";
                        echo "<input type='hidden' name='bno' value='".$row['bno']."'>";
                        echo "<input type='submit' value='更改书籍信息'>";
                        echo "</form>";
                        echo "</td>";
                      }
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
