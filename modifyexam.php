
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
        <a href="#"> <img src="images/tulogo.png" alt="" class="tulogo" style="width:12%"></a>
		<a href="teacher_panel.php"> <h1 style="display:inline;color: white;">Teacher Panel</h1></a>	
    </div>
    <form id="modifyexamform" method="POST">
        <div class="container ">
        <input type="text" disabled value="<?php echo $_SESSION['examid'];?>">
        <input type="text" hidden name='eid' value="<?php echo $_SESSION['examid'];?>">
          <div class="row justify-content-start xyz">
            <div class="col-7">
              <input type="text" name="title" class="form-control" placeholder="New Title" required >

            </div>
            <div class="col-3">
              <input type="number" name="noq"  name="questions" id="questions" required class="form-control" placeholder="Number Of Questions">

            </div>
            <div class="col-">
              <input type="time" name="time" id="time" class="form-control" required>
            </div>
          </div>
          <div class="row justify-content-start xyz">
            <div class="col-3">
              <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="col-5">
              <span>Face Detection:  </span>
              <div class="switch">
                <input id="switch" name="face" type="checkbox" value='0' class="switch-input" />
                <label for="switch" class="switch-label">Switch</label>
              </div>
            </div>
            <div class="col-2 ">
              <button type="submit" class="btn btn-warning" >Modify Exam</button>
            </div>
          </div>
        </div>
      </form>    
<script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="teachercontrol.js"></script>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>