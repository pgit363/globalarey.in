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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->edu_id = $data->edu_id;

    $item->getSingleEducation();
    
    if($item->standard != null)
    {
        //if available then delete
        if($item->deleteEducation())
        {
            return $educationArr = array("message" => "Education deleted.");
        } 
        else
        {
            return $educationArr = array("message" => "Education could not be deleted.");
        }
    }
    else
    {
        return $eventArr = array("message" => "No record found.");
    }
?>