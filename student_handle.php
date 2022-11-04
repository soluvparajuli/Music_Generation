<?php
session_start();
include 'connection.php';
if(isset($_POST['from']) && $_POST['from']=="student")
{
    
    $user=$_SESSION['userid'];
    $stmt = $conn->prepare("SELECT * FROM scheduleexam WHERE studentid=$user AND attended='no' ORDER BY examid DESC");
    if($stmt->execute())
    {
            $stmt->bind_result($eid,$sid,$status);
            $stmt->store_result();
            if ($stmt->num_rows != 0) //To check if the row exists
            { 
                $examids=array();
                $output=array(array('success'=>0,
                        'message'=>"No Result Found"));

                while($stmt->fetch()){
                    array_push($examids,$eid);
                   
                }
                $stmt->close();
                if(sizeof($examids)>0){
                    foreach ($examids as $examid) //fetching the contents of the row
                    {
                        $output[0]['success']=1;
                        $output[0]['message']="Result Found";
                        //getting examdetails
                        $stmt2=$conn->prepare("SELECT examid,examtitle,examtime,examdate,facedetection FROM examdata WHERE examid=?");
                        $stmt2->bind_param("s",$examid);
                        $stmt2->execute();
                        $stmt2->bind_result($id,$title,$time,$date,$face);
                        $stmt2->store_result();
                        
                        if($stmt2->num_rows!=0){
                            while($stmt2->fetch()){
                                if($face=="1"){$face="Yes";}else if($face=="0"){$face="No";}else{$face="unknown";}
                                array_push($output,array("id"=>$id,
                                "title"=>$title,
                               "time"=>$time,
                               "date"=>$date,
                               "facedetection"=>$face
                                ));
                            }
                           
                        }
                         
                    }
                    $stmt2->close();
                }
               
                echo json_encode($output);

            } 
            else
            {
            echo json_encode(array(array(
                'success' => 0,
                'message' =>"NO RESULT FOUND.")));
            }
        
    }
    else
    { 
    echo json_encode(array(array(
        'success' => 0,
        'message' =>"NO RESULT FOUND.")));
    }
}
elseif(isset($_POST['from']) && $_POST['from']=="attendedstudent")
{
    $user=$_SESSION['userid'];
    $stmt = $conn->prepare("SELECT * FROM scheduleexam WHERE studentid=$user AND attended='yes' ORDER BY examid DESC");
    if($stmt->execute())
    {
            $stmt->bind_result($eid,$sid,$status);
            $stmt->store_result();
            if ($stmt->num_rows != 0) //To check if the row exists
            { 
                $examids=array();
                $output=array(array('success'=>0,
                        'message'=>"No Result Found"));

                while($stmt->fetch()){
                    array_push($examids,$eid);
                   
                }
                $stmt->close();
                if(sizeof($examids)>0){
                    foreach ($examids as $examid) //fetching the contents of the row
                    {
                        $output[0]['success']=1;
                        $output[0]['message']="Result Found";
                        //getting examdetails
                        $stmt2=$conn->prepare("SELECT examid,examtitle,examtime,examdate,facedetection FROM examdata WHERE examid=?");
                        $stmt2->bind_param("s",$examid);
                        $stmt2->execute();
                        $stmt2->bind_result($id,$title,$time,$date,$face);
                        $stmt2->store_result();
                        
                        if($stmt2->num_rows!=0){
                            while($stmt2->fetch()){
                                if($face=="1"){$face="Yes";}else if($face=="0"){$face="No";}else{$face="unknown";}
                                array_push($output,array("id"=>$id,
                                "title"=>$title,
                               "time"=>$time,
                               "date"=>$date,
                               "facedetection"=>$face
                                ));
                            }
                           
                        }
                         
                    }
                    $stmt2->close();
                }
               
                echo json_encode($output);

            } 
            else
            {
            echo json_encode(array(array(
                'success' => 0,
                'message' =>"NO RESULT FOUND.")));
            }
        
    }
    else
    { 
    echo json_encode(array(array(
        'success' => 0,
        'message' =>"NO RESULT FOUND.")));
    }
}
else{
    echo json_encode(array(array(
        'success' => 0,
        'message' =>"NO RESULT FOUND.")));
}
?>