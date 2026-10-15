<?php 
//conn
// function 
require_once "../inc/conn.php";
require_once "../inc/functions.php";
// check 
if(isset($_POST['submit']) && isset($_GET['id'])){

    //catch 
    $id=$_GET['id'];
    $user_id= $_SESSION['user_id'];

    //select one 
      $query = "select * from tasks where id=$id and user_id=$user_id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $query="delete from tasks where id=$id and user_id=$user_id";
            $result=mysqli_query($conn,$query);
            if($result){
                $_SESSION['success'] = "task deleted success";
                redirect("index.php");
            }else{
                $_SESSION['errors'] = ['error while delete task'];
                redirect("index.php");
            }
        }else{
            $_SESSION['errors'] = ['error while delete task'];
            redirect("index.php");
        }
}else{
    redirect('../errors/404.php');
}