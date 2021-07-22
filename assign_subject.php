<?php
include_once 'dbConnection.php';

        echo ' <div class="row">
        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Assign Subject </b></span><br /><br />
        <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action=""  method="POST">
        <div class="col-md-10 col-md-offset-1" style="border:4px; border-raduis:4px solid #456455;">';
        if($_POST['register']){
            $subject = $_POST['subject'];
            $teacher = $_POST['teacher'];
            $Q= "INSERT INTO teachers_courses VALUES (NULL,$teacher,$subject)";
            $q3=mysqli_query($con,$Q);
            if($q3){
                $id= mysqli_insert_id($con);
                $qq= mysqli_query($con ,"SELECT * FROM teachers_courses WHERE id= '$id'");
                if($qq){
                   
                    $fetch= mysqli_fetch_array($qq);
                    $tid= $fetch['tid'];
                    $cid = $fetch['cos_id'];
                    $qq2= mysqli_query($con ,"SELECT * FROM teachers WHERE id= '$tid'");
                    $fetch2= mysqli_fetch_array($qq2);
                    $teacher =$fetch2['name'].'( '.$fetch2['username'].') ';
                    $qq3= mysqli_query($con ,"SELECT * FROM courses INNER JOIN class ON courses.class_id
    = class.id WHERE  courses.course_id= '$cid'");
                    $fetch3= mysqli_fetch_array($qq3);
                    $course =$fetch3['course'].'( '.$fetch3['class_name'].') ';
                    @$msg= "<div style='color:green';><h3> Record Inserted Successfull!</h3><br/>
                    <h5>Subject: ". $teacher ."</h5>
                    <h5>Class Name: ". $course ."</h5>
                    </div>";
                }
            }else{
                $msg= "<div style='color:red';><h3>An Error Occured".mysqli_error($con)."</h3></div>";   
            }
        }
        echo'<fieldset><br>';
            echo $msg; 
            echo '<br>
                
                <div class="input-group col-md-12 form-control">
                                <span class="input-group-addon">Subject</span>
                                  <select class="" name="subject" required>
                                    <option value="">Select Subject</option>';
                                  $sql = mysqli_query($con,"SELECT * FROM courses INNER JOIN class ON courses.class_id
    = class.id");
                            
                                      while($row = mysqli_fetch_array($sql)){
                                          echo '<option value="'.$row['course_id'].'">'.$row['course'].'( '.$row['class_name']
                                          .') '.'</option>';
                                      }
                                   
                                echo '</select> 
                                </div>
                <br>
                <div class="input-group col-md-12 form-control">
                                <span class="input-group-addon">Teacher</span>
                                  <select class="" name="teacher" required>
                                    <option value="">Select Teacher</option>';
                                  $sql = mysqli_query($con,"SELECT * FROM teachers");
                            
                                      while($row = mysqli_fetch_array($sql)){
                                          echo '<option value="'.$row['id'].'">'.$row['name'].'( '.$row['username']
                                          .') '.'</option>';
                                      }
                                   
                                echo '</select> 
                                </div>
                                <br>
                <div class="form-group col-md-6 pull-right">
                    <input type="submit" class="btn btn-primary btn-block" name="register" value="Assign Subject" >
                </div>
                </form>
            </fieldset>
            </form></div></div>';
   // }
?>