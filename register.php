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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registration</title>
  </head>
  <body class="w-full h-[729px] flex flex-col items-center justify-center bg-[#e6e6ff] ">
    <p class="text-red-400 mb-2 flex justify-center items-center text-[15pt] px-10">
      <?php
        echo $err;
      ?>
    </p>
    <div class="w-[400px] h-[400px] relative">
      <!-- Registration -->
      <div class="w-full h-full flex flex-col items-center justify-center bg-[#ffffff] blur-xs absolute">
        <h1 class="w-full h-[15%] flex justify-center items-end text-[20pt] ">Registration</h1>
        <form method="POST" class="flex flex-col items-center w-full h-[80%]">
            <div class="flex flex-col items-center justify-center w-full h-[70%]">
              <input type="text" placeholder="First Name" name="fname" class="h-[30px] mt-[10px] border-b w-[70%] pl-2  bg-transparent">
              <input type="text" placeholder="Last Name" name="lname" class="h-[30px] mt-[10px] border-b w-[70%] pl-2 bg-transparent" >
              <input type="number" placeholder="Contact Number" name="cNum" class="h-[30px] mt-[10px] border-b w-[70%] pl-2 bg-transparent ">
              <input type="text" placeholder="Username" name="uName" class="h-[30px] mt-[10px] border-b w-[70%] pl-2 bg-transparent ">
              <input type="password" placeholder="Password" name="pword" class="h-[30px] mt-[10px] border-b w-[70%] pl-2 bg-transparent ">
            </div>
            <div class="flex items-center w-full h-[15%] justify-center">
              <button type="submit" name="insert" class="w-[70%] py-2 rounded-[50px] bg-[#0f57fe] text-white">Register</button>
            </div>
            <div class="w-full h-[10%] flex justify-center items-start">
            <p>Already have an account? <a href="login.php" class=" text-[#0f57fe] text-[10pt]"
              style="
               text-decoration: none;" 
               onmouseover="this.style.textDecoration='underline'" 
               onmouseout="this.style.textDecoration='none' 
              "
            >LogIn</a></p>
            </div> 
        </form>
      </div>
    </div>
  </body>
</html>