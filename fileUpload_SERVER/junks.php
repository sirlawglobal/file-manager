<?php

ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    header('Access-Control-Allow-Origin: *');

    header('Access-Control-Allow-Methods: GET, POST');
    
    header("Access-Control-Allow-Headers: X-Requested-With");

    
    
    require('./config/Database.php');

    $db = new Database();
    
    if(isset($_GET['function'])){

        $function = $_GET['function'];


        //Create
        if($function == 'upload_files'){
            $db->saveData($_FILES);
            echo json_encode(['success'=>count($_FILES['files'])]);
        }
       

    }



?>