<?php
include 'connection.php';
session_start();

  $err = "";

  $select_sql = "SELECT * FROM user";
  $showlist = $conn->query($select_sql);

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['delete'])){
      $employeeID = $_POST['emp_id'];
      $delete_sql = "DELETE FROM user WHERE id = $employeeID";
      $conn->query($delete_sql);
      echo "Employee Deleted! <br>";
      header("location: ". $_SERVER['PHP_SELF']); 
      exit();
    }

    if(isset($_POST['update'])){
      $_SESSION['emp_id'] = $_POST['emp_id'];
      header("location: userEdit.php");
      exit();
  }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  href="style.css">
  <title>Home</title>
  <style>
    body{
      width: 100%;
      height: 729px;
    }

    .delete:hover{
      background-color: red;
      color: white;
    }

    .update:hover {
      background-color: green;
      color: white;
    }

    .list:hover{
      background-color: #e6eeff;
    }
  </style>
</head>
<body style=" width: 100%; height: 729px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; background-color: #e6e6ff; position: relative;">
  <div style=" width: 60%; height: 30px; display: flex; justify-content: flex-end; align-items: center;  margin-top: 60px;">
    <a href="login.php" style="border: 1px solid transparent; background-color: #0f57fe; padding: 8px 20px; border-radius: 50px; color: white; text-align: center; cursor: pointer; text-decoration: none;">Log out</a>
  </div>
  <h1 style=" width: 60% height: 50px; text-align: center; font-size: 30pt; margin-bottom: 20px;">  
    List of Users
  </h1>
  <table style=" width: 900px; border-collapse: collapse; border: 1px solid black; text-align: center; background-color: white;">
        <tr style="border: 1px solid black;; background-color: #b3c6ff;">
            <th style="border: 1px solid black;">ID</th>
            <th style="border: 1px solid black;">First Name</th>
            <th style="border: 1px solid black;">Last Name</th>
            <th style="border: 1px solid black;">Contact Number</th>
            <th style="border: 1px solid black;">Username</th>
            <th style="border: 1px solid black;">Password</th>
            <th style=" width: 30px; border: 1px solid black;">Action</th>
        </tr>
            <?php
                if($showlist->num_rows > 0){
                  while($row = $showlist->fetch_assoc()){
                    echo "<tr class='list' style='border: 1px solid black; height: 50px;'>
                          <td style='text-align: left;  padding-left: 16px;'>{$row['id']}</td>
                          <td style= 'text-align: left;  padding-left: 16px;'>{$row['first_name']}</td>
                          <td style=' text-align: left; padding-left: 16px;'>{$row['last_name']}</td>
                          <td style=' '>{$row['contact_number']}</td>
                          <td style=' '>{$row['username']}</td>
                          <td style=' '>{$row['password']}</td>
                          <td style=' display: flex; flex-direction: row; align-items: center; height: 50px;'>    
                              <form method='POST' style='height: 100%; display: flex; align-items: center;'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button class='delete' style='height: 30px; padding: 8px; border: 1px solid black; border-radius: 5px; display: flex; align-items: center; margin-left: 8px; margin-right: 12px;' type='submit' name='delete'> Delete </button>
                              </form>
                              <form method='POST' class='h-full flex items-center'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button 
                                    class='update'  style='height: 30px; padding: 8px; border: 1px solid black; border-radius: 5px; display: flex; align-items: center; margin-right: 8px;'
                                    name='update'
                                    > Update </button>
                              </form>                   
                          </td>   
                    </tr>";
                  }
                }
            ?>
    </table>
</body>
</html>
