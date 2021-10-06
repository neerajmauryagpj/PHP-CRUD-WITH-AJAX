<?php
if(!empty($_FILES['file']['name'])){
    sleep(2);
    $fileName = $_FILES['file']['name'];
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    $newName = rand().'.'.$fileExtension;
    $valid_file = array('jpg','jpeg','png','gif');
    $filePath ='images/'.$newName;
    if(in_array($fileExtension,$valid_file)){
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath);
        echo('<img src="'.$filePath.'"><div class="deleteBtn" id="deleteFile" data-path="'.$filePath.'">Delete</div>');
        
    }else if($fileExtension == 'mp4'){
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath);
        echo('<video width="320" height="240" controls>
              <source src="'.$filePath.'" type="video/mp4">
              <source src="movie.ogg" type="video/ogg">
              Your browser does not support the video tag.
            </video><div class="deleteBtn" id="deleteFile" data-path="'.$filePath.'">Delete</div>');
    }
    else{
        echo('Invalid file');
    }
    
}
if(!empty($_POST['file'])){
    unlink($_POST['file']);
}
?>
