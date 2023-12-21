<?php
   session_start();

   unset($_SESSION['user']); // removing the value from the session user
   unset($_SESSION['adm']); // removing the value from the session adm
   session_unset(); // removing the value from all sessions
   session_destroy(); 
   header("Location: ./login_register.php");