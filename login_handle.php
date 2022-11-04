
<?php
session_start();
include 'connection.php';

if (isset($_POST['email']) && $_POST['email'] && isset($_POST['pass']) && $_POST['pass'] && isset($_POST['typeofform']) && $_POST['typeofform'])
  {
    $emailajax = $_POST['email'];
    $passajax  = $_POST['pass'];
    $typeajax  = $_POST['typeofform'];
   
    if ($typeajax == "adminform")
      {
        $stmt = $conn->prepare("SELECT id,name,passw FROM userdata WHERE email=?");
        $stmt->bind_param('s', $emailajax);
        $stmt->execute();
        $stmt->bind_result($id, $name, $password);
        $stmt->store_result();
        if ($stmt->num_rows == 1) //To check if the row exists
          {
            while ($stmt->fetch()) //fetching the contents of the row
              {
                // $_SESSION['Logged'] = 1;
                // $_SESSION['username'] = $username;
                if (password_verify($passajax, $password))
                  {
                    $_SESSION['Logged'] = 1;
                    $_SESSION['username']=$name;
                    $_SESSION['userid']=$id;
                    $_SESSION['usertype']="Admin";
                    $_SESSION['useremail']=$emailajax;
                    echo json_encode(array(
                        "success" => "1",
                        "link" => "admin_panel.php"
                    ));
                    exit();
                  }
                else
                  {
                    // $error = "Your Login Name or Password is invalid";
                    // echo $error;
                    echo json_encode(array(
                        "success" => 0,
                        "link" => "panel.html"
                    ));
                  }
              }
          }
        else
          {
            echo json_encode(array(
                "success" => 0
            ));
          }
        $stmt->close();
      }
    else
      {
        
        echo json_encode(array(
            "success" => 0
        ));
        
      }
    
  }
else
  {
    echo json_encode(array(
        "success" => 0
    ));
  }
?>