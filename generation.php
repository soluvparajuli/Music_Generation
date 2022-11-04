<?php
    session_start();
    $timestamp= $_POST['timestamp'];
    $bps=$_POST['bps'];
    $similarity=$_POST['similarity'];
     $command = escapeshellcmd('python test.py '.$timestamp.' '.$bps.' '.$similarity);
     $output = shell_exec($command);
     $_SESSION['generatedfilepath']=stripslashes($output);
     echo json_encode(array(array(
        'success' => '1',
        'message' =>"Generation compleated")));
?>