  //displaying attended exams
  $('#attendedtable').ready(function(){
    $.ajax({
        type: "POST",
        data:{
            from:"attendedstudent"
        },
        url: 'student_handle.php',
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            var message=jsonData.shift();
            if (message.success == "1")
            {
                var table =$("#attendedtable");
                table.html("");
                var count=0;
                while(count<jsonData.length) {
                    var element=jsonData[count];
                    table.append(
                         `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-5 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.time}</div>     <div class="col-1 cell"><button class="btn btn-outline-success viewbtn"  value='${element.id}'><i class="far fa-eye"></i></button></div>               <div class="col-1 cell"><button class="btn btn-outline-danger deletebtn"  value='${element.id}'><i class="fas fa-trash-alt"></i></button></div>    </div>`    
                        );              
                count++;
                };
        
            }
            else
            {
                // alert(message.message)
            }
         }
    })
})


//view result
$('#attendedtable').on('click','.viewbtn',function(){
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
                location.href="viewresultstudent.php"
            }
            else
            {
                alert("Error!")
            }
         }
    })
})


//delete an exam
$('#attendedtable').on('click','.deletebtn',function(){
    if(confirm("Are you sure you want to delete this Exam."))
    {
        $.ajax({
            type: "POST",
            url: 'deleteexam_bystudent_handle.php',
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
                    location.href="viewExamsStudent.php";
                }
                else
                {
                    alert("Error!cannot delete the exam.")
                }
             }
        })
    }
    
})
