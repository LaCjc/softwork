<?php


  if(!LP)
  { 
     exit('Accsee Defined!');
	  };
  function _connect(){
	  
	  global $conn;
	  if(!$conn =@mysql_connect('localhost','root','')){
		  exit('数据库连接失败');  
	  }
	  }
  
  
  function _select_db(){
	  
	  if(!mysql_select_db('library1'))
	  {
		  
		  exit('找不到指定数据库');
	  }
	  }
  
  
  function _set_names(){
	  if(!mysql_query("SET NAMES UTF8"))
	  {
		  exit('字符集错误');
		  }
	  }
	  
  function _query($_sql){
	 
	 if(!$_result=mysql_query($_sql)){
		 exit('SQL执行失败');
		 }
		 return $_result;
	 }
	 
	 
 function _fetch_array($_sql){
	 return mysql_fetch_array(_query($_sql));
	 }
 function _is_repeat($_sql,$_info){
		 if(_fetch_array($_sql))
		 {
			 _alert_back($_info);
			 }
		 
		 }
 function _close(){
			 
			 if(!mysql_close()){
				 exit('关闭异常');
				 }
			 
			 }
   _connect();
   _select_db();
   _set_names();
?>
