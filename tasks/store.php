<?php 

//conn
// function 
require_once "../inc/conn.php";
require_once "../inc/functions.php";
// check 
if(isset($_POST['submit'])){

    //catch 
    $title= clean($_POST['title']);
    $description = clean($_POST['description']);
    // valid 
    $errors = [];
    if(empty($title)){
        $errors[]="title is required";
    }

    if(empty($description)){
        $errors[]="description is required";
    }
    $user_id= $_SESSION['user_id'];
    // errors 
    if(empty($errors)){
        $query = "insert into tasks(`title`,`description`,`user_id`) values ('$title','$description',$user_id)";
        $result = mysqli_query($conn,$query);
        if($result){
            $_SESSION['success'] = 'task created success';
            redirect("index.php");
        }else{
            $_SESSION['errors'] = ['error while insert task'];
            redirect("index.php");
        }
    }else{
        $_SESSION['errors'] = $errors;
        redirect("index.php");
    }

    // success // redirect

}else{
    redirect('../errors/404.php');
}

