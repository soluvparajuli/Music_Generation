<?php
session_start();
include 'connection.php';
if(isset($_POST['examid']) && $_POST['examid']) 
{
    $id=htmlentities($_POST['examid']);
    $stmt= $conn->prepare("INSERT INTO scheduleexam VALUES(?,?,'no')");
    $stmt->bind_param('ss',$id,$_SESSION['userid']);
    if($stmt->execute()){

            echo json_encode(array(
                'success' => 1,
                'message' => 'Successfully Added'
            ));

       
    }
    else{
        echo json_encode(array(
            'success' => 0,
            'message' => 'This exam couldnot be scheduled.Check to see if it is already scheduled.'
        ));
    }
    $stmt->close();

}
else
{
    echo json_encode(array(
        'success' => 0,
        'message' => 'Error.'
    ));
}
?>