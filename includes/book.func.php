
 <?php
 if(!LP)
  { 
     exit('Accsee Defined!');
	  };
 
 function _check($_num){  
	  $_num = trim($_num);
	   if(empty($_num)){
	      _alert_back($_num."不能为空");
	     }
	return $_num;
	  }
	  
?>
