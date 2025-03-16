<?php
  include 'connection.php';

  $err = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['insert'])){
        $fName = $_POST['fname'];
        $lName = $_POST['lname'];
        $cNum = $_POST['cNum'];
        $uName = $_POST['uName'];
        $pWord = $_POST['pword'];

        if(empty($fName) || empty($lName) || empty($cNum) || empty($uName) || empty($pWord)){
          $err = "All fields are required to input data!!";
        }else{
          $checkData_sql = "SELECT * FROM user WHERE username = '$uName'";
          $checkingData = $conn->query($checkData_sql);
          $regCountRow = mysqli_num_rows($checkingData);
            if($regCountRow > 0){
              $err = "Already have same username. Try Again!!";
            }else{
              if(strlen($cNum) !== 11){
                $err = "Oops! Your contact number must contain exactly 11 digits.";
              }else{
                $insert_sql = "INSERT INTO user (first_name, last_name, contact_number, username, password) VALUES ('$fName', '$lName', '$cNum', '$uName', '$pWord')";
                $result = $conn->query($insert_sql);
                  if($result){
                      $err = "New Account Added!!";
                      header("Location: login.php");
                      exit();
                  }else{
                      $err =  "Incorrect Input!!";
                  }
              }
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
    <title>Registration</title>
  </head>
  <body style="font-family: arial; width: 100%; height: 729px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #e6e6ff;">
    <p  style="color: #f87171; margin-bottom: 0.5rem; display: flex; justify-content: center; align-items: center; font-size: 15pt; padding-left: 2.5rem; padding-right: 2.5rem;">
      <?php
        echo $err;
      ?>
    </p>
    <div  style="width: 400px; height: 400px; position: relative;">
      <!-- Registration -->
      <div  style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #ffffff; position: absolute;">
        <h1 style=" width: 100%; height: 15%; display: flex; justify-content: center; align-items: flex-end; font-size: 20pt;">Registration</h1>
        <form method="POST" 
              style=" display: flex; flex-direction: column; align-items: center; width: 100%; height: 80%;">
            <div  style=" display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 70%;">
              <input  type="text" 
                      placeholder="First Name" 
                      name="fname"
                      required
                      style=" height: 30px; margin-top: 10px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent;">
              <input  type="text" 
                      placeholder="Last Name" 
                      name="lname"
                      required
                      style=" height: 30px; margin-top: 10px; width: 70%;border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent; outline: none; border-radius: 0;" >
              <input  type="number" 
                      placeholder="Contact Number" 
                      name="cNum"
                      required
                      style=" height: 30px; margin-top: 10px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent; outline: none; border-radius: 0; border-width: 1px;">
              <input  type="text" 
                      placeholder="Username" 
                      name="uName"
                      required
                      style=" height: 30px; margin-top: 10px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent; outline: none; border-radius: 0;">
              <input  type="password" 
                      placeholder="Password" 
                      name="pword"
                      required 
                      style="height: 30px; margin-top: 10px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent; outline: none; border-radius: 0;">
            </div>
            <div  style="margin-top:5px; display: flex; align-items: center; justify-content: center; width: 100%; height: 15%;">
              <button type="submit" 
                      name="insert" 
                      style=" width: 70%; height: 80%; padding-top: 8px; padding-bottom: 8px; border-radius: 50px; background-color: #0f57fe; color: white; text-align: center; border: none; cursor: pointer;">Register</button>
            </div>
            <div style="margin-top:-15px; width: 100%; height: 10%; display: flex; justify-content: center; align-items: start;">
            <p style="">Already have an account?  <a href="login.php" 
              style="
               text-decoration: none;
               color: #0f57fe;                                                
               " 
               onmouseover="this.style.textDecoration='underline'" 
               onmouseout="this.style.textDecoration='none'" 
              "
            >LogIn</a></p>
            </div> 
        </form>
      </div>
    </div>
  </body>
</html>