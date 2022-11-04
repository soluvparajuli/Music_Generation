
<?php

include 'connection.php';
//adding user
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['email']) && $_POST['email'] && isset($_POST['pass']) && $_POST['pass'] && isset($_POST['typeofform']) && $_POST['typeofform'])
  {
    
    $nameajax = $_POST['username'];
    $emailajax = $_POST['email'];
    $passajax  = $_POST['pass'];
    $passajax=password_hash($passajax,PASSWORD_DEFAULT);
    $typeajax  = $_POST['typeofform'];
    
    if ($typeajax == "teacherform")
      {
        $stmt = $conn->prepare("SELECT email FROM userdata WHERE email=?");
        $stmt->bind_param('s', $emailajax);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 0) //To check if the row exists
          {
            $stmt2 = $conn->prepare("INSERT INTO userdata VALUES('',?,?,?)");
            $stmt2->bind_param('sss',$nameajax,$emailajax,$passajax);
            if($stmt2->execute()){
                echo json_encode(array(
                    'success' => 1,
                    'message' =>"Successfully Added"
                ));
            }
            else{
                echo json_encode(array(
                    'success' => 0,
                    'message' =>"Something went wrong.Please try again."
                ));
            }
            $stmt2->close();
          }
        else
          {
            echo json_encode(array(
                'success' => 0,
                'message' =>"This Email is already taken."
            ));
          }
        $stmt->close();
         
      }

    else
      {
        
        echo json_encode(array(
            "success" => 0,
            "message" =>"Something went wrong.Please try again."
        ));
        
      }
    
  }

elseif(isset($_POST['name'])&& $_POST['name'] && isset($_POST['usertype'])&& $_POST['usertype'])
{
    $nameajax=$_POST['name'];
    $typeajax=$_POST['usertype'];
    //user search
    if($typeajax=="studentdata" )
    {
        $stmt = $conn->prepare("SELECT s_id, s_name, s_email FROM studentdata" );
        $stmt->execute();
        $stmt->bind_result($id,$databasename,$email);
        $stmt->store_result();
        if ($stmt->num_rows != 0) //To check if the row exists
        { 
            $output=array(array('success'=>0,
                    'tableid' =>'student',
                    'message'=>"No Result Found"));
            while ($stmt->fetch()) //fetching the contents of the row
            {
                $var=similar_text(strtolower($nameajax),strtolower($databasename), $percent);
                if(strtolower($nameajax)=="all"){$percent=100;}
                if($percent >= 50){
                  $output[0]['success']=1;
                  $output[0]['message']="Result Found";
                  $output[0]['tableid']=1;
                  array_push($output,array("id"=>$id,
                                            "name"=>$databasename,
                                            "email"=>$email));
                }
            }
            echo json_encode($output);

        } 
        else
        {
           echo json_encode(array(array(
              'success' => 0,
              'tableid' =>3,
              'message' =>"NO RESULT FOUND.")));
        }
        $stmt->close();
      }
        //teachersearch
    elseif($typeajax=="teacherdata")
    {
        $stmt = $conn->prepare("SELECT t_id, t_name, t_email FROM teacherdata" );
        $stmt->execute();
        $stmt->bind_result($id,$databasename,$email);
        $stmt->store_result();
        if ($stmt->num_rows != 0) //To check if the row exists
        { 
            $output=array(array('success'=>0,
                    'tableid' =>2,
                    'message'=>"No Result Found"));
            while ($stmt->fetch()) //fetching the contents of the row
            {
                $var=similar_text(strtolower($nameajax),strtolower($databasename), $percent);
                if(strtolower($nameajax)=="all"){$percent=100;}
                if($percent >= 50){
                  $output[0]['success']=1;
                  $output[0]['message']="Result Found";
                  $output[0]['tableid']=2;
                  array_push($output,array("id"=>$id,
                                            "name"=>$databasename,
                                            "email"=>$email));
                }
            }
            echo json_encode($output);

        }
        else
        {
           echo json_encode(array(array(
              'success' => 0,
              'tableid' =>2,
              'message' =>"NO RESULT FOUND.")));
        }
        $stmt->close();
    }
     //adminsearch
  elseif($typeajax=="admindata")
  {
        $stmt = $conn->prepare("SELECT id, name, email FROM admindata" );
        $stmt->execute();
        $stmt->bind_result($id,$databasename,$email);
        $stmt->store_result();
        if ($stmt->num_rows != 0) //To check if the row exists
        { 
            $output=array(array('success'=>0,
                    'tableid' =>3,
                    'message'=>"No Result Found"));
            while ($stmt->fetch()) //fetching the contents of the row
            {
                $var=similar_text(strtolower($nameajax),strtolower($databasename), $percent);
                if(strtolower($nameajax)=="all"){$percent=100;}
                if($percent >= 50){
                  $output[0]['success']=1;
                  $output[0]['message']="Result Found";
                  $output[0]['tableid']=3;
                  array_push($output,array("id"=>$id,
                                            "name"=>$databasename,
                                            "email"=>$email));
                }
            }
            echo json_encode($output);

        }
        else
        {
           echo json_encode(array(array(
              'success' => 0,
              'tableid' =>3,
              'message' =>"NO RESULT FOUND.")));
        }
        $stmt->close();
      }
      else
      {
          echo json_encode(array(array(
          "success" => 0,
          'tableid' =>0,
          "message" =>"Something went wrong.Please try again."
                )));
      }


}
elseif(isset($_POST['deleteid']) && $_POST['deleteid'] && isset($_POST['tablename']) && $_POST['tablename'])
{
    $idajax=$_POST['deleteid'];
    $typeajax=$_POST['tablename'];
    //delete from student
    if($typeajax==1){
      $stmt= $conn->prepare("DELETE FROM studentdata WHERE s_id=?");
      $stmt->bind_param('i',$idajax);
      if($stmt->execute()){
        echo json_encode(array(array(
          "success" => 1,
          'tableid' =>1,
          "message" =>"Successfully deleted from student"
                )));
      }
      else{
        echo $stmt->error;
        echo json_encode(array(array(
          "success" => 0,
          'tableid' =>0,
          "message" =>"Something went wrong.Please try again."
                )));
      }
      $stmt->close();
    }
    //delete from teacher
    elseif($typeajax==2){
      $stmt= $conn->prepare("DELETE FROM teacherdata WHERE t_id=?");
      $stmt->bind_param('i',$idajax);
      if($stmt->execute()){
        echo json_encode(array(array(
          "success" => 1,
          'tableid' =>2,
          "message" =>"Successfully deleted from teacher"
                )));
      }
      else{
        echo json_encode(array(array(
          "success" => 0,
          'tableid' =>0,
          "message" =>"Something went wrong.Please try again."
                )));
      }
      $stmt->close();
    }
    //delete from admin
    elseif($typeajax==3){
      $stmt= $conn->prepare("DELETE FROM admindata WHERE id=?");
      $stmt->bind_param('i',$idajax);
      if($stmt->execute()){
        echo json_encode(array(array(
          "success" => 1,
          'tableid' =>1,
          "message" =>"Successfully deleted from admin"
                )));
      }
      else{
        echo json_encode(array(array(
          "success" => 0,
          'tableid' =>0,
          "message" =>"Something went wrong.Please try again."
                )));
      }
      $stmt->close();
    }
    else{
      echo json_encode(array(array(
        "success" => 0,
        'tableid' =>0,
        "message" =>"Something went wrong.Please try again."
              )));
    }
}
else
  {
    echo json_encode(array(
        "success" => 0,
        "message" =>"Something went wrong.Please try again."

    ));
  }
?>