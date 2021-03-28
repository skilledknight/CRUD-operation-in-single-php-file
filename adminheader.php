
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'html.php'?>
    <title>Header</title>
</head>
<body>
<?php include_once 'connect.php'?>
<?php 
 
$qry = "SELECT * FROM cms";
$res = mysqli_query($conn,$qry);
$row = mysqli_fetch_assoc($res);



// print_R($res1);
// die;
?>


<nav class="navbar navbar-inverse">

  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="#" style="font-size:20px; padding-left:15px">WebSiteName</a>
  </div>

    <ul class="nav navbar-nav" style="font-size:20px">

    <li class="active" style="padding-left:425px"><a href="admin.php">Assignment</a></li>
 
    <li class="active" style="padding-left:25px"><a href="#">Home</a></li>
    <li class="active" style="padding-left:25px"><a href="#">CMS</a></li>

   
    <li class="active" style="padding-left:25px"><a href="update.php">Update</a></li>
    <li class="active" style="padding-left:25px"><a href="adminlogin.php">Logout</a></li>

    
    </ul>
  </div>
</nav>
</body>
</html>
    <script type="text/javascript">
    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null; };
    </script>