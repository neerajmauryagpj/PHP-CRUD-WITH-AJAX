<?php

$con = mysqli_connect("localhost","root","","practice") or die("Connection Failed");
if(!empty($_POST['name'])){
    sleep(1);
    $name = $_POST['name'];
    $city = $_POST['city'];
    $course = $_POST['course'];
    $sql = "insert into student(name,city,course) values('$name','$city','$course')";
    $res = mysqli_query($con,$sql);
    if($res){
        echo('Success! ');
    }else{
        echo('Failed! ');
    }
}

//Read data
if(!empty($_GET['read'])){
    $sql = "select * from student";
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $data = json_encode($data);
    echo($data);
}
//delete data
if(!empty($_POST['dataId'])){
    $id = $_POST['dataId'];
    $sql = "delete from student where id='$id'";
    $res = mysqli_query($con,$sql);
}
//get data where you want to update 
if(!empty($_POST['editId'])){
    $id = $_POST['editId'];
    $sql = "select * from student where id='$id'";
    $res = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($res);
    $data = json_encode($data);
    echo($data);
}
//update data
if(!empty($_POST['updateId'])){
    $id = $_POST['updateId'];
    $name = $_POST['updateName'];
    $city = $_POST['updateCity'];
    $course = $_POST['updateCourse'];
    $sql = "update student set name='$name',city='$city',course='$course' where id='$id'";
    $res = mysqli_query($con,$sql);
    if($res){
        echo('update success');
    }else{
         echo('update failed');
    }
}
?>
