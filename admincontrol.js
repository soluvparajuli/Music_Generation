
var logoutbtn=document.querySelector('#logoutbtn');
logoutbtn.addEventListener("click",function(){
    logout();
})

//uploading
// $("#upload").submit(function(e){

//     e.preventDefault();
//     // get all the inputs into an array.
//     var $inputs = $('#upload :input');
//     // get an associative array of just the values.
//     var values = {};
//     $inputs.each(function() {
//         values[this.name] = $(this).val();
//         $(this).val('');
//     });
    
//         $.ajax({
//             type: "POST",
//             url: 'upload_handle.php',
//             data: {
//                 file:file
//             },
//             success: function(response)
//             {
//                 var jsonData = JSON.parse(response);
//                 if (jsonData.success == "1")
//                 {
//                     alert("Successfully uploaded.")
//                     location.href="scheduledExams.php";
//                 }
//                 else
//                 {
//                     alert(jsonData.message);
//                 }
//              }
//         })
    
// })
 
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


//see upload and manipulate uploads

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
       url: 'myuploads_page_handle.php',
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
                        `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-4 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.type}</div>            <div class="col-1 cell"><button class="btn btn-outline-success viewbtn"  value='${element.title}'><i class="far fa-eye"></i></button></div>     <div class="col-1 cell"><button class="btn btn-outline-primary addbtn"  value='${element.id}'><i class="far fa-plus-square"></i></button></div>                 <div class="col-1 cell"><button class="btn btn-outline-danger deletebtn"  value='${element.id}'><i class="far fa-trash-alt"></i></button></div>    </div>`    
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
//view music
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
               location.href="preview.php"
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
                   location.href="viewuploads.php";
               }
               else
               {
                   alert("Error!")
               }
            }
       })
   }
   
})
