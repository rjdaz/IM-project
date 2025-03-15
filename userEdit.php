<?php
  include 'connection.php';
  session_start();

  $userId = "";
  $err = "";
  $showNewTag = false;

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
              $err = "Usename already exist!";
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
  <script src="https://cdn.tailwindcss.com"></script>
  <title>User Update Data</title>
</head>
<body class="w-full h-[729px] flex flex-col items-center justify-center bg-[#e6e6ff] ">
  <p class="text-red-400 mb-2 flex justify-center items-center text-[15pt] px-10">
      <?php
        echo $err;
      ?>
  </p>
  <div class="w-[400px] h-[500px] relative">
  <!-- Registration -->
    <div class="w-full h-full flex flex-col items-center justify-center bg-[#ffffff] blur-xs absolute">
      <h1 class="w-full h-[10%] flex justify-center items-end text-[20pt] ">Update Data</h1>
      <form method="POST" class="flex flex-col items-center w-full h-[90%] ">
          <div class="flex flex-col items-center justify-center w-full h-[90%]">
            <label for="" class="w-[70%] mt-[10px]">First Name <span class="text-[10pt] text-green">
              <?php
                 $showNewTag ? 'new' : '';
              ?>
            </span></label>
            <input type="text" placeholder="First Name" name="fname" value='<?= $row['first_name'] ?>' class="h-[30px] border w-[70%] pl-2  bg-transparent">
            <label for="" class="w-[70%] mt-[10px]">Last Name</label>
            <input type="text" placeholder="Last Name" name="lname" value='<?= $row['last_name'] ?>'  class="h-[30px] border w-[70%] pl-2 bg-transparent" >
            <label for="" class="w-[70%] mt-[10px]">Contact Number</label>
            <input type="number" placeholder="Contact Number" name="cNum" value='<?= $row['contact_number'] ?>' class="h-[30px] border w-[70%] pl-2 bg-transparent ">
            <label for="" class="w-[70%] mt-[10px]">Username</label>
            <input type="text" placeholder="Username" name="uName" value='<?= $row['username'] ?>' class="h-[30px] border w-[70%] pl-2 bg-transparent ">
            <label for="" class="w-[70%] mt-[10px]">Password</label>
            <input type="text" placeholder="Password" name="pword" value='<?= $row['password'] ?>' class="h-[30px]  border w-[70%] pl-2 bg-transparent ">
          </div>
          <div class="flex items-center w-full h-[10%] justify-center">
            <input type='hidden' name='employeeID' value='<?= $userId ?>'>
            <button type="submit" name="updateData" class="w-[70%] py-2 rounded-[50px] bg-[#0f57fe] text-white">Update</button>
          </div>
          <div class="w-full h-[10%] flex justify-center items-start">
          <p>Do you want to update the data? <a href="welcome.php" class=" text-[#0f57fe] text-[10pt]"
            style="
              text-decoration: none;" 
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