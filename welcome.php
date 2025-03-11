<?php
session_start();
include 'connection.php';

  $login_session = $_SESSION['username'];

  $check_sql = "SELECT * FROM user WHERE username = '$login_session'";

  $result = $conn->query($check_sql);
  $row = $result->fetch_assoc();

  $firstname = $row['first_name'];
  $lastname = $row['last_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<body>
  <a href="login.php">log out</a>
  <h1>Welcome
    <?php
    echo $firstname . " " . $lastname;
    ?>

  </h1>
</body>

</html>