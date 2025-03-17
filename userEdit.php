<?php
  include 'connection.php';
  session_start();

  $userId = "";
  $err = "";

    if(isset($_SESSION['emp_id'])){
      $userId = $_SESSION['emp_id'];
    }else{
      $userId = "No ID received";
    }

    $getData = "SELECT * FROM user WHERE id = $userId";
    $results = $conn->query($getData);
    $row = "";

    if ($results->num_rows > 0) {
      $row = $results->fetch_assoc();
    } else {
      echo "No data found";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['updateData'])){
        $emp_id = $_POST['employeeID'];
        $newFname = $_POST['fname'];
        $newLname = $_POST['lname'];
        $newCnum = $_POST['cNum'];
        $newUname = $_POST['uName'];
        $newPword = $_POST['pword'];
          if(empty($newFname) || empty($newLname) || empty($newCnum) || empty($newUname) || empty($newPword)){
            $err = "All fields are required to input data!!";
          }else{
            $checkData_sql = "SELECT * FROM user WHERE username = '$newUname' AND id != '$emp_id'";
            $checkingData = $conn->query($checkData_sql);
            $regCountRow = mysqli_num_rows($checkingData);
            if($regCountRow > 0){
              $err = "Username already exist!";
            }else{
              $update_sql = "UPDATE user
                           SET first_name = '$newFname', 
                                last_name = '$newLname', 
                                contact_number = '$newCnum', 
                                username = '$newUname',
                                password = '$newPword' 
                           WHERE id = $emp_id";
            $conn->query($update_sql);
            header("location: welcome.php");
            exit();
            } 
          }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Update Data</title>
</head>
<body style="font-family: arial; width: 100%; height: 729px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #e6e6ff;">
  <p  style=" color: #f87171; margin-bottom: 8px; display: flex; justify-content: center; align-items: center; font-size: 15pt; padding-left: 40px; padding-right: 40px;">
      <?php
        echo $err;
      ?>
  </p>
  <div style=" width: 400px;  height: 500px; position: relative;">
  <!-- Registration -->
    <div style=" width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #ffffff; position: absolute;">
      <h1 style=" width: 100%; height: 10%; display: flex; justify-content: center; align-items: flex-end; font-size: 20pt;">Update Data</h1>
      <form method="POST" 
            style=" display: flex; flex-direction: column; align-items: center; width: 100%; height: 90%;">
          <div style=" display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 90%;">
            <label  for="" 
                    style=" width: 70%; margin-top: 10px;">First Name</label>
            <input  type="text" 
                    placeholder="First Name" 
                    name="fname" 
                    value='<?= $row['first_name'] ?>'
                    style=" height: 30px; width: 70%; border: 1px solid gray; padding-left: 8px; background-color: transparent;">
            <label  for="" 
                    style=" width: 70%; margin-top: 10px;">Last Name</label>
            <input  type="text" 
                    placeholder="Last Name" 
                    name="lname" 
                    value='<?= $row['last_name'] ?>'  
                    style="height: 30px; width: 70%; border: 1px solid gray; padding-left: 8px; background-color: transparent;" >
            <label  for="" 
                    style=" width: 70%; margin-top: 10px;">Contact Number</label>
            <input  type="number" 
                    placeholder="Contact Number" 
                    name="cNum" 
                    value='<?= $row['contact_number'] ?>' 
                    style="height: 30px; width: 70%; border: 1px solid gray; padding-left: 8px; background-color: transparent; ">
            <label  for="" 
                    style=" width: 70%; margin-top: 10px;">Username</label>
            <input  type="text" 
                    placeholder="Username" 
                    name="uName" 
                    value='<?= $row['username'] ?>' 
                    style="height: 30px; width: 70%; border: 1px solid gray; padding-left: 8px; background-color: transparent; ">
            <label  for="" 
                    style=" width: 70%; margin-top: 10px;">Password</label>
            <input  type="text" 
                    placeholder="Password" 
                    name="pword" 
                    value='<?= $row['password'] ?>' 
                    style=" height: 30px; width: 70%; border: 1px solid gray; padding-left: 8px; background-color: transparent; ">
          </div>
          <div  style=" display: flex; align-items: center; justify-content: center; width: 100%; height: 10%;">
            <input  type='hidden' 
                    name='employeeID' 
                    value='<?= $userId ?>'>
            <button type="submit" 
                    name="updateData" 
                    style="  width: 70%; height: 100%; padding: 8px 0; border:none; border-radius: 50px; background-color: #156082; color: white; text-align: center;">Update</button>
          </div>
          <div style="margin-top: -10px; width: 100%; height: 10%; display: flex; justify-content: center; align-items: flex-start;font-size:10pt;">
          <p>Do you want to update the data? <a href="welcome.php" 
            style="
              text-decoration: none; color: #156082;" 
              onmouseover="this.style.textDecoration='underline'" 
              onmouseout="this.style.textDecoration='none' 
            "
          >Back</a></p>
          </div> 
      </form>
    </div>
  </div>
</body>
</html>
