<?php
  
  $db_server = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "user_database";
  $conn = "";

  try {
    $conn = mysqli_connect(
        $db_server, 
        $db_user, 
        $db_password, 
        $db_name
    );

} catch (mysqli_sql_exception) {
    echo "Error connecting to database: " . $e->getMessage();
}

if($conn){
    //echo "Connected to database!";
}else{
    echo "Connection failed";
}
?>