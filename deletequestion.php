<?php
session_start();
include 'connection.php';
if(isset($_POST['qid'])&& $_POST['qid'] && isset($_SESSION['examid']) && $_SESSION['examid'] && isset($_POST['from'])&& $_POST['from']=="qpaper")
{
    $qid=$_POST['qid'];
    $eid=$_SESSION['examid'];
    $stmt= $conn->prepare("DELETE FROM questiondata WHERE examid=? AND questionid=?");
    $stmt->bind_param('ss',$eid,$qid);
    if($stmt->execute())
    {
        $stmt->close();
        header("location:viewquestionpaper.php");
    }
    else
    {   
        $stmt->close();
        header("location:viewquestionpaper.php");
    }

}
else{
    
}
?>