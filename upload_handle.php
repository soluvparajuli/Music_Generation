<?php
session_start();
include 'connection.php';
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
$uid=$_SESSION['userid'];
fclose($fp);
$stmt = $conn->prepare("INSERT INTO uploads VALUES('',?,?,?,?,?,current_timestamp())");
$stmt->bind_param('sssbi',$fileName,$fileType,$fileSize,$content,$uid);
if($stmt->execute()){
    echo ('<script type="text/JavaScript"> 
    alert("Successfully uploaded");
    location.href="admin_panel.php";
    </script>');
}
else{
    echo ('<script type="text/JavaScript"> 
    alert(" upload failed");
    location.href="admin_panel.php";
    </script>');
}
}
else{
    echo ('<script type="text/JavaScript"> 
    alert(" No file selected");
    location.href="admin_panel.php";
    </script>');
}
?>