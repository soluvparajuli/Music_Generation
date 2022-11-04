<?php
session_start();
include 'connection.php';
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Student" && isset($_SESSION["examid"]) )
{
  $totalmarks=0;
  $questions=array();
  $eid=$_SESSION['examid'];
  $stmt= $conn->prepare("SELECT * FROM answerdata WHERE examid=? AND studentid=? ORDER BY qnumber ");
  $stmt->bind_param('ss',$eid,$_SESSION['userid']);
  if($stmt->execute())
  {
    $stmt->bind_result($studentid,$eid,$qid,$qno,$correct,$answer,$mark,$status);
    $stmt->store_result();
    if ($stmt->num_rows != 0){
      while ($stmt->fetch()) //fetching the contents of the row
      {
          if($status=="right"){
            $totalmarks=$totalmarks+$mark;
          }
          $stmt2= $conn->prepare("SELECT * FROM questiondata WHERE examid=? AND questionid=?");
          $stmt2->bind_param('ss',$eid,$qid);
          if($stmt2->execute()){
            $stmt2->bind_result($examid,$id,$text,$A,$B,$C,$D,$correctopt,$marking,$time);
            $stmt2->store_result();
            if ($stmt2->num_rows != 0){
              while ($stmt2->fetch()){
                array_push($questions,array("id"=>$id,
                                          "text"=>$text,
                                          "A"=>$A,
                                          "B"=>$B,
                                          "C"=>$C,
                                          "D"=>$D,
                                          "correctopt"=>$correctopt,
                                          "mark"=>$mark,
                                          "status"=>$status,
                                   "ans"=>$answer));
              }
            }
            else{
              $stmt2->close();
              header("location:viewExamsStudent.php");
            }
          }
          else{
            $stmt2->close();
            header("location:viewExamsStudent.php");
          }
            // array_push($questions,array("id"=>$id,
            //                           "text"=>$text,
            //                           "A"=>$A,
            //                           "B"=>$B,
            //                           "C"=>$C,
            //                           "D"=>$D,
            //                           "correctopt"=>$correctopt,
            //                           "mark"=>$mark,
            //                    "time"=>$time));
      }
      $stmt->close();
    }
    else{
      $stmt->close();
      header("location:viewExamsStudent.php");
    }
  }
  else
  {
      header("location:viewExamsStudent.php");
  }
  $stmt4=$conn->prepare("SELECT * FROM resultdata WHERE examid=? AND studentid=?");
  $stmt4->bind_param('ss',$eid,$_SESSION['userid']);
  if($stmt4->execute())
  {
    $stmt4->bind_result($x,$y,$z,$f);
    $stmt4->store_result();
    if ($stmt4->num_rows == 0){
      $stmt5= $conn->prepare("INSERT INTO resultdata VALUES(?,?,?,?)");
      $stmt5->bind_param('ssss',$eid,$_SESSION['userid'],$_SESSION['username'],$totalmarks);
      if(!$stmt5->execute()){
        $stmt5->close();
        header("location:viewExamsStudent.php");
      }
    $stmt5->close();

    }
  }
  $stmt4->close();
 
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
      <a href="viewExamsStudent.php">
      <button class="btn btn-primary">Back</button>
      </a>
      <button type="button" class="btn btn-danger loginbtn" id="logoutbtn" >Log Out  <i class="fas fa-sign-in-alt"></i></button>
    </div>
    <div class="container " style="border:2px solid black;margin-top:20px; ">
      <div class="row">
          <div class="col-6">
             Exam id:<strong> <?php echo $_SESSION['examid']?></strong>
          </div>
          <div class="col-6">
             Total Marks:<strong> <?php echo $totalmarks?></strong>
          </div>
      </div>
      <br>
      <?php
      $count=0;
      foreach ($questions as $question) {?>
        <form style="background-color:
        <?php   
          if($question['status']=="right"){
            echo("#a5f2b0");
          }
          elseif($question['status']=="wrong"){
            echo("#d9b2b2");
          }
          else{
            echo("#e8dfdf");
          }
        ?>
        ; border-radius:5px;padding-left:5px; margin-top:2px;" method="post">
              <input type="text" hidden name="qid" value="<?php echo $question['id'];?>">
              <input type="text" hidden name="from" value="qpaper">
              <div class="container " style="color:black;">
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
                   <div class="col-3"> Your Ans:<?php echo $question['ans'] ?></div>
                    <div class="col-3">
                    </div>
                </div>
                
              </div>
        </form>
      <?php
      }
      ?>
    </div>
      <br>
      <br>
      <br>
  <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
  <script type="text/javascript"src="lib\bootstrap.min.js"></script>
	<script type="text/javascript" src="studentcontrol.js"></script>
</body>
</html>
<?php
}
else{
  header("location:index.php");
}
?>