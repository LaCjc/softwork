<?php
if(!LP)
  { 
     exit('Accsee Defined!');
	  };

function _alert_back($_info){
	 echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
	 exit();
 }

function _location($_info,$_url){
    if(!empty($_info)){
     echo "<script type='text/javascript'>alert('".$_info."');location.href='$_url';</script>";
     exit();}else{
     header('location:'.$_url);
		 }
 }

?>
