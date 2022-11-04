<?php
session_start();
include 'connection.php';
if(isset($_POST['examid']) && $_POST['examid'] && isset($_POST['text']) && $_POST['text'] && isset($_POST['optA']) && isset($_POST['optB'])  && isset($_POST['optC']) &&isset($_POST['optD']) &&isset($_POST['mark'])&& $_POST['mark'] &&isset($_POST['time'])&& $_POST['time'] )
{
    $id=$_POST['examid'];
    $text=$_POST['text'];
    $A=$_POST['optA'];
    $B=$_POST['optB'];
    $C=$_POST['optC'];
    $D=$_POST['optD'];
    $correctopt=$_POST['optcorrect'];
    $time=$_POST['time'];
    $mark=$_POST['mark'];
    $stmt= $conn->prepare("INSERT INTO questiondata VALUES(?,'',?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssss',$id,$text,$A,$B,$C,$D,$correctopt,$mark,$time);
    if($stmt->execute())
    {
        $stmt->close();
        header("location:addQuestions.php");
    }
    else
    {
        header("location:addQuestions.php");
    }

}
else{
    
}
?>