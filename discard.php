<?php

$file_pointer = 'temp/song.mid';
   
// Use unlink() function to delete a file 
if (!unlink($file_pointer)) { 
    echo ("$file_pointer cannot be deleted due to an error"); 
} 
else { 
    echo ("$file_pointer has been deleted"); 
    header("Location: viewuploads.php");
} 
?>