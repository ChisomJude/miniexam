<?php
    include_once 'dbConnection.php';
    session_start();
    if (isset($_SESSION['key'])) {
        if (@$_GET['id'] && $_SESSION['key'] == '65585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
            $id = @$_GET['id'];
            $result1 = mysqli_query($con, "DELETE FROM courses WHERE course_id='$id' ") or die('Error');
            header("location:dash.php?q=10");
        }
    } 
    $id = $_SESSION['id'];
  
    $result1 = mysqli_query($con,"SELECT * FROM teachers_courses WHERE tid ='$id'") or die('Error');
    $count = mysqli_num_rows($result1);
      echo ' <div class="row">
        <span class="title1" style="margin-left:40%;font-size:30px;">
        <b>Assigned Courses</b></span><br /></div>';

    echo '<div class="panel"><table class="table table-striped title1">
    <tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Class</b></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result1)) {
        $cid = $row['cos_id'];
        $result = mysqli_query($con, "SELECT * FROM courses INNER JOIN class 
                ON courses.class_id = class.id WHERE courses.course_id = '$cid'") or die('Error');     
        $row = mysqli_fetch_array($result);
        $id      = $row['course_id'];
        $subject      = $row['course'];
        $class      = $row['class_name'];
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $subject . '</td><td style="vertical-align:middle">' . $class . '</td>
        </tr>';
    }
    $c = 0;
    echo '</table></div>';
?>