<?php 
// conn
require_once "../inc/conn.php";

// check 
if(isset($_POST['submit'])){
//catch 
// $user_name= trim(htmlspecialchars($_POST['name']));
    trim(htmlspecialchars(extract($_POST)));
// valid
    $errors=[];
    //name

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
    // old password 
        $user=mysqli_fetch_assoc($result);
        $old_pass= $user['password'];
    // check  convert
        $is_verifed = password_verify($password , $old_pass); // true or false  
           if($is_verifed){
                //session user_id 
                // user name
                $_SESSION['user_id'] = $user['id']; /// logout => remove id session   ,, add post => login => user_id
                $_SESSION['user_name'] = $user['name']; 
                $_SESSION['success'] = "user login success";
                header("location:../tasks/index.php");  // login 
                exit();
                // die();
            }else{
                $_SESSION['errors'] = ["email or password not correct 1"];
                header("location:login.php"); 
            }
        }else{
            $_SESSION['errors'] = ["email or password not correct 2"];
            header("location:login.php"); 
        }
}else{
    //errors
        $_SESSION['email']=$email;
        $_SESSION['errors'] = $errors;
        header("location:login.php");
}

//redirect 
}else{
    header("location:../errors/404.php");
}


