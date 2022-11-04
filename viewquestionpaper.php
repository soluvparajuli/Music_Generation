<?php
session_start();
include 'connection.php';
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Teacher" && isset($_SESSION["examid"]) )
{
  $questions=array();
  $eid=$_SESSION['examid'];
  $stmt= $conn->prepare("SELECT * FROM questiondata WHERE examid=?");
  $stmt->bind_param('s',$eid);
  if($stmt->execute())
  {
    $stmt->bind_result($examid,$id,$text,$A,$B,$C,$D,$correctopt,$mark,$time);
    $stmt->store_result();
    if ($stmt->num_rows != 0){
      while ($stmt->fetch()) //fetching the contents of the row
      {
            array_push($questions,array("id"=>$id,
                                      "text"=>$text,
                                      "A"=>$A,
                                      "B"=>$B,
                                      "C"=>$C,
                                      "D"=>$D,
                                      "correctopt"=>$correctopt,
                                      "mark"=>$mark,
                               "time"=>$time));
      }
      $stmt->close();
    }
    else{
      $stmt->close();
      header("location:viewExamsTeacher.php");
    }
  }
  else
  {
      header("location:viewExamsTeacher.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
	<title>Document</title>
</head>
<body>
    <div class="container">
      <a href="viewExamsTeacher.php">
      <button class="btn btn-primary">Back</button>
      </a>
      <a href="viewresultteacher.php">
      <button class="btn btn-success">View result</button>
      </a>
      <button type="button" class="btn btn-danger loginbtn" id="logoutbtn" >Log Out  <i class="fas fa-sign-in-alt"></i></button>
    </div>
    <div class="container " style="border:2px solid black;margin-top:20px; ">
      <div class="row">
        Exam id:<strong> <?php echo $_SESSION['examid']?></strong>
      </div>
      <br>
      <?php
      $count=0;
      foreach ($questions as $question) {?>
        <form action="deletequestion.php" method="post">
              <input type="text" hidden name="qid" value="<?php echo $question['id'];?>">
              <input type="text" hidden name="from" value="qpaper">
              <div class="container " style="color:black;">
                <hr>
                <div class="row">
                 Q.N. <?php echo ++$count ?>: <?php echo $question['text']?>
                </div>
                <div class="row">
                   <div class="col-6"> A:<?php echo $question['A'] ?></div>
                   <div class="col-6"> B:<?php echo $question['B'] ?></div>
                </div>
                <div class="row">
                    <div class="col-6">C:<?php echo $question['C'] ?></div>
                  <div class="col-6">  D:<?php echo $question['D'] ?></div>
                </div>
                <div class="row">
                    <div class="col-3">Correct Option:<?php echo $question['correctopt'] ?></div>
                    <div class="col-3"> Mark:<?php echo $question['mark'] ?></div>
                   <div class="col-3"> Time:<?php echo $question['time'] ?></div>
                    <div class="col-3">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                
              </div>
        </form>
      <?php
      }
      ?>
    </div>

  <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
  <script type="text/javascript"src="lib\bootstrap.min.js"></script>
	<script type="text/javascript" src="teachercontrol.js"></script>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>