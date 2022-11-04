<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Teacher" && isset($_SESSION['examid'])){
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
    <div class="container">
        
          <div class="alert alert-warning" role="alert">
            Please note the Exam ID.It will be required for attending the exam.
          </div>

    </div>
<form action="addquestion_handle.php" method="post">
    <!-- The text field -->
   
    <div class="container quest">
    <span style="color: white;">Exam ID:</span>
    <input type="text" name="examid" class="form-control col-2" value="<?php echo $_SESSION['examid']?>" id="iddisplay"  disabled style="padding-bottom: 5px;">
    <input type="text" name="examid" value="<?php echo $_SESSION['examid']?>"   hidden style="padding-bottom: 5px;">    
    <div class=" row">
            <div class="col-10 compartment">
                <div class="row">
                    <div class="col">
                        <textarea required class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Question Text" name="text"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <span>A.</span>
                        <input type="text" required name="optA" id="optA" class="form-control" placeholder="Option A" >
                    </div>
                    <div class="col-6">
                        <span>B.</span>
                        <input type="text" required name="optB" id="optB" class="form-control" placeholder="Option B" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <span>C.</span>
                        <input type="text" required name="optC" id="optC" class="form-control" placeholder="Option C" >
                    </div>
                    <div class="col-6">
                        <span>D.</span>
                        <input type="text" required name="optD" id="optD" class="form-control" placeholder="Option D" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <span>Correct Answer:</span>
                        <select name="optcorrect" id="optcorrect" class="form-control">
                            <option value="A" selected>Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <span>Marks Allocated:</span>
                        <input type="number" required name="mark" id="mark" class="form-control" placeholder="marks" value='1'>
                    </div>
                    <div class='col-3'>
                        <span>Time Allocated In Sec:</span>
                        <input type="number" required name="time" id="time" class="form-control" value='30'>
                    </div>
                </div>

            </div>
            <div class="col-2 compartment cell align-self-center" style="padding:5rem 0 5rem 0;">
            <div class="row ">
                <div class="col-12 qbtn">
                    <button type="submit" class="btn btn-success" >Next</button>
                </div>
            </div>
            <div class="row  ">
                <div class="col-12 qbtn">
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</form>
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