<?php
session_start();
include 'connection.php';
$id=$_SESSION['fileid']//id of the music file
$query = mysqli_query($conn,"SELECT content FROM uploads WHERE id='$id'");
$row = mysqli_fetch_assoc($query);
header("Content-type: audio/mid");
header("Content-transfer-encoding:binary");
header("Accept-Ranges:bytes");
echo '<audio controls>';
  echo    '<source src="data:audio/mid;base64,'.base64_encode($row['sound']).'">';
echo '</audio>';
?>