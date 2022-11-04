<?php
session_start();
include 'connection.php';
if(isset($_POST['examid']) && $_POST['examid'] && isset($_POST['examtitle']) && $_POST['examtitle'] && isset($_POST['number']) && $_POST['number'] && isset($_POST['examtime']) && $_POST['examtime'] && isset($_POST['examdate']) && $_POST['examdate'] &&isset($_POST['facedetection']) && $_POST['facedetection']!='')
{
    $id=$_POST['examid'];
    $title=$_POST['examtitle'];
    $num=$_POST['number'];
    $time=$_POST['examtime'];
    $date=$_POST['examdate'];
    $face=$_POST['facedetection'];
    $stmt= $conn->prepare("INSERT INTO examdata VALUES(?,?,?,?,?,?,'','0')");
    $stmt->bind_param('ssssss',$id,$title,$time,$date,$face,$num);
    if($stmt->execute()){
        $stmt2= $conn->prepare("INSERT INTO createexam VALUES(?,?,current_timestamp())");
        $stmt2->bind_param('ss',$id,$_SESSION['userid']);
        if($stmt2->execute()){
            echo json_encode(array(
                'success' => 1,
                'link' => 'viewExamsTeacher.php'
            ));
        }
       else{
         echo json_encode(array(
            'success' => 0,
            'link' => 'index.php'
        ));
       }
        $stmt2->close();

    }
    else{
        echo json_encode(array(
            'success' => 0,
            'link' => 'panel.php'
        ));
    }
    $stmt->close();

}
else{
    echo json_encode(array(
        'success' => 0,
        'link' => 'her_panel.php'
    ));
}
?>