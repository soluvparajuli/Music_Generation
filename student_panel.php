
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Student" ){
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
		<button type="button" class="btn btn-danger loginbtn" id="logoutbtn" >Log Out  <i class="fas fa-sign-in-alt"></i></button>
		<div class="btn-group loginbtn" role="group" aria-label="Basic example">
			<button type="button" class="btn btn-secondary" id="profilebtn" active>My Profile</button>
			<button type="button" class="btn btn-secondary" id="helpbtn">Help</button>
		</div>
		<a href="student_panel.php"> <h1 style="display:inline;color: white;margin-left: 10rem;">Student Panel</h1></a>
		
	</div>
<div class="sidenav">
	<a href="#"> <img src="images/tulogo.png" alt="" class="tulogo"></a>
	<a href="viewExamsStudent.php" >Attended Exams</a>
	<a href="scheduledExams.php" >Scheduled Exams</a>
  </div>
<form action="" id="schedule" method="post">
	<div class="container " style="margin-left:10rem;margin-top:5rem;">
		<div class="row">
			<div class="col-4">
				<input type="text" placeholder="Enter Exam ID" name="examid" id="idinput" required class="form-control">
			</div>
			<div class="col-2">
				<button  class="btn btn-primary">Schedule</button>
			</div>
		</div>
	</div>
</form>
<script typt="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="studentcontrol.js"></script>	
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>