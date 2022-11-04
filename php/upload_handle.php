<?php
  $file_name =  $_FILES['file']['name'];
  $tmp_name = $_FILES['file']['tmp_name'];
  $file_up_name = $file_name;
 

?>
<!-- to database -->
<?php
session_start();
include 'connection.php';

$fileName = $_FILES['file']['name'];
$tmpName  = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];

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
    location.href="preview.php";
    </script>');
}
else{
    echo ('<script type="text/JavaScript"> 
    alert(" upload failed");
    location.href="admin_panel.php";
    </script>');
}
move_uploaded_file($tmp_name, "files/".$file_up_name);
?>