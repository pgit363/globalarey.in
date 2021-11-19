<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    
    include_once '../../class/studentexams.php';

    $database = new Database();
    
    $db = $database->getConnection();

    $item = new StudentExams($db);

    $itemCheck = new StudentExams($db);

    $data = json_decode(file_get_contents("php://input"));

    $itemCheck->u_id = $data->u_id;

    $itemCheck->getCheckSingleStudentExams();
    
    if($itemCheck->stream != null)
    {
        //if type available 
        return $typeArr = array("message" => "exam score existed already");
    }
    else
    {
        $item->u_id = $data->u_id;

        $item->standard = $data->standard;

        $item->field = $data->field;

        $item->stream = $data->stream;

        $item->rightanswer = $data->rightanswer;

        $item->timestamp = date('Y-m-d H:i:s');
        
        if($item->createStudentExams())
        {
            return $eventArr = array("message" => "exam score added.");
        } 
        else
        {
            return $eventArr = array("message" => "exam score could not be added.");
        }
    }
?>