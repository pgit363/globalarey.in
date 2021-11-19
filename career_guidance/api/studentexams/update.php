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
    
    //acceptiong json encoded data from user
    $data = json_decode(file_get_contents("php://input"));
    
    $itemCheck->e_id = $data->e_id;
    
    //getting employee for checking is emp available
    $itemCheck->getSingleEvents();

    if($itemCheck->event_name != null)
    {
            //if available then update
            $item->e_id = $data->e_id;

            // employee values
            $item->event_name = $data->event_name;

            $item->event_date = $data->event_date;

            $item->publisher = $data->publisher;
    
            $item->link = $data->link;    

            $item->timestamp = date('Y-m-d H:i:s');

            if($item->updateEvent())
            {
                return $eventsArr = array("message" => "event updated.");
            } 
            else
            {
                return $eventsArr = array("message" => "event could not updated.");
            }
    }
    else
    {
        return $eventsArr = array("message" => "No record found.");
    }
?>