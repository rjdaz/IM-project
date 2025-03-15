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
  <script src="https://cdn.tailwindcss.com"></script>
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
  <div style=" width: 60%; height: 30px; display: flex; justify-content: flex-end; align-items: center;  margin-top: 10px;">
    <a href="login.php" style="border: 1px solid transparent; background-color: #0f57fe; padding: 8px 20px; border-radius: 50px; color: white; text-align: center; cursor: pointer;">log out</a>
  </div>
  <h1 class="w-[60%] h-[50px] text-center text-[30pt] mb-5">  
    List of Users
  </h1>
  <table class="border-2 w-[900px] text-center border-black bg-white">
        <tr class="border border-black bg-[#b3c6ff]">
            <th class="border-2 border-black">ID</th>
            <th class="border-2 border-black">First Name</th>
            <th class="border-2 border-black">Last Name</th>
            <th class="border-2 border-black">Contact Number</th>
            <th class="border-2 border-black">Username</th>
            <th class="border-2 border-black">Password</th>
            <th class="border-2 border-black w-[30px]">Action</th>
        </tr>
            <?php
                if($showlist->num_rows > 0){
                  while($row = $showlist->fetch_assoc()){
                    echo "<tr class='list border h-[50px]'>
                          <td>{$row['id']}</td>
                          <td class='text-left pl-4 border'>{$row['first_name']}</td>
                          <td class='text-left pl-4 border'>{$row['last_name']}</td>
                          <td class='border'>{$row['contact_number']}</td>
                          <td class='border'>{$row['username']}</td>
                          <td class='border'>{$row['password']}</td>
                          <td class='flex flex-row flex items-center h-[50px]'>    
                              <form method='POST' class='h-full flex items-center'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button class='delete h-[30px] p-2 border border-black rounded-[5px] flex ml-2 items-center mr-3' type='submit' name='delete'> Delete </button>
                              </form>
                              <form method='POST' class='h-full flex items-center'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button 
                                    class='update h-[30px] p-2 border border-black rounded-[5px] flex items-center mr-2'
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
