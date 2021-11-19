<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    
    include_once '../../class/education.php';

    $database = new Database();
    
    $db = $database->getConnection();

    $item = new Education($db);

    $itemCheck = new Education($db);

    $data = json_decode(file_get_contents("php://input"));

    $itemCheck->u_id = $data->u_id;

    $itemCheck->getCheckSingleEducation();
    
    if($itemCheck->standard != null && $itemCheck->u_id != null)
    {
        //if type available 
        return $typeArr = array("message" => "education existed with same event name");
    }
    else
    {
        $item->u_id = $data->u_id;

        $item->country = $data->country;

        $item->state = $data->state;

        $item->board = $data->board;

        $item->medium = $data->medium;

        $item->standard = $data->standard;

        $item->timestamp = date('Y-m-d H:i:s');
        
        if($item->createEducation())
        {
            return $educationArr = array("message" => "new education added.");
        } 
        else
        {
            return $educationArr = array("message" => "new education could not be added.");
        }
    }
?>