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
    
    //acceptiong json encoded data from user
    $data = json_decode(file_get_contents("php://input"));
    
    $itemCheck->edu_id = $data->edu_id;
    
    //getting employee for checking is emp available
    $itemCheck->getSingleEducation();

    if($itemCheck->standard != null)
    {
            //if available then update
            $item->edu_id = $data->edu_id;

            // employee values
            $item->u_id = $data->u_id;

            $item->country = $data->country;

            $item->state = $data->state;
    
            $item->board = $data->board;    

            $item->medium = $data->medium;
    
            $item->standard = $data->standard;    

            $item->timestamp = date('Y-m-d H:i:s');

            if($item->updateEducation())
            {
                return $educationArr = array("message" => "Education details updated.");
            } 
            else
            {
                return $educationArr = array("message" => "Education details could not updated.");
            }
    }
    else
    {
        return $educationArr = array("message" => "No record found.");
    }
?>