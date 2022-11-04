<?php
session_start();
include 'connection.php';
$filepath=$_SESSION['fileid'];
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
          <!-- Image loader -->
          <div id='loader' style='display: none;'>
                    <h3>Generating Music...</h3>
                    <img src='assests/reload.gif' width='100vw' height='100vh'>
                    </div>
                <!-- Image loader -->
        <div class="music-player" >
           
            <div class="info">
              
                <h1>Music</h1>
                <h3>Pause at where you would like to generate</h3>
                
                <div id="waveform" style="background-color:black"></div>
                <div class="control-bar">
                    <img src="./assests/play.png" alt="play" id="playBtn" title="Play / Pause">
                    <img src="./assests/stop.png" alt="stop" id="stopBtn" title="Stop">
                    <img src="./assests/volume.png" alt="volume" id="volumeBtn" title="Mute / Unmute">
                    <img src="./assests/R.png" alt="volume" id="generateBtn" title="Generate">
                    <form id='myform'>
                            <label for="similarity">Similarity (between 1 and 5):</label>
                            <input type="range" id="similarity" name="similarity" min="1" max="5" value="1">
                            <br>
                            <label for="bps">bps (between 10 and 180):</label>
                            <input type="range" id="bps" name="bps" min="10" max="180" value="120">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
    <script>
        playBtn = document.getElementById("playBtn");
        stopBtn = document.getElementById("stopBtn");
        volumeBtn = document.getElementById("volumeBtn");
        generateBtn=document.getElementById("generateBtn");

        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#e3bbee',
            progressColor: '#fe38ab',
            barWidth: 3,
            responsive: true,
            hideScrollbar: true,
            barRadius: 3
        });
        wavesurfer.load('php/files/<?php echo$filepath?>');

        playBtn.onclick = function(){
            wavesurfer.playPause();
            if(playBtn.src.match("play")){
                playBtn.src  = "assests/pause.png";
            }
            else{
                playBtn.src = "assests/play.png"
            }
        }
        
        stopBtn.onclick = function(){
            wavesurfer.stop();
            playBtn.src = "assests/play.png"
        }
        
        volumeBtn.onclick = function(){
            wavesurfer.toggleMute();
            if(volumeBtn.src.match("volume")){
                volumeBtn.src  = "assests/mute.png";
            }
            else{
                volumeBtn.src = "assests/volume.png"
            }
        }
        generateBtn.onclick= function(){
            var stamp=wavesurfer.getCurrentTime();
            // get all the inputs into an array.
            var $inputs = $('#myform :input');
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
                $(this).val('');
            });
            generateMusic(values['similarity'],values['bps'],Math.floor(stamp));
    
           
        }
        function generateMusic(similarity,bps,timestamp){
            $.ajax({
                type: "POST",
                url: 'generation.php',
                data: {
                    timestamp:timestamp,
                    similarity:similarity,
                    bps:bps
                },
                success: function(response)
                {
                    $("#loader").hide();
                    var jsonData = JSON.parse(response);
                
                    location.href="postview.php"
                    
                }
            })
        }
        $(document).ajaxStart(function(){
        // Show image container
        $("#loader").show();
        $(".music-player").hide();
        });
    </script>
</body>
</html>