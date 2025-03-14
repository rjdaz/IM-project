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
<<<<<<< HEAD
      header("location: ". $_SERVER['PHP_SELF']); 
      exit();
    }

    if(isset($_POST['update'])){
      $_SESSION['emp_id'] = $_POST['emp_id'];
      header("location: userEdit.php");
      exit();
  }
  }
=======
      // header("location: ". $_SERVER['PHP_SELF']); 
      // exit();
    }
  }

  //header("refresh: 2");
>>>>>>> adabd2d126ed1d5e5e384fcbe974ea55e7bb3773
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
<<<<<<< HEAD
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
<body class="w-full h-[729px] flex flex-col items-center justify-start bg-[#e6e6ff] relative">
  <div class="w-[60%] h-[30px] flex justify-end items-center mt-10">
    <a href="login.php" class="border bg-[#0f57fe] py-2 px-5 rounded-[50px] text-white">log out</a>
  </div>
  <h1 class="w-[60%] h-[50px] text-center text-[30pt] mb-5">  
    List of Users
  </h1>
  <table class="border-2 w-[900px] text-center border-black bg-white">
        <tr class="border border-black bg-[#b3c6ff]">
=======
  <title></title>
</head>
<body class="w-full h-[729px] flex flex-col items-center justify-start bg-[#e6e6ff] ">
  <div class="w-[60%] h-[30px] flex justify-end items-center mt-10">
    <a href="login.php" class="border bg-[#0f57fe] py-2 px-5 rounded-[50px] text-white">log out</a>
  </div>
  
  <h1 class="w-[60%] h-[50px] text-center text-[30pt] mb-5">  
    List of Users
  </h1>
  <table class="border-2 w-[60%] text-center border-black">
        <tr class="border-2 border-black bg-red-300">
>>>>>>> adabd2d126ed1d5e5e384fcbe974ea55e7bb3773
            <th class="border-2 border-black">ID</th>
            <th class="border-2 border-black">First Name</th>
            <th class="border-2 border-black">Last Name</th>
            <th class="border-2 border-black">Contact Number</th>
<<<<<<< HEAD
            <th class="border-2 border-black">Username</th>
=======
            <th class="border-2 border-black">User Name</th>
>>>>>>> adabd2d126ed1d5e5e384fcbe974ea55e7bb3773
            <th class="border-2 border-black">Password</th>
            <th class="border-2 border-black w-[30px]">Action</th>
        </tr>
            <?php
                if($showlist->num_rows > 0){
                  while($row = $showlist->fetch_assoc()){
<<<<<<< HEAD
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
=======
                    echo "<tr class='border'>
                          <td>{$row['id']}</td>
                          <td>{$row['first_name']}</td>
                          <td>{$row['last_name']}</td>
                          <td>{$row['contact_number']}</td>
                          <td>{$row['username']}</td>
                          <td>{$row['password']}</td>
                          <td class='flex flex-row flex items-center'>    
                              <form method='POST' class='h-full flex items-center'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button class='h-[30%] bg-red-300 p-2 border rounded-xl' type='submit' name='delete'> Delete </button>
                              </form>
                              <form method='POST' class='h-full flex items-center'>
                                  <input type='hidden' name='emp_id' value='{$row['id']}'>
                                  <button class='h-full bg-green-300 p-2 border rounded-xl' type='submit' name='update'> Update </button>
>>>>>>> adabd2d126ed1d5e5e384fcbe974ea55e7bb3773
                              </form>                   
                          </td>   
                    </tr>";
                  }
                }
            ?>
    </table>
</body>
</html>
