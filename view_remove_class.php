<?php
    include_once 'dbConnection.php';
    session_start();
    if (isset($_SESSION['key'])) {
        if (@$_GET['name'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
            $dusername = @$_GET['name'];
            $result1 = mysqli_query($con, "DELETE FROM class WHERE class_name='$dusername' ") or die('Error');
            header("location:dash.php?q=12");
        }
    }
    $result = mysqli_query($con, "SELECT * FROM class") or die('Error');
    echo '<div class="panel"><table class="table table-striped title1">
    <tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $name      = $row['class_name'];
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $name . '</td>
        <td style="vertical-align:middle"><a title="Delete User" href="view_remove_class.php?name=' . $name . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
    }
    $c = 0;
    echo '</table></div>';
?>