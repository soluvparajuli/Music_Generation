<?php
session_start();
session_destroy();
echo json_encode(array(
    "success" => "1",
    "link" => "index.php"
));
?>