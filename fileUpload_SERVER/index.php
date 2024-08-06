<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require('./config/Database.php');

$db = new Database();

if (isset($_GET['function'])) {
    $function = $_GET['function'];
    if ($function == 'upload_files') {
        $db->saveData($_FILES);
        echo json_encode(['success' => count($_FILES['files']['name'])]);
    }


    if($function == "fetch-data"){
        $upload_files = $db->getFileUpload();
        echo json_encode(['upload_files'=>$upload_files]);
    }
}


if($function == "delete-data"){
    $fileUpload_id = $_GET['fileUpload_id'];
    $delete = $db->deleteFileUpload($fileUpload_id);
    if($delete){
        echo json_encode(['success'=>"Data deleted successfully!"]);
    }
}

?>
