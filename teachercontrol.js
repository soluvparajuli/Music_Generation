
var alerts=document.querySelectorAll(".alert");
for(i=0;i<alerts.length;i++){
    alerts[i].addEventListener('click',function(){
        this.remove();
    })
}
$('#switch').on('click',function(){
    if($(this).val()==0){
        $(this).val(1);
    }
    else{
        $(this).val(0);
    }
    // console.log($(this).val());
    
})
// var iddisplay=document.querySelector("#iddisplay");
// iddisplay.value=examIdGeneration();

function examIdGeneration(){
    return (Date.now()+Math.floor(Math.random() *(Math.random() * 10000)));
}
// function copytoclipboard() {
//     /* Get the text field */
//     var copyText = document.getElementById("iddisplay");
  
//     /* Copy the text inside the text field */
//     document.execCommand("copy");
  
//     /* Alert the copied text */
//     alert("Copied the ExamID: " + copyText.value);
//   }

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

//modifying existing exam
$('#modifyexamform').submit(function(e) {
    e.preventDefault();
    // get all the inputs into an array.
    var $inputs = $('#modifyexamform :input');
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
        $(this).val('');
    });
    if(values['noq']<=0){
        alert("Number of questions cannot be negative");
    }
    else{
        modifyexam(values['eid'],values['title'] ,values['noq'],values['time'],values['date'],values['face']);
    }

 });

 function modifyexam(eid,title,noq,time,date,face){
    
    $.ajax({
        type: "POST",
        url: 'modifyexam_handle.php',
        data: {
            examid:eid,
            examtitle:title,
            number:noq,
            examtime:time,
            examdate:date,
            facedetection:face
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1")
            {
                alert('Exam successfully modified.');
                location.href=jsonData.link;
            }
            else
            {
                alert("Something went wrong try again!");
            }
         }
    })
 }

//creating new exam
$('#createexamform').submit(function(e) {
    e.preventDefault();
    // get all the inputs into an array.
    var $inputs = $('#createexamform :input');
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
        $(this).val('');
    });
    if(values['noq']<=0){
        alert("Number of questions cannot be negative");
    }
    else{
        newexam(values['title'] ,values['noq'],values['time'],values['date'],values['face']);
    }

 });

 function newexam(title,noq,time,date,face){
    
    $.ajax({
        type: "POST",
        url: 'newexam_handle.php',
        data: {
            examid:examIdGeneration(),
            examtitle:title,
            number:noq,
            examtime:time,
            examdate:date,
            facedetection:face
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1")
            {
                alert('Exam successfully created.');
                location.href=jsonData.link;
            }
            else
            {
                alert("Something went wrong try again!");
            }
         }
    })
 }

// For todays date;
Date.prototype.today = function () { 
    return this.getFullYear()+"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1)+"-"+ ((this.getDate() < 10)?"0":"") + this.getDate() ;
   
}
// For the time now
Date.prototype.timeNow = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}
 //searching exams
 var btns = $('#drop .butt');
 btns.on('click',function(){


    var curr=new Date();
    curr=curr.getTime();
    if($(this).val()=="recent"){
        curr=curr-86400000;
        searchexams(curr);
    }
    else if($(this).val()=="week"){
        curr=curr-86400000*7;
        searchexams(curr);
    }
    else if($(this).val()=="month"){
        curr=curr-86400000*30;
        searchexams(curr);
    }
    else if($(this).val()=="all"){
        searchexams(1);
    }
    else{
        alert("No result found..")
    }
 })
//searching exams
function searchexams(diff){
    $.ajax({
        type: "POST",
        url: 'teacher_handle.php',
        data: {
            duration:diff
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            var message=jsonData.shift();
            if (message.success == "1")
            {
                var table =$("#table");
                table.html("");
                var count=0;
                while(count<jsonData.length) {
                    var element=jsonData[count];
                    table.append(
                         `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-3 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.time}</div>            <div class="col-1 cell"><button class="btn btn-outline-success viewbtn"  value='${element.id}'><i class="far fa-eye"></i></button></div>     <div class="col-1 cell"><button class="btn btn-outline-primary addbtn"  value='${element.id}'><i class="far fa-plus-square"></i></button></div>        <div class="col-1 cell"><button class="btn btn-outline-secondary modifybtn"  value='${element.id}'><i class="fas fa-exchange-alt"></i></button></div>            <div class="col-1 cell"><button class="btn btn-outline-danger deletebtn"  value='${element.id}'><i class="far fa-trash-alt"></i></button></div>    </div>`    
                        );              
                count++;
                };
        
            }
            else
            {
                alert(message.message)
            }
         }
    })
}

//performing view modify delete on exams
//add questions
$('#table').on('click','.addbtn',function(){
    $.ajax({
        type: "POST",
        url: 'setsession.php',
        data: {
            examid:$(this).val()
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1")
            {
                location.href="addQuestions.php"
            }
            else
            {
                alert("Error!")
            }
         }
    })
})
//view Question paper
$('#table').on('click','.viewbtn',function(){
    $.ajax({
        type: "POST",
        url: 'setsession.php',
        data: {
            examid:$(this).val()
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1")
            {
                location.href="viewquestionpaper.php"
            }
            else
            {
                alert("Error!")
            }
         }
    })
})
//modify exam details
$('#table').on('click','.modifybtn',function(){
    $.ajax({
        type: "POST",
        url: 'setsession.php',
        data: {
            examid:$(this).val()
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            if (jsonData.success == "1")
            {
                location.href="modifyexam.php";
            }
            else
            {
                alert("Error!")
            }
         }
    })
})
//delete an exam
$('#table').on('click','.deletebtn',function(){
    if(confirm("Are you sure you want to delete this Exam."))
    {
        $.ajax({
            type: "POST",
            url: 'deleteexam_byteacher_handle.php',
            data: {
                examid:$(this).val(),
                from:"delete"
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1")
                {
                    alert("Successfully Deleted.")
                    location.href="viewExamsTeacher.php";
                }
                else
                {
                    alert("Error!")
                }
             }
        })
    }
    
})






