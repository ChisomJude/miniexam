<?php
    include_once 'dbConnection.php';
    session_start();
    if (isset($_SESSION['key'])) {
        if (@$_GET['id'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
            $id = @$_GET['id'];
            $result1 = mysqli_query($con, "DELETE FROM courses WHERE course_id='$id' ") or die('Error');
            header("location:dash.php?q=10");
        }
    }
    $result = mysqli_query($con, "SELECT * FROM courses INNER JOIN class ON courses.class_id
    = class.id") or die('Error');
    echo '<div class="panel"><table class="table table-striped title1">
    <tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Class</b></td><td style="vertical-align:middle"></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $id      = $row['course_id'];
        $subject      = $row['course'];
        $class      = $row['class_name'];
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $subject . '</td><td style="vertical-align:middle">' . $class . '</td>
        <td style="vertical-align:middle"><a title="Delete User" href="view_subject.php?id=' . $id . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
    }
    $c = 0;
    echo '</table></div>';
?>