<?php 

    if(isset($_SESSION['errors'])){
        echo '<div class="alert alert-danger" role="alert">';
        foreach($_SESSION['errors'] as $error){
            echo $error . '<br>'; // display each error
        }
        echo '</div>';
        unset($_SESSION['errors']); // clear errors after displaying
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alert alert-success" role="alert">';
        echo $_SESSION['success']; // display success message
        echo '</div>';
        unset($_SESSION['success']); // clear success message after displaying
    }

