var stopwatchs=document.querySelectorAll("#stopwatch");
var takeexambtns=document.querySelectorAll("#takeexambtn");
for(var i=0;i<stopwatchs.length;i++){
    stopwatchs[i].addEventListener("click",function(){
       var timespan=document.querySelector("#time");
        timespan.innerHTML="2d 3h 40s";
    })
}
for(var i=0;i<stopwatchs.length;i++){
    stopwatchs[i].addEventListener("mouseout",function(){
       var timespan=document.querySelector("#time");
        timespan.innerHTML="Time";
    })
}

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

//scheduling an exam
$("#schedule").submit(function(e){

    e.preventDefault();
    // get all the inputs into an array.
    var $inputs = $('#schedule :input');
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
        $(this).val('');
    });
    var id=values['examid'];
    if(id.length<=6 || id.length>=20 ){
        alert("Id length does not match.");
    }
    else{
        $.ajax({
            type: "POST",
            url: 'schedule_handle.php',
            data: {
                examid:id
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1")
                {
                    alert("Successfully Scheduled.")
                    location.href="scheduledExams.php";
                }
                else
                {
                    alert(jsonData.message);
                }
             }
        })
    }
})
// //displaying scheduled exams
// $('#scheduledtable').ready(function(){
//     $.ajax({
//         type: "POST",
//         data:{
//             from:"student"
//         },
//         url: 'student_handle.php',
//         success: function(response)
//         {
//             var jsonData = JSON.parse(response);
//             var message=jsonData.shift();
//             if (message.success == "1")
//             {
//                 var table =$("#scheduledtable");
//                 table.html("");
//                 var count=0;
//                 while(count<jsonData.length) {
//                     var element=jsonData[count];
//                     table.append(
//                          `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-5 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.time}</div>    <div class="col-1 cell" id="examtime">${element.facedetection}</div>                     <div class="col-1 cell"><button class="btn btn-outline-primary deletebtn"  value='${element.id}'><i class="fas fa-desktop"></i><i class="fas fa-arrow-circle-right"></i></button></div>    </div>`    
//                         );              
//                 count++;
//                 };
        
//             }
//             else
//             {
//                 alert(message.message)
//             }
//          }
//     })
// })
// //displaying attended exams
// $('#attendedtable').ready(function(){
//     $.ajax({
//         type: "POST",
//         data:{
//             from:"attendedstudent"
//         },
//         url: 'student_handle.php',
//         success: function(response)
//         {
//             var jsonData = JSON.parse(response);
//             var message=jsonData.shift();
//             if (message.success == "1")
//             {
//                 var table =$("#attendedtable");
//                 table.html("");
//                 var count=0;
//                 while(count<jsonData.length) {
//                     var element=jsonData[count];
//                     table.append(
//                          `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-5 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.time}</div>    <div class="col-1 cell" id="examtime">${element.facedetection}</div>                     <div class="col-1 cell"><button class="btn btn-outline-primary deletebtn"  value='${element.id}'><i class="fas fa-desktop"></i><i class="fas fa-arrow-circle-right"></i></button></div>    </div>`    
//                         );              
//                 count++;
//                 };
        
//             }
//             else
//             {
//                 alert(message.message)
//             }
//          }
//     })
// })
























