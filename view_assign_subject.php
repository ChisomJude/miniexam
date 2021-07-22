<?php
    include_once 'dbConnection.php';
    session_start();
    if (isset($_SESSION['key'])) {
        if (@$_GET['id'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
            $id = @$_GET['id'];
            $result1 = mysqli_query($con, "DELETE FROM teachers_courses WHERE id='$id' ") or die('Error');
            header("location:dash.php?q=14");
        }
    }
     $result = mysqli_query($con, "SELECT * FROM teachers_courses") or die('Error');
    echo '<div class="panel"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Subject</b></td><td style="vertical-align:middle"><b>Teacher</b></td><td style="vertical-align:middle"></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $tid= $row['tid'];
        $cid = $row['cos_id'];
        $id =$row['id'];
         $qq2= mysqli_query($con ,"SELECT * FROM teachers WHERE id= '$tid'");
                    $fetch2= mysqli_fetch_array($qq2);
                    $teacher =$fetch2['name'].'( '.$fetch2['username'].') ';
                    $qq3= mysqli_query($con ,"SELECT * FROM courses INNER JOIN class ON courses.class_id
    = class.id WHERE  courses.course_id= '$cid'");
                    $fetch3= mysqli_fetch_array($qq3);
                    $course =$fetch3['course'].'( '.$fetch3['class_name'].') ';
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $course . '</td><td style="vertical-align:middle">' . $teacher . '</td>
  <td style="vertical-align:middle"><a title="Delete User" href="view_assign_subject.php?id=' . $id . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
    }
    $c = 0;
    echo '</table></div>';
?>