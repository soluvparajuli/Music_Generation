
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Student" ){
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
		<a href="Student_panel.php"> <h1 style="display:inline;color: white;">Student Panel</h1></a>	
    </div>

    <div class="container">
       <div class="row heading">
            <div class="col-1 cell">ID</div>
            <div class="col-6 cell">Exam Details</div>
            <div class="col-2 cell">Date</div>
            <div class="col-1 cell">Time</div>
            <div class="col-1 cell">View Result</div>
            <div class="col-1 cell " >Delete Exam </div>
       </div>
       <div id="attendedtable">
      
      </div>

      <!-- <form action="examPage.php" method="GET">
        <div class="row ">
            <input type="text" name="ExamID" hidden value="ExamId">
            <div class="col-1 cell">1</div>
            <div class="col-8 cell " id="details">OOP</div>
            <div class="col-1 cell"><button type ="button" class="btn btn-outline-warning " id="stopwatch"><i class="fas fa-stopwatch"></i></button></div>
            <div class="col-1 cell"><button type="button" class="btn btn-outline-success"><i class="far fa-eye"></i></button></div>
            <div class="col-1 cell"><button type="submit" class="btn btn-outline-info" id="takeexambtn"><i class="fas fa-exchange-alt"></i></button></div>
        </div>
      </form> -->
    </div>
<script typt="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="studentcontrol.js"></script>
<script type="text/javascript" src="attend.js"></script>
	
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>