<?php
  include 'connection.php';
  session_start();

  $err = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['login'])){
        $loginUname = $_POST['loginUname'];
        $loginPword = $_POST['loginPword'];
        
        $login_sql = "SELECT * FROM user WHERE username = '$loginUname' AND password = '$loginPword'";

        $loginResult = mysqli_query($conn,$login_sql);
        $loginCountRow = mysqli_num_rows($loginResult);

          if($loginCountRow == 1){
            $_SESSION['username'] = $loginUname;
            header("Location: welcome.php");
            exit();  
          }else{
            $err = "invalid login!";
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
    <title>Log In</title>
  </head>
  <body class="w-full h-[729px] flex flex-col items-center justify-center bg-[#e6e6ff] ">
    <p class="text-red-400 mb-2 flex justify-center items-center text-[15pt] px-10">
      <?php
        echo $err;
      ?>
    </p>
    
    <div class="w-[400px] h-[400px] relative">
      <!-- LOg in -->
      <div class="w-full h-full flex flex-col items-center justify-center bg-[#ffffff] blur-xs absolute z-[1]"> 
        <h1 class="w-full h-[15%] flex justify-center items-end text-[20pt] ">Log in</h1>
        <form action="" method="POST" class="flex flex-col items-center w-full h-[80%]">
          <div class="flex flex-col items-center justify-center w-full h-[70%]">
            <input type="text" placeholder="Username" name="loginUname" class="h-[30px] border-b w-[70%] pl-2  bg-transparent">
            <input type="password" placeholder="Password" name="loginPword" class="h-[30px] mt-[50px] border-b w-[70%] pl-2 bg-transparent" >
          </div>
          <div class="flex items-center w-full h-[15%] justify-center">
            <button type="submit" name="login" class="w-[70%] py-2 rounded-[50px] bg-[#0f57fe] text-white">Log In</button>
          </div>
          <div class="w-full h-[10%] flex justify-center items-start">
          <p>Don't have an account? <a href="register.php" class=" text-[#0f57fe] text-[10pt]"
            style="
               text-decoration: none;" 
               onmouseover="this.style.textDecoration='underline'" 
               onmouseout="this.style.textDecoration='none' 
            "
            >SignUp</a></p>
        
        </div>
        </form>
        
      </div>
    </div>
  </body>
</html>