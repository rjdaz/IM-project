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
    <title>Log In</title>
  </head>
  <body style="width: 100%; height: 729px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #e6e6ff; margin: 0; padding: 0; font-family: arial;">
    <p  style ="color: #f87171; margin-bottom: 0.5rem; display: flex; justify-content: center; align-items: center; font-size: 15pt; padding-left: 2.5rem; padding-right: 2.5rem;">
      <?php
        echo $err;
      ?>
    </p>
    <div style="width: 400px; height: 400px; position: relative;">
      <!-- LOg in -->
      <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #ffffff;  position: absolute; z-index: 1;"> 
        <h1 style=" width: 100%; height: 15%; display: flex; justify-content: center; align-items: flex-end; font-size: 20pt">Log in</h1>
        <form action="" 
              method="POST" 
              style="display: flex; flex-direction: column; align-items: center; width: 100%; height: 80%;">
          <div style=" display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 70%;">
            <input  type="text" 
                    placeholder="Username" 
                    name="loginUname" 
                    style="height: 30px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px;  background-color: transparent;">
            <input  type="password" 
                    placeholder="Password" 
                    name="loginPword" 
                    style="height: 30px; margin-top: 50px; width: 70%; border: none; border-bottom: 1px solid gray; padding-left: 8px; background-color: transparent;">
          </div>
          <div  style="display: flex; align-items: center; justify-content: center; width: 100%; height: 15%;">
            <button 
              type="submit" 
              name="login" 
              style=" width: 70%; height: 100%; padding-top: 8px; padding-bottom: 8px; border: none; border-radius: 50px; background-color: #0f57fe; color: white; text-align: center;">Log In</button>
          </div>
          <div  style=" width: 100%; height: 10%; display: flex; justify-content: center; align-items: flex-start;">
          <p style="">Don't have an account? 
            <a  href="register.php"
                style="
                  text-decoration: none; color: #0f57fe; font-size: 10pt;" 
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