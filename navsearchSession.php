<?php 

 // starting the session
 session_start();


 if (isset($_POST['navsearch'])) { 
 $_SESSION['search'] = $_POST['search'];
 } 
 
 echo "asd";
?> 