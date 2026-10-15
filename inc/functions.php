<?php 

// clean

function clean($value){
    //trim html 
    return(trim(htmlspecialchars($value))); // $_POST['name']  ,,, extract=> all nname of var 
}


// redriect 

function redirect($path){
    //path 
    header("location:$path");
    exit();
}


//login ????
function require_login(){
    if(!isset($_SESSION['user_id'])){
        redirect("../auth/login.php");
    }
}