<?php 

  class Database{

    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "php_tut_db";

    public $connect;

    public function __construct(){
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);
        ;
        if($this->connect->connect_errno){
            echo "failed to connect to database";
        }
    }
    

    public function saveData($data){

        if(isset($data['files']) && count($data['files']) > 0){

            for($i=0; $i < count($data['files']['name']); $i++){
                $file_name = $data['files']['name'][$i];
                $tmp_name = $data['files']['tmp_name'][$i];
                $base_name = basename($file_name);
                $file_type = pathinfo($base_name, PATHINFO_EXTENSION);
                $encypted_file_name = uniqid().'-'.$file_type;
                $folder = "./uploads/";
                $destination = $folder.$encypted_file_name;
                if(move_uploaded_file($tmp_name, $destination )){
                    $sql = "INSERT INTO uploaded_files(file_type, file_name) VALUES('{$file_type}', '{$encypted_file_name}')";
                    $this->connect->query($sql);
                }
            }
            return true;
        }else{
            return false;
        }
       
       
    }
  

    public function getFileUpload(){
        $sql = "SELECT * FROM uploaded_files";
        $query = $this->connect->query($sql);
        $upload_files = [];
        while($row = $query->fetch_assoc()){
            array_push($upload_files, $row);
        }
        return $upload_files;
    }


   

    public function deleteFileUpload( $fileUpload_id){
    $sql = "DELETE FROM uploaded_files WHERE id = ' $fileUpload_id'";
    $query = $this->connect->query($sql);
    return $query;
}


}



