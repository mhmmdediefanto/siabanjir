<?php
  require 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $ketinggian_hulu = $_POST['ketinggian_hulu'];
    //........................................
    
    //........................................ Updating the data in the table.
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE tbl_sensor set ketinggian_hulu = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ketinggian_suhu,$id));
    Database::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>