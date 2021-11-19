<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    
    include_once '../../class/events.php';
    
    $database = new Database();
    
    $db = $database->getConnection();
    
    $item = new Events($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->e_id = $data->e_id;

    $item->getSingleEvents();
    
    if($item->event_name != null)
    {
        //if available then delete
        if($item->deleteEvent())
        {
            return $eventArr = array("message" => "event deleted.");
        } 
        else
        {
            return $eventArr = array("message" => "event could not be deleted.");
        }
    }
    else
    {
        return $eventArr = array("message" => "No record found.");
    }
?>