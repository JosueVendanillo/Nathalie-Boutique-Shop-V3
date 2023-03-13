<?php

   session_start();

   echo '<script> alert(\'Succesfully Log out\')</script>';
   
   if(session_destroy()) {
    
      header("Location: ../admin/index.php");
       
   }

?>
