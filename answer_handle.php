<?php
session_start();
include 'connection.php';
if(isset($_POST['eid']) && $_POST['eid'] && isset($_POST['questid']) && $_POST['questid'] && isset($_POST['number']) && $_POST['number'] && isset($_POST['corr']) && $_POST['corr'] && isset($_POST['ans']) && $_POST['ans'] && isset($_POST['mark'])  && isset($_POST['from']) && $_POST['from'])
{
    $nextoutput=array("success"=>"1",
                        "finish"=>"0");
    $submitoutput=array("success"=>"1",
    "finish"=>"1");             
    $erroroutput=array("success"=>"0",
    "finish"=>"2");        
    $eid=$_POST['eid'];
    $qid=$_POST['questid'];
    $qno=$_POST['number'];
    $correct=$_POST['corr'];
    $answer=$_POST['ans'];
    $mark=$_POST['mark'];
    $from=$_POST['from'];
    if($answer==$correct){
        $status='right';
    }
    else{
        $status='wrong';
    }
    $stmt= $conn->prepare("INSERT INTO answerdata VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssss',$_SESSION['userid'],$eid,$qid,$qno,$correct,$answer,$mark,$status);
    if($stmt->execute()){

        if($from=="nextbtn"){
            echo json_encode($nextoutput);
        }
        elseif($from=="submitbtn"){
            echo json_encode($submitoutput);
        }
        else{
            echo json_encode($erroroutput);
        }
    }
    else{
        echo json_encode($erroroutput);
    }
    $stmt->close();
}
else{
  echo json_encode(array("success"=>"0",
  "finish"=>"2"));
}
?>