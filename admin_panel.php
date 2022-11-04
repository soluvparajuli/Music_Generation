<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Admin" ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_student.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container-fluid">
                <div class="btn-group loginbtn" role="group" aria-label="Basic example">
                    <button disabled="disabled"><strong style="color:white;"><?php echo $_SESSION['username']?> </strong></button>
                    <button class="btn btn-danger" style="margin-top: 0px; " id="logoutbtn">  Log Out <i class="fas fa-sign-in-alt"></i> </button>
                </div>
                <button type="button" class="btn btn-success loginbtn green" id="loginbtn" disabled>Current User <i class="fas fa-sign-in-alt"></i></button>
            
               
        </div>
        <div class="sidenav">
            <a href="#"> <img src="images/tulogo.png" alt="" class="tulogo"></a>
            <a href="viewuploads.php" >My Uploads</a>
            <a href="viewplaylist.php" >My Playlist</a>
       </div>
      <!-- <form action="upload_handle.php" id="upload" method="post" enctype="multipart/form-data">
          <div class="container " style="margin-left:10rem;margin-top:5rem;">
            <div class="row">
              <div class="col-6">
              <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input style="color: white;" type="file" name="userfile" id="fileupload"  enctype="multipart/form-data">
              </div>
              <div class="col-2">
              <input name="upload" type="submit" class="box" id="upload" value=" upload">
              </div>
            </div>
          </div>
        </form> -->
        <!-- temp solution to file upload -->
        <div class="wrapper">
              <header>File Upload</header>
              <form action="#" id="myform">
                <input class="file-input" type="file" name="file" hidden>
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Browse File to Upload</p>
              </form>
              <section class="progress-area"></section>
              <section class="uploaded-area"></section>
         </div>
    </div>
<script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="admincontrol.js"></script>
<script type="text/javascript" src="uploadcontrol.js"></script>
</body> 
</html>

<?php
}
else{
  header("location:index.php");
}
?>