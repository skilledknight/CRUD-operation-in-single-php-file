
<?php session_start();
    
    include_once 'connect.php';
    
    if(isset($_POST['login']))
    {
        $email = $_POST['uemail'];
        $password = md5($_POST['upass']);   
        
      
     $qry1 = "SELECT * FROM admin where Email='$email' AND Password='$password'";
     $res1 = mysqli_query($conn,$qry1);
     $row1 = mysqli_fetch_assoc($res1);  
    
     
    
     if($row1)
     {
                $_SESSION['admin'] = $row1['Name'];
                header("location:admin.php");  
        }   
     }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'html.php' ?>
<title>Login Page</title>
</head>
<body>

<div class="container">
    <h3>Login Form</h3>
    <hr>
        <form action="" method="POST">
        <div class="form-group col-md-8">
                <label for="uemail">Email</label>
                <input type="email" name="uemail" class="form-control">
                <span class="text-danger"></span>
        </div>

        <div class="form-group col-md-8">
                <label for="upass">Password</label>
                <input type="password" name="upass" class="form-control">
                <span class="text-danger"></span>
        </div>


        <div class="form-group col-md-8">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
        </div>
</body>
</html>

<!-- <script type="text/javascript">
    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null; };
</script> -->
