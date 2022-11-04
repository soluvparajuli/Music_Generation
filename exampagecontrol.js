
var alerts=document.querySelectorAll("#warn");
for(i=0;i<alerts.length;i++){
    alerts[i].addEventListener('click',function(){
        this.remove();
    })
}

//page restriction
var times;
var leave=document.querySelector("#leavemsg");
leave.addEventListener('click',function(){
    this.textContent="Please Resume.";
     times=setTimeout(() => {
        this.classList.add("notshown");
    },2000);
})


var restricted=document.querySelector("#restricted");
var timeout;
restricted.addEventListener("mouseleave",function(){
    var leave=document.querySelector("#leavemsg");
    leave.textContent="Warning!! Please return to the page within 5 sec and click this Dialogue.Otherwise you will be Disqualified";
    leave.classList.remove("notshown");
    timeout=setTimeout(() => {
        var leave=document.querySelector("#leavemsg");
        if(leave.textContent==="Please Resume."){
            clearTimeout(timeout);
        }
        else{
            alert("You are Disqualified.");
            //auto logout
            location.href="student_panel.php";
        }
    },5000);
})


// //face detection
////incomplete =>>>>
// let video = document.getElementById('videoInput');
// let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
// let dst = new cv.Mat(video.height, video.width, cv.CV_8UC4);
// let gray = new cv.Mat();
// let cap = new cv.VideoCapture(video);
// let faces = new cv.RectVector();
// let classifier = new cv.CascadeClassifier();

// // load pre-trained classifiers
// classifier.load('lib\haarcascade_frontalface_default.xml');

// const FPS = 30;
// function processVideo() {
//     try {
//         if (!streaming) {
//             // clean and stop.
//             src.delete();
//             dst.delete();
//             gray.delete();
//             faces.delete();
//             classifier.delete();
//             return;
//         }
//         let begin = Date.now();
//         // start processing.
//         cap.read(src);
//         src.copyTo(dst);
//         cv.cvtColor(dst, gray, cv.COLOR_RGBA2GRAY, 0);
//         // detect faces.
//         classifier.detectMultiScale(gray, faces, 1.1, 3, 0);
//         // draw faces.
//         for (let i = 0; i < faces.size(); ++i) {
//             let face = faces.get(i);
//             let point1 = new cv.Point(face.x, face.y);
//             let point2 = new cv.Point(face.x + face.width, face.y + face.height);
//             cv.rectangle(dst, point1, point2, [255, 0, 0, 255]);
//         }
//         cv.imshow('canvasOutput', dst);
//         // schedule the next one.
//         let delay = 1000/FPS - (Date.now() - begin);
//         setTimeout(processVideo, delay);
//     } catch (err) {
//         utils.printError(err);
//     }
// };

// // schedule the first one.
// setTimeout(processVideo, 0);
var logoutbtn=document.querySelector('#logoutbtn');
logoutbtn.addEventListener("click",function(){
    logout();
})
//logging out
function logout(){
    if(confirm("Are you sure?")){
         $.ajax({
             type: "POST",
             url: 'logout.php',
             data:{
             },
             success: function(response)
             {
                 var jsonData = JSON.parse(response);
                 if (jsonData.success == "1")
                 {
                     location.href=jsonData.link;
                     
                 }
                 else
                 {
                     alert("Failed to log out");
                 }
             }
         })
     }
}
//begin exam
var questions=new Array();
var count=0;
$("#beginbtn").on('click',function(){
    count1=1;
    count2=1;
    $.ajax({
        type: "POST",
        url: 'fetchexam.php',
        data:{
            from:"exampage"
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            var message=jsonData.shift();
            if (message.success == "1")
            {

               shuffle(jsonData);
               var first=jsonData.shift();
               $("#beginbtn").remove();
               $("#leavemsg").textContent="Please Resume.";
               $("#answerpanel").removeClass("notshown");
               putintheform(first);
               jsonData.forEach(element => {
                   questions.push(element);
               });
               if(questions.length==0){
                $("#nextbtn").remove();
                }
            }
            else
            {
                alert("Error fetching Data.")
                location.href=message.link;
            }
        }
    })
})

//Putting questions onto the form
function putintheform(question){
    count=count+1;
    var qid=$("#qid");
    var qno=$("#qno");
    var textfield=$("#qtext");
    var opA=$("#optA");
    var opB=$("#optB");
    var opC=$("#optC");
    var opD=$("#optD");
    var correct=$("#correctopt");
    var mark=$("#mark");
    var time=$("#time");
    qid.val(question['id']);
    textfield.val(question['text']);
    qno.text(`Q.N.${count}`);
    opA.val(question['A']);
    opB.val(question['B']);
    opC.val(question['C']);
    opD.val(question['D']);
    correct.val(question['correctopt']);
    mark.val(question['mark']);
    time.val(question['time']);

}
//shuffle array
function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
}

//next btn click
$("#nextbtn").on('click',function(){
    
    var examid=$("#examiddisplay").val();
    var qid=$("#qid").val();
    var qno=$("#qno").text();
    var correct=$("#correctopt").val();
    var answer=$("#answer").val();
    var mark=$("#mark").val();
    answersubmit(examid,qid,qno,correct,answer,mark,"nextbtn");
   
})

//submit btn click
$("#submitbtn").on('click',function(){
    var examid=$("#examiddisplay").val();
    var qid=$("#qid").val();
    var qno=$("#qno").text();
    var correct=$("#correctopt").val();
    var answer=$("#answer").val();
    var mark=$("#mark").val();
    answersubmit(examid,qid,qno,correct,answer,mark,"submitbtn");
})

//saving students answer to database
function answersubmit(examid,qid,qno,correct,answer,marks,whichbtn){
    $.ajax({
        type: "POST",
        url: 'answer_handle.php',
        data: {
            eid:examid,
            questid:qid,
            number:qno,
            corr:correct,
            ans:answer,
            mark:marks,
            from:whichbtn
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1" && jsonData.finish=="0")
            {
                if(questions.length==1){
                    $("#nextbtn").remove();
                }
                var question=questions.shift();
                putintheform(question);
            }
            else if(jsonData.success == "1" && jsonData.finish=="1")
            {
                alert("Congratulations.Exam was submitted successfully.")
                 location.href="student_panel.php";
            }
            else{
                alert("Something went wrong try again!");
            }
         }
    })
}


//countdown for each question:


var countdown=setInterval(function(){
    var time=$("#time");
    if(time){
        var seconds=time.val();
        if(seconds>0){
            time.val(seconds-1);
        }
        else{
            if($("#nextbtn")){
                $("#nextbtn").trigger('click');
            }
            
        }
    }
    
},1000);






   