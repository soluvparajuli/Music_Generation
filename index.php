<?php

session_start();

if(isset($_SESSION['username'])){
  set_time_limit(3);
  ?>
<br>
 <h5 style="text-align:center; color:white; "><?php echo $_SESSION["usertype"] ." "?> <strong><?php echo $_SESSION['username']?> </strong> is currently logged in.<h5>
  
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container-fluid">
                <div class="btn-group loginbtn" role="group" aria-label="Basic example">
               
                    <button type="button" class="btn btn-secondary" id="teacherbtn">Register</button>
                    <button type="button" class="btn btn-secondary " id="adminbtn">User</button>
                </div>
                <button type="button" class="btn btn-success loginbtn green" id="loginbtn" >Log in  <i class="fas fa-sign-in-alt"></i></button>
                <img class="tulogo" src="images/tulogo.png" alt="LOGO!">
        </div>
        <div class="container">
            
                <div class="titleshowcase " id="titleshowcase">
                    <img src="images/logo.jpg" alt="examlogo">
                    <h1>Music Generation</h1>
                    <footer>
                        <p>Copyright &copy; HCOE/BCT/ 2074/</p>
                    </footer>
                </div>
                <div class="loginform">
                <div id="teacherform" class="notshown">
                        <h1>Create An Account</h1>
                        <form id="addteacherform" method="POST">
                          <div class="form-group">
                            <label for="Inputname2">Name</label>
                            <input type="text" name="name" class="form-control" id="Inputname2"  maxlength="25" minlength="5" required>
                          </div>
                            <div class="form-group">
                              <label for="InputEmail2">Email address</label>
                              <input type="email" name="email" class="form-control" id="InputEmail2"  aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <label for="InputPassword2">Password</label>
                              <input type="password" name="pass" class="form-control" id="InputPassword2" minlength="8" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                          </form>
                    </div>
                    <div id="adminform" class="notshown">
                        <h1>Admin login</h1>
                        <form id="adminloginform" method="POST">
                            <div class="form-group">
                              <label for="exampleInputEmail3">Email address</label>
                              <input name='email' type="email" class="form-control" id="InputEmail3" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input name="pass"  minlength="8" type="password" class="form-control" id="InputPassword3" required>
                            </div>
                            <button type="submit" class="btn btn-success " id="adminloginbtn">Log In</button>
                          </form>
                    </div>
                </div>

        </div>
    </div>
<script type ="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="indexcontrol.js"></script>
</body> 
</html>