<?php
  
 function getConnection(){
      $con = mysqli_connect("localhost", "root", "", "ubt");

   if(!$con){
    return;
   }
    return $con;
 }
?>