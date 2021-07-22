<?php
include_once 'dbConnection.php';

   // function addClass(){
        echo ' <div class="row">
        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Subject Details</b></span><br /><br />
        <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action=""  method="POST">
        <div class="col-md-10 col-md-offset-1" style="border:4px; border-raduis:4px solid #456455;">';
        if($_POST['register']){
            $name = $_POST['name'];
            $name= $con->real_escape_string($name);
            $class = $_POST['class'];
            $Q= "INSERT INTO courses VALUES (NULL, '$name','$class')";
            $q3=mysqli_query($con,$Q);
            if($q3){
                $id= mysqli_insert_id($con);
                $qq= mysqli_query($con ,"SELECT * FROM courses WHERE course_id= '$id'");
                if($qq){
                   
                    $fetch= mysqli_fetch_array($qq);
                    $subject= $fetch['course'];
                    $idd = $fetch['class_id'];
                    $qq2= mysqli_query($con ,"SELECT * FROM class WHERE id= '$idd'");
                    $fetch2= mysqli_fetch_array($qq2);
                    $class =$fetch2['class_name'];
                    @$msg= "<div style='color:green';><h3> Record Inserted Successfull!</h3><br/>
                    <h5>Subject: ". $subject ."</h5>
                    <h5>Class Name: ". $class ."</h5>
                    </div>";
                }
            }else{
                $msg= "<div style='color:red';><h3>An Error Occured".mysqli_error($con)."</h3></div>";   
            }
        }
        echo'<fieldset><br>';
            echo $msg; 
            echo '<br>
                <div class="input-group">
                    <span class="input-group-addon">Subject Name</span>
                    <input type="text" name="name" placeholder="Subject Name" class="form-control input-sm" required>
                </div>
                <br>
                <div class="input-group col-md-12 form-control">
                                <span class="input-group-addon">Class</span>
                                  <select class="" name="class" required>
                                    <option value="">Select Class</option>';
                                  $sql = mysqli_query($con,"SELECT * FROM class");
                            
                                      while($row = mysqli_fetch_array($sql)){
                                          echo '<option value="'.$row['id'].'">'.$row['class_name'].'</option>';
                                      }
          
                                   
                                echo '</select> 
                                </div>
                <br>
                <div class="form-group col-md-6 pull-right">
                    <input type="submit" class="btn btn-primary btn-block" name="register" value="Register Subject" >
                </div>
                </form>
            </fieldset>
            </form></div></div>';
   // }
?>