<?php
 
    if(!LP)
  { 
     exit('Accsee Defined!');
	  };
	  
    function _setcookies($_string,$_username){
		
		setcookie($_string,$_username);
		
		}
	
	function _unsetcookies(){
	 setcookie('username','',time()-1);
	 _location(null,'index.php');
	 }
		
	function _check_num($_num,$_min_num){
	   if(strlen($_num)<$_min_num)
	     {
			 _alert_back('学号不能小于'.$_min_num.'位');
		 }
	   return $_num;
	   }

    function _check_username($_string,$_min_num,$_max_num){
	  $_string = trim($_string);
	//限制用户名长度
    if(mb_strlen($_string,'utf-8')<$_min_num||mb_strlen($_string,'utf-8')>$_max_num)
	{
		_alert_back('用户名不能小于'.$_min_num.'位或者大于'.$_max_num.'位');
	}

	//将用户名转义输入
	//return _mysql_string($_string);
	return $_string;
	}
   
   

   function _login_state(){
	 
	 if(isset($_COOKIE['username'])){
		 _alert_back('登录状态无法进行本操作!');
		 }
	 }



?>
