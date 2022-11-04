<?php

$file_pointer = 'temp/song.mid';
$conten=file_get_contents($file_pointer);

session_start();
include 'connection.php';
$fileName = $_POST['filename'];
$content = addslashes($conten);
$uid=$_SESSION['userid'];
$stmt = $conn->prepare("INSERT INTO playlists VALUES('',?,'audio/mid',' ',?,?,current_timestamp())");
$stmt->bind_param('sbi',$fileName,$content,$uid);
if($stmt->execute()){
    unlink($file_pointer);
    echo ('<script type="text/JavaScript"> 
    alert("Successfully saved");
    location.href="viewplaylist.php";
    </script>');
}
else{
    echo ('<script type="text/JavaScript"> 
    alert(" upload failed");
    location.href="admin_panel.php";
    </script>');
}

?>
?>