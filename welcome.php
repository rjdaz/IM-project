<?php
include 'connection.php';

  $err = "";

  $select_sql = "SELECT * FROM user";
  $showlist = $conn->query($select_sql);

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['delete'])){
      $employeeID = $_POST['emp_id'];
      $delete_sql = "DELETE FROM user WHERE id = $employeeID";
      $conn->query($delete_sql);
      echo "Employee Deleted! <br>";
      // header("location: ". $_SERVER['PHP_SELF']); 
      // exit();
    }
  }

  //header("refresh: 2");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
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
            <th class="border-2 border-black">ID</th>
            <th class="border-2 border-black">First Name</th>
            <th class="border-2 border-black">Last Name</th>
            <th class="border-2 border-black">Contact Number</th>
            <th class="border-2 border-black">User Name</th>
            <th class="border-2 border-black">Password</th>
            <th class="border-2 border-black w-[30px]">Action</th>
        </tr>
            <?php
                if($showlist->num_rows > 0){
                  while($row = $showlist->fetch_assoc()){
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
                              </form>                   
                          </td>   
                    </tr>";
                  }
                }
            ?>
    </table>
</body>
</html>
