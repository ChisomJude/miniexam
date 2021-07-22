<?php
    include_once 'dbConnection.php';


    if($_POST['submit']){
        $title = $con->real_escape_string($_POST['title']);
        $note= $con->real_escape_string($_POST['note']);
        $subject = $_POST['subject'];
        $time = time();
        $date = date('d-m-y');
        $sql = "INSERT INTO note VALUES (NULL, '$title','$subject','$note','$date')";
        $result=mysqli_query($con,$sql);
        if($result){
            $id= mysqli_insert_id($con);
    $uploaddir = realpath('./') . '/';
            $total = count($_FILES['upload']['name']);
            echo $total . ' attachement<br>';
            for ($i=0; $i <$total ; $i++) { 
                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
                if($tmpFilePath !=""){
                    $targetPath ="uploadedFile/".$time.basename($_FILES['upload']['name'][$i]);
                    if(move_uploaded_file($tmpFilePath,$targetPath)){
                         $ext = strtolower(pathinfo($_FILES['upload']['name'][$i],PATHINFO_EXTENSION));
                         $type = 3;
                         if($ext=="mp4"){
                             $type = 0;
                         }else if($ext=="jpeg"||$ext=="jpg"||$ext=="png"){
                             $type = 1;
                         }
                        $sql = "INSERT INTO course_file VALUES (NULL, '$type','$targetPath','$id')";
                        $result = mysqli_query($con,$sql);
                       // echo "<div style='color:green';><h3>".$_FILES['upload']['name'][$i]." Saved Successfully!</h3><br/>";
                    }else{
                        echo "<div style='color:red';><h3>".$_FILES['upload']['name'][$i]." not saved</h3></div>";
                    }
                }
            }
             echo "<div style='color:green';><h3> Note Saved Successfull!</h3></div>";
        }
       
    }
     echo
    '<div class="row">
        <div class="col-md-12" >
            <span class="title1" style="margin-left:40%;font-size:30px;">
                <b>Create Note</b>
            </span><br/><br/>
        </div>
    </div>';

    echo '
    <div class="row">
        <form action=""  enctype="multipart/form-data" method="Post">
        <div class="row">
        <div class="col-md-6" >
         	<div class="form-group">
                 <input type="text" class="form-control" placeholder="Topic*" name="title" required="Title">
            </div>
            <div class="form-group">
               <textarea rows="20" class="form-control" placeholder="type note here..." name="note" required="Note"></textarea>
            </div>	
               
        </div>
         <div class="col-md-6">
         <div class="input-group form-control">
            <span class="input-group-addon">Subject</span>
            <select class="form-control" name="subject" required>
            <option value="">Select Subject</option>';
                               
          $id = $_SESSION['id'];
            $result1 = mysqli_query($con,"SELECT * FROM teachers_courses WHERE tid ='$id'") or die('Error');
        while ($row = mysqli_fetch_array($result1)) {
        $cid = $row['cos_id'];
        $result = mysqli_query($con, "SELECT * FROM courses INNER JOIN class 
                ON courses.class_id = class.id WHERE courses.course_id = '$cid'") or die('Error');     
        $row = mysqli_fetch_array($result);
        $id      = $row['course_id'];
        $subject      = $row['course'];
        $class      = $row['class_name'];
            echo '<option value="'.$id.'">'.$subject.'( '.$class.') '.'</option>';
        }
                                   
        echo '</select> </div><br>
            <div class="input-group form-control">
                  <span class="input-group-addon">Select video<br/> or Image</span>
                <input type="file" class="form-control"  name="upload[]" style="margin:auto;" accept="image/jpeg,image/png, video/mp4" multiple>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="submit" value="submit"  style="float:right;">
            <p>
            <h4>Tips</h4>
            <ul>
                <li>You can select more than 1 image or video</li>
                 <li>Supported image type is jpg,jpej and png only</li>
                  <li>Supported video type is mp4 only</li>
                 <li>Format note using basic html tags </li>
            </ul>
        </p>
         </div>
       
        </div>
        </form>  
    </div>
    ';

?>