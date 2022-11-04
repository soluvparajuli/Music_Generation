//displaying scheduled exams
$('#scheduledtable').ready(function(){
    $.ajax({
        type: "POST",
        data:{
            from:"student"
        },
        url: 'student_handle.php',
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            var message=jsonData.shift();
            if (message.success == "1")
            {
                var table =$("#scheduledtable");
                table.html("");
                var count=0;
                while(count<jsonData.length) {
                    var element=jsonData[count];
                    table.append(
                         `<div class="row " >            <div class="col-2 cell" id="examid">${element.id}</div>            <div class="col-5 cell" id="examtitle">${element.title}</div>            <div class="col-2 cell" id="examdate">${element.date}</div>            <div class="col-1 cell" id="examtime">${element.time}</div>    <div class="col-1 cell" id="examtime">${element.facedetection}</div>                     <div class="col-1 cell"><button class="btn btn-outline-primary takebtn"  value='${element.id}'><i class="fas fa-desktop"></i><i class="fas fa-arrow-circle-right"></i></button></div>    </div>`    
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

//Take Exam:
$('#scheduledtable').on('click','.takebtn',function(){
    if(confirm("START THE EXAM?=>>")){
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
                    location.href="examPage.php"
                }
                else
                {
                    alert("Error!")
                }
            }
        })
    }
})

