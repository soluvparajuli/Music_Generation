<?php
session_start();

if(isset($_SESSION['Logged'])){
  if($_SESSION['usertype']=="Student"){
    echo json_encode(array(
        "success" => "1",
        "link" => "student_panel.php"
    ));
  }
  elseif($_SESSION['usertype']=="Teacher"){
    echo json_encode(array(
        "success" => "1",
        "link" => "teacher_panel.php"
    ));
  }
  elseif($_SESSION['usertype']=="Admin"){
    echo json_encode(array(
        "success" => "1",
        "link" => "admin_panel.php"
    ));
  }
  else{
    echo json_encode(array(
        "success" => "0",
        "link" => "index.php"
    ));
  }
}
else{
    echo json_encode(array(
        "success" => "0",
        "link" => "index.php"
    ));
}
?>
