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

    $itemCheck = new Events($db);

    $data = json_decode(file_get_contents("php://input"));

    $itemCheck->event_name = $data->event_name;

    $itemCheck->getCheckSingleEvents();
    
    if($itemCheck->event_name != null)
    {
        //if type available 
        return $typeArr = array("message" => "events existed with same event name");
    }
    else
    {
        $item->event_name = $data->event_name;

        $item->event_date = $data->event_date;

        $item->publisher = $data->publisher;

        $item->link = $data->link;

        $item->timestamp = date('Y-m-d H:i:s');
        
        if($item->createEvents())
        {
            return $eventArr = array("message" => "new event added.");
        } 
        else
        {
            return $eventArr = array("message" => "new event could not be added.");
        }
    }
?>