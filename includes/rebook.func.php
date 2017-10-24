 <?php

  if(!LP)
   { 
     exit('Accsee Defined!');
	  };

   function _setcookie($_string,$_username){
		
		setcookie($_string,$_username);
		
		}

	 function _unsetcookie(){
	 setcookie('bno','',time()-1);
	 //_location(null,'index.php');
	 }

?>
