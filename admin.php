<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'adminheader.php'?>
<?php include 'html.php' ?>
<title>Admin Registration</title>
</head>
<body>
    <?php session_start();
    include_once 'connect.php'; 
 
    $unameErr = $addressErr = $roleErr ="";
    if(isset($_POST['insert']))
    {
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = $_POST['uname'];
        $role = $_POST['role'];
        $address = $_POST['address'];       
       
       
        if(!empty($_POST['uname']))
         {
             //$pattern = "/^[a-z-A-Z]+$/i";
                $uname = test_input($_POST['uname']);
             
        } else {
                 $unameErr= "Please enter your name!";
             }

         if(!empty($_POST['role']))
         {
             $role = test_input($_POST['role']);
         }
         else
         {
             $roleErr = "Please select your role";
         }

         if(!empty($_POST['address']))
         {
             $address = test_input($_POST['address']);
         }
         else
         {
             $addressErr = "Please enter your address!";
         }
     
        if($uname != '' && $role != '' && $address!='') 
        {
            $qry = "INSERT INTO cms (Name,Description,Role,CreatedDate) VALUES('$uname','$address','$role',now())";    
         $res = mysqli_query($conn, $qry);
       
        
         if($res)
         {
             echo '<h3 style="color:green">Registered Successfully!</h3>';
         }
         else
         {
             echo "Error=>".mysqli_error($conn);
         }
    }
       
    }
    ?>
    <?php 
            include_once 'connect.php';
            $role1 = "";
            
            
            if($_SERVER["REQUEST_METHOD"] == "GET")
            {

                if(isset($_GET['id1']))
                {
                $Id1 = base64_decode($_GET['id1']);
                
                $qry = "SELECT Name,Description,Role FROM cms WHERE id='$Id1'";
                $res = mysqli_query($conn, $qry);
                $res1 = mysqli_fetch_assoc($res);
                $uname = $res1['Name'];
                $address = $res1['Description'];
                $role1 = $res1['Role'];
                }
            }     
            if(isset($_POST['update']))
            { 
                if(isset($_GET['id1']))
                    {
                    
                    $id1=base64_decode($_GET['id1']);
                    $uname = $_POST['uname'];
                    $address =  $_POST['address'];
                    $role =  $_POST['role'];
                    $qry2 = "UPDATE cms SET Name ='$uname', Description = '$address',Role='$role' WHERE id='$id1'";
                    $res2 = mysqli_query($conn,$qry2);
                if(mysqli_error($conn))
                {
                    echo "error";
                 } else {
                    $_SESSION['success'] = "Record Updated Successfully!";
                   header("location:admin.php");
                }                    
            } 
        }                              
    
    ?>
 <div class="container">
    <?php if(isset($_SESSION['success'])) {
     echo "<p>".$_SESSION['success']."</p>";
     unset($_SESSION['success']);
        } ?>

 <h3>Task Assignment</h3>

    <hr>
        <form action="" method="POST">
        <div class="form-group col-md-8">
                <label for="uname">Name</label>
                <input type="text" name="uname" value="<?php if (!empty($uname)) echo $uname ?>" class="form-control">    
                  <span class="text-danger"><?=$unameErr?></span>   
       </div>

        <div class="form-group col-md-8">
			<label>Description</label> 

		    <textarea name="address" value="<?php if (!empty($address)) echo $address ?>" class="form-control" row="3"><?php if (!empty($address)) echo $address ?></textarea>
           <span class="text-danger"><?=$addressErr?></span>
		</div>
         <div class="form-group col-md-8">
                 <label>Role</label>
               <select name="role" id="" class="form-control">
                 <option value="Inactive"  class="form-control"></option>
                <option value="Inactive"<?php if ($role1 == 'Inactive') echo "selected"; ?> class="form-control">Inactive</option>   
                
               <option value="Active"<?php if ($role1 == 'Active') echo "selected"; ?> class="form-control">Active</option>            
             </select>
             <span class="text-danger"><?=$roleErr?></span>
 		</div>        

         <div class="form-group col-md-8">
         <?php
        if(isset($_GET['id1']))
        { 
           
            echo "<input type='submit' class='btn btn-primary' name='update' value='Update'>";     
        }
        else 
        {
           echo "<input type='submit' class='btn btn-primary' name='insert' value='Insert'>";
        }
  
        ?>
        </div>
 </form>
</div> 
</body>
</html>

<?php 
$qry = "SELECT id,Name,Description,Role,isDeleted FROM cms";
  
   $res = mysqli_query($conn,$qry);

   echo "<br>";
   
   echo "<form action='' method='POST'>";
          echo "<table style='color:green;margin-left:20px;' class= 'table table-border'>";
          if(mysqli_num_rows($res) > 0)
          {
              $i = 1;

              $field = mysqli_fetch_fields($res);
              
              echo "<tr style='background-color:orange'>";
              foreach($field as $col)
              {
                  echo "<td>".$col->name."</td>";
              }
              echo "<td> Action </td>";
              //echo "<td></td>";
              echo "</tr>";

              while($row=mysqli_fetch_assoc($res))
              {
                  echo "<tr>";
                  echo "<td>".$i++."</td>";
                  echo "<td>".$row['Name']."</td>"."<td>".$row['Description']."</td>"."<td>".$row['Role']."</td>";
                  if($row['isDeleted'] == '0' )
                  {
                    echo "<td><a href='admin.php?id=".base64_encode($row['id'])."'><span class='btn btn-primary'>Delete</span></a></td>";
                  }
                  else 
                  {
                    echo "<td><span class='btn btn-primary' disabled>Delete</span></td>"; 
                  }
                  echo "<td><a href='admin.php?id1=".base64_encode($row['id'])."'><span class='btn btn-primary'>Update</span></a></td>";
                  
              echo "<tr>";
              }
              
          }
          echo "</table>";
          echo "</form>";
              ?>


<?php

include_once 'connect.php';
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['id']))
    {
    $Id = base64_decode($_GET['id']);
    $qry = "UPDATE cms SET isDeleted = '1' WHERE id = '$Id'";
    $res = mysqli_query($conn,$qry);
  }
}
?>



