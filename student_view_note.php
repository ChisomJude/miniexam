<?php
 include_once 'dbConnection.php';
     session_start();
    if (isset($_SESSION['key'])) {
        if (@$_GET['id'] && $_SESSION['key'] == '65585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
            $id = @$_GET['id'];
            $result1 = mysqli_query($con, "DELETE FROM note WHERE id='$id' ") or die('Error');
            header("location:dashboard_teacher.php?q=2");
        }
    }
  echo '
    <div class="row">
        <div class="col-md-4"><br/><br><br/><br>
        <form action=""  enctype="multipart/form-data" method="Post">
         <div class="input-group form-control">
            <span class="input-group-addon">Subject</span>
            <select class="form-control" name="subject" required>
            <option value="">Select Subject</option>';                
            //$id = $_SESSION['id'];
            $result1 = mysqli_query($con,"SELECT * FROM courses WHERE class_id ='$id'") or die('Error');
            while ($row = mysqli_fetch_array($result1)) {
                $cid = $row['course_id'];
                $subject      = $row['course'];
                $class      = $row['class_name'];
                echo '<option value="'.$cid.'">'.$subject.'</option>';
            }
            echo '</select> </div><br>
            <input type="submit" class="btn btn-primary" name="submit" value="submit"  style="float:right;">
        </form> 
        </div>
         <div class="col-md-8">';
          if($_POST['submit']){
              $id = $_POST['subject'];
              $result = mysqli_query($con, "SELECT * FROM courses INNER JOIN class 
                ON courses.class_id = class.id WHERE courses.course_id = '$id'") or die('Error');     
                $row = mysqli_fetch_array($result);
                $subject      = $row['course'];
                $class      = $row['class_name'];
                echo '  <div class="row">
                <span class="title1" style="font-size:25px;">
                    <b>'.$subject.'( '.$class.') '.'</b>
                </span><br/>
            </div>';
            $result = mysqli_query($con, "SELECT * FROM note WHERE cos_id = '$id' ") or die('Error');
            echo '<div class="panel"><table class="table table-striped title1">
            <tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Date</b></td><td style="vertical-align:middle"><b>Topic</b></td><td style="vertical-align:middle"></td><td style="vertical-align:middle"></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
                $date      = $row['date'];
                $topic = $row['title'];
                $id =$row['id'];
                echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $date . '</td><td style="vertical-align:middle">' . $topic . '</td>
                <td style="vertical-align:middle"><a href="account.php?q=34&n='.$id.'">View</a></td></tr>';
            }
            $c = 0;
            echo '</table></div>';
          }else {
               echo '  <div class="row">
                <span class="title1" style="font-size:25px;">
                    <b>Select Subject to View Notes'.'</b>
                </span><br/>
            </div>';
          }

     echo '
     </div>';
?>