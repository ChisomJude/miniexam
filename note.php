<?php
 include_once 'dbConnection.php';
    
   // $id = $_GET['id'];
    $result1 = mysqli_query($con,"SELECT * FROM note WHERE note.id ='$id'") or die('Error'.$con->error);
            $row = mysqli_fetch_array($result1);
    $result2 = mysqli_query($con,"SELECT * FROM course_file WHERE note_id ='$id'") or die('Error'.$con->error);
    $num =mysqli_num_rows($result2);
            
    echo'
    <div class="row card" style="padding:10px;">';
        if($num==0){
           echo '<div class="col-md-12 card">';
        }else{
                echo '<div class="col-md-8 card">';
        }echo'
            <center>
            <div class="row">
                <span class="title1" style="font-size:20px;color:#000888;">
                    <b>Topic : '.$row['title'].'</b>
                </span><br/>
            </div>
           <div class="row">
                <span class="title1" style="font-size:16px;color:#000000;">
                    <b>Date : '.$row['date'].'</b>
                </span>
            </div> <hr/>
            </center>
            <div class="row"style="padding:30px;">
           
                <span class="title1" style="font-size:17px;color:#000000;text-align:justify;">
                    '.$row['note'].'
                </span><br/>
            </div> 
        </div>';
        if($num>0){
           echo '<div class="col-md-4 card">';
        }
            while($row2 = mysqli_fetch_array($result2)){
               if ($row2['file_type']==1) {
                  echo '<a href ="'.$row2['url'].'" target="blank"><img class="card" style="width:100%;height:auto;"  src="'.$row2['url'].'"></a><hr/>';
               }else if ($row2['file_type']==0) {
                  echo '<a href ="'.$row2['url'].'" target="blank"><video controls preload="metadata" class="card" style="width:100%;height:auto;" >
                  <source src="'.$row2['url'].'"type="video/mp4">
                  Your Browser Cannot Play this Video
                  </video></a><hr/>';
               }
            }
           
           // if($row['note'])
       echo '</div>
    </div>
    ';
?>  
    