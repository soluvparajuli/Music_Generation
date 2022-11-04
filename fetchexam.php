 <?php
session_start();
include "connection.php";
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_POST['from']=="exampage" && $_SESSION["usertype"]=="Student" && isset($_SESSION['examid']) && $_SESSION['examid'])
{
  $output=array(array('success'=>0,
    'message'=>"No Result Found",
        'link'=>'scheduledExams.php'));
  $eid=$_SESSION['examid'];
  unset($_SESSION['examid']);
  //updating enroll exam table
  $stmt3= $conn->prepare("INSERT INTO enrollexam VALUES(?,?)");
  $stmt3->bind_param('ss',$eid,$_SESSION['userid']);
  $stmt3->execute();
  $stmt= $conn->prepare("SELECT * FROM questiondata WHERE examid=?");
  $stmt->bind_param('s',$eid);
  if($stmt->execute())
  {
    $stmt->bind_result($examid,$id,$text,$A,$B,$C,$D,$correctopt,$mark,$time);
    $stmt->store_result();
    if ($stmt->num_rows != 0){
        $stmt2= $conn->prepare("UPDATE scheduleexam SET attended='yes' WHERE examid=? AND studentid=?");
        $stmt2->bind_param('ss',$eid,$_SESSION['userid']);
        if($stmt2->execute()){
            while ($stmt->fetch()) //fetching the contents of the row
            {
                $output[0]['success']=1;
                $output[0]['message']="Result Found";
                    array_push($output,array("id"=>$id,
                                            "text"=>$text,
                                            "A"=>$A,
                                            "B"=>$B,
                                            "C"=>$C,
                                            "D"=>$D,
                                            "correctopt"=>$correctopt,
                                            "mark"=>$mark,
                                    "time"=>$time));
            }
            $stmt2->close(); 
            $stmt->close();
            echo json_encode($output);
        }
       else{
            $stmt2->close(); 
            $stmt->close();
            echo json_encode($output);
        
       }
    }
    else{
      $stmt->close();
      echo json_encode($output);
    
    }
  }
  else
  {   
      $stmt->close(); 
      echo json_encode($output);
  }

}
else{
    echo json_encode(array(array('success'=>0,
    'message'=>"No Result Found",
        'link'=>"scheduledExams.php")));
}