<?php 
// conn
require_once "../inc/conn.php";
require_once "../inc/functions.php";

// check 
if(isset($_POST['submit'])){
//catch 
// $user_name= trim(htmlspecialchars($_POST['name']));
    // trim(htmlspecialchars(extract($_POST)));
// $name = clean($_POST['name']);
$name = clean($_POST['name']);   // ✨ تعديل هنا
    $email = clean($_POST['email']); // ✨ تعديل هنا
    $password = clean($_POST['password']); // ✨ تعديل هنا// valid
    $errors=[];
    //name
    if(empty($name)){
        $errors[]="name is required";
    }elseif(is_numeric($name)){
        $errors[]="name must be string";
    }
    //email
    if(empty($email)){
        $errors[]="email is required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="email must be email @";
    }
    //password
    if(empty($password)){
        $errors[]="password is required";
    }elseif(strlen($password) < 6){
        $errors[]="password must be more than 6 char";
    }
// errors
if(empty($errors)){
    //check email unique ??
    //email already exists
    $query = "select * from users where email ='$email' limit 1";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        $_SESSION['errors'] = ['Email Already Exists'];
        header("location:register.php");
    }
        $password = password_hash($password,PASSWORD_DEFAULT); //  60 shghsdfhgfgsd43345454541245214

        $query = "insert into users (`name`,`email`,`password`) values('$name','$email','$password') ";
        //run 
        $result = mysqli_query($conn,$query);
        if($result){

            //success
            $_SESSION['success'] = "user register success";
            header("location:login.php");  // login 
        }else{
            $_SESSION['errors'] = ["error while register user"];
            header("location:register.php"); 
        }
}else{
    //me
       $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        //
    //errors
        $_SESSION['errors'] = $errors;
        header("location:register.php");
}

//redirect 
}else{
    header("location:../errors/404.php");
}


