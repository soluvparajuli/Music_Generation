
 
    var teacherbtn=document.querySelector("#teacherbtn");
    var adminbtn=document.querySelector("#adminbtn");
    var teacherform=document.querySelector("#teacherform");
    var adminform=document.querySelector("#adminform");
    var autologin=document.querySelector("#loginbtn");
    var titleshowcase=document.querySelector("#titleshowcase");

    autologin.addEventListener('click',function(){
        autologinfunc();
    })

    teacherbtn.addEventListener('click',function(){
        teacherform.classList.remove("notshown");
        titleshowcase.classList.add("notshown");
        adminform.classList.add("notshown");
    })
    adminbtn.addEventListener('click',function(){
        adminform.classList.remove("notshown");
        titleshowcase.classList.add("notshown");
        teacherform.classList.add("notshown");
    })


//procedure to login
    $(document).ready(function() {
 
         $('#addteacherform').submit(function(e) {
            e.preventDefault();
            // get all the inputs into an array.
            var $inputs = $('#addteacherform :input');
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });
    
            signupcontrol(values['name'],values['email'],values['pass'],"teacherform");
    
         });
         $('#adminloginform').submit(function(e) {
            e.preventDefault();
            // get all the inputs into an array.
            var $inputs = $('#adminloginform :input');
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });
    
            logincontrol(values['email'],values['pass'],"adminform");
    
         });
    });
    
    function logincontrol(mail,password,whichform){
      
        $.ajax({
            type: "POST",
            url: 'login_handle.php',
            data: {
                typeofform:whichform,
                email:mail,
                pass:password
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success === "1")
                {
                    location.href= jsonData.link;
                }
                else
                {
                    alert('Invalid Credentials!');
                }
             }
        })
                 
    }
    function autologinfunc(){
        $.ajax({
            type: "POST",
            url: 'auto_login_handle.php',
            data: {
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success === "1")
                {
                    location.href= jsonData.link;
                }
                else
                {
                    alert('Session Expired.');
                }
             }
        })
    }
    function signupcontrol(name,mail,password,whichform){
        name = name.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
        $.ajax({
            type: "POST",
            url: 'admin_handle.php',
            data: {
                username:name,
                typeofform:whichform,
                email:mail,
                pass:password
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);
    
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    alert(`${name} Successfully Added.`);
                    location.href= "index.php";
                    console.log(jsonData.message);
                }
                else
                {
                    alert(jsonData.message);
                    console.log(jsonData.message);
                }
             }
        })
    
    
    
    
    
    }