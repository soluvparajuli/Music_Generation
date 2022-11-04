<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) ){
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_teacher.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
	<title>Document</title>
</head>
<body>
	<div class="container-fluid">
		<button type="button" class="btn btn-danger loginbtn" id="logoutbtn" >Log Out  <i class="fas fa-sign-in-alt"></i></button>
        <a href="#"> <img src="images/tulogo.png" alt="" class="tulogo" style="width:12%"></a>
		<a href="teacher_panel.php"> <h1 style="display:inline;color: white;">Uploads</h1></a>	
    </div>
    <div class="container">
      <!-- dropdown  -->
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              View Uploads
            </button>
            <div class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuButton">
              <button class="btn butt " style="display:block" value='recent'>Recent</button>
              <button class="btn butt"style="display:block" value="week">Last Week</button>
              <button class="btn butt"style="display:block" value='month'>Last Month</button>
              <button class="btn butt" style="display:block" value='all'>All Time</button>
            </div>
          </div>
          <br>
       <div class="row heading">
            <div class="col-2 cell">ID</div>
           <div class="col-6 cell">Exam Details</div>
           <div class="col-1 cell">View</div>
           <div class="col-1 cell">Add</div>
           <div class="col-1 cell">Modify</div>
           <div class="col-1 cell">Delete </div>
       </div>
       <div id="table">
      
       </div>
       
    
    </div>
  <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src='lib\popper.min.js'></script>
  <script type="text/javascript"src="lib\bootstrap.min.js"></script>
	<script type="text/javascript" src="admincontrol.js"></script>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>