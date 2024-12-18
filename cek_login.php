<?php
include ('admin/config_query.php');
$db = new database();

// $pass = password_hash('admin1', PASSWORD_DEFAULT);
// var_dump($pass);
// die;

session_start();

if(isset($_SESSION['username']) || isset($_SESSION['id_admin'])){
    header('location: admin/index.php');

    
}else{

    if (isset($_POST['submit'])){
        
        
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        if(!empty(trim($username))&& !empty(trim($password))){
            $query = $db->get_data_admin($username);
            
            if($query){
                $rows = mysqli_num_rows($query);
            }else{
                $rows = 0;
            }
            // var_dump($rows);
            // die;
            if($rows !=0){
                $getData = $query->fetch_assoc();
                
                
                // var_dump($getPassword);
                // die;
                if(password_verify($password,$getData['password'])){
                    $_SESSION['username']=$username;
                    $_SESSION['id_admin']=$getData['id_admin'];

                    header('location: admin/index.php');
                }else{
                    header('location: login.php?pesan=gagal');
                }

            }else{
                header('location:login.php?pesan=not found');
            }
        }else{
            header('location:login.php?pesan=empty');
        }
    }else{
        header('location:login.php?pesan=empty');
    }
}