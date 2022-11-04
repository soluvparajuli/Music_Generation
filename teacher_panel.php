<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Teacher" ){
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
		<div class="btn-group loginbtn" role="group" aria-label="Basic example">
			<button type="button" class="btn btn-secondary" id="studentbtn" active>My Profile</button>
			<button type="button" class="btn btn-secondary" id="teacherbtn">Help</button>
		</div>
		<a href="teacher_panel.php"> <h1 style="display:inline;color: white;margin-left: 10rem;">Teacher Panel</h1></a>
		
	</div>
	
<div class="sidenav">
	<a href="#"> <img src="images/tulogo.png" alt="" class="tulogo"></a>
	<a href="viewExamsTeacher.php">View Exams</a>
	<a href="newExam.php">New Exam</a>
  </div>
  

  <script typt="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="teachercontrol.js"></script>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>