<?php
if(isset($_POST['submit'])){
    if(!empty($_FILES['file']['name'][0])){
        $length =count($_FILES['file']['name']);
        echo"<div style='display:flex;flex-wrap:wrap'>";
        for($i=0;$i<$length;$i++){
            $fileName = $_FILES['file']['name'][$i];
            $tmpName = $_FILES['file']['tmp_name'][$i];
            $path = 'images/'.$fileName;
            move_uploaded_file($tmpName,$path);
            echo"<img style='width:300px;padding:5px' src=".$path.">";  
        }   
        echo"</div>";
    }else{
        echo"<span style='color:red;padding:10px'>File Not Select</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD operation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="body-wrapper">
        <div class="main">
            <h2>Multiple File Upload</h2>
            <div class="form">
                <form action="" method="post" enctype='multipart/form-data'>
                    <div class="form-control">
                        <label for="name">File</label>
                        <input type="file" name="file[]" multiple />
                        <button type="submit" id="upload" name="submit">
                            <span class="upload-txt">Upload</span>
                        </button>

                    </div>
                    <div class="form-control">
                        <span id="loading"></span><span id="success"></span>
                    </div>
                    <div id="error" style="color:red"></div>
                    <div id="upload-img">

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
