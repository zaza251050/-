<?php
   $db_servername = "localhost";
   $db_username = "root";
   $db_usrepass = "";
   $db_name = "post office_as";
     
try {
    $dbcon = new PDO("mysql:host=$db_servername;dbname=$db_name",$db_username,$db_usrepass);
   
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //   echo "Connect to database successful<br>";

   } 
   catch(PDOException $e){
echo "Faild to coonnect to database". $e->getMessage();
   }

?>