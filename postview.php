<?php
session_start();
include 'connection.php';
$filepath=$_SESSION['generatedfilepath'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gaurav_style.css">
    <title>Spectrum</title>
    <script src="https://unpkg.com/wavesurfer.js"></script>
</head>
<body>
    <div class="container">
        <div class="music-player" >
           
            <div class="info">
           

                            <section id="section3">
                            <h2>Generated Music</h2>
                            <midi-player
                            src="<?php echo $filepath;?>"
                            sound-font visualizer="#section3 midi-visualizer">
                            </midi-player>
                            <midi-visualizer
                            src="<?php echo $filepath;?>">
                            </midi-visualizer>
                            </section>
                            <form action="save.php" method="post">
                                <input type="hidden" name="filepath" value="<?php echo $filepath ?>">
                                <input type="text" name="filename" id="name" value="songuntitled">
                                <br>
                                <button  id="submitBtn" >Save</button>
                               
                            </form>
                            <form action="discard.php" method="post">
                                <input type="hidden" name="filepath" value="<?php echo $filepath ?>">
                                <button  id="discardBtn" >Discard</button>
                            </form>                           
                            
            </div>

        </div>
    </div>
    <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/combine/npm/tone@14.7.58,npm/@magenta/music@1.23.1/es6/core.js,npm/focus-visible@5,npm/html-midi-player@1.4.0"></script>


</body>
</html>