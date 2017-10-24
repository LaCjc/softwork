<?php

    if(!LP)
  { 
     exit('Accsee Defined!');
	  };
	  
	/*function _alert_back($_info){
	 echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
	 exit();
 }*/
 
   function _check_num($_num){  
	  $_num = trim($_num);
	   if(empty($_num)){
	      _alert_back($_num."不能为空");
	     }
	return $_num;
	  }
	  
   function _check_username($_string,$_min_num,$_max_num){
	   $_string = trim($_string);
	   if(empty($_string)){
	      _alert_back($_string."不能为空");
	     }
		if(mb_strlen($_string,'utf-8')<$_min_num||mb_strlen($_string,'utf-8')>$_max_num){
		  _alert_back('用户名不能小于'.$_min_num.'位或者大于'.$_max_num.'位');
	     }
		return $_string;
	   }
  
  function _check_depart($_string){
	  $_string = trim($_string);
	  if(empty($_string)){
		  _alert_back($_string."不能为空");
		  }
	  return $_string;
	  }
  
?>
