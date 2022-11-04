<?php
session_start();
include "connection.php";
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Student" && isset($_SESSION['examid']) && $_SESSION['examid'])
{
    $facedetection=0;
    $stmt= $conn->prepare("SELECT facedetection FROM examdata WHERE examid=?");
    $stmt->bind_param('s',$_SESSION['examid']);

    if($stmt->execute()){
        $stmt->bind_result($face);
        $stmt->store_result();
        while($stmt->fetch()){
            $facedetection=$face;
        }
    }
    else{
        $stmt->close();
        header("location:scheduledExams.php");
    }
    

?>
<!DOCTYPE html>
<html lang="en" id="restricted">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_exampage.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
    <title>Exam</title>
</head>
<body >
    <div id="foo"></div>
	<div >
        <div class="container-fluid">
            <button type="button" class="btn btn-danger loginbtn" id="logoutbtn">Log Out  <i class="fas fa-sign-in-alt"></i></button>
                <img src="images/tulogo.png" alt="" class="tulogo" style="width:12%">
                 <h3 style="display:inline;color: white;">Exam Panel</h3>
                         <!-- The text field -->
            <span style="color: white;">Exam ID:</span>
            <input type="text" id="examiddisplay" value="<?php echo $_SESSION['examid']?>"  disabled style="padding-bottom: 5px;">	
            <button class="btn btn-warning " id="beginbtn">Begin</button>
            </div>
            <div class="container">
                <div class="alert alert-danger" role="alert" id="warn">
                   [x] Please donot close this tab while Filling Questions.Your progress will be lost and instead a void exam will be Submitted.
                  </div>
                  <div class="alert alert-warning" role="alert" id="warn">
                    [x] Please remain within the frame of webcam.Failure to detect face on several occasions may result in disqualification from exam. .
                  </div>
                  <div class="alert alert-danger notshown" role="alert" id="leavemsg">
                  </div>
            </div>
            <div class="container-fluid quest notshown" id="answerpanel">
            <div class=" row" >
                    <div class="col-8 compartment">
                        <input type="text" id="qid" hidden >
                        <input type="text" id="correctopt" hidden >
                        <div class="row">
                            <div class="col">
                                <span id="qno"></span>
                                <textarea disabled class="form-control" id="qtext" rows="3" placeholder="Question Text"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span>A.</span>
                                <input disabled type="text" name="optA" id="optA" class="form-control" placeholder="Option A" >
                            </div>
                            <div class="col-6">
                                <span>B.</span>
                                <input disabled type="text" name="optB" id="optB" class="form-control" placeholder="Option B" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span>C.</span>
                                <input disabled type="text" name="optC" id="optC" class="form-control" placeholder="Option C" >
                            </div>
                            <div class="col-6">
                                <span>D.</span>
                                <input disabled type="text" name="optD" id="optD" class="form-control" placeholder="Option D" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span>Your Answer:</span>
                                <select name="optCorrect" id="answer" class="form-control">
                                    <option value="Skip" selected>skip</option>
                                    <option value="A">Option A</option>
                                    <option value="B">Option B</option>
                                    <option value="C">Option C</option>
                                    <option value="D">Option D</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <span>Marks Allocated:</span>
                                <input disabled type="number" name="marks" id="mark" class="form-control" placeholder="marks" value='1'>
                            </div>
                            <div class='col-3'>
                                <span>Time remaining In Sec:</span>
                                <input  disabled type="number" name="time" id="time" class="form-control" value='86400'>
                            </div>
                        </div>
                        <div class="row cell compartment" style="margin-top: 3rem;">
                            <div class="col-6 ">
                                <div >
                                <button type="submit" class="btn btn-success" id="nextbtn" value="1">Next</button>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div>
                                <button type="submit" class="btn btn-info" id="submitbtn" value="1">Submit Exam</button>
                                </div>
                            </div>
                        </div>
        
                    </div>
                    <div class="col-4 compartment cell"   style="padding:5rem 0 5rem 0 ;">
                                <?php if($facedetection==1) { ?>

                                    <video id='cam_input' height='480' width='640' class="notshown" ></video>
                                    <canvas id='canvas_output'></canvas>
                                <?php } 
                                else{
                                    ?>
                                    <p style="color:white;text-align:center;"><strong>Face detection is turned off for this exam.</strong></p>
                                    <?php
                                }
                                ?>
                    </div>
            </div>
            </div>
    </div>
<script typt="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="exampagecontrol.js"></script>
<?php if($facedetection==1) { ?>

    <!-- activate face detection  -->
     <script type="text/javascript" src="facecontrol.js"></script>
    <script async src='opencv.js' onload='openCvReady();'></script>
    <script src='utils.js'></script> 
<?php } ?>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>