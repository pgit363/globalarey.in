<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    
    include_once '../../class/users.php';

    include_once '../../class/state.php';

    $database = new Database();
    
    $db = $database->getConnection();

    $item = new Users($db);

    $itemCheck = new Users($db);

    $itemState = new State($db);

    $data = json_decode(file_get_contents("php://input"));

    if ($data->email != null && $data->name != null) 
    {   
        $itemCheck->email = $data->email;

        $itemCheck->getCheckSingleUser();
        
        if($itemCheck->name != null)
        {
            //if email available 
            return $userArr = array("message" => "user existed with same email id");
        }
        else
        {
                $item->name = $data->name;

                $item->phone = $data->phone;

                $item->email = $data->email;

                $item->password = $data->password;

                $item->timestamp = date('Y-m-d H:i:s');
                
                if($item->createUser())
                {
                    $itemCheck->email = $data->email;

                    $itemCheck->getCheckSingleUser();
                    
                    if($itemCheck->name != null)
                    {

                        return $userArr = array("message" => "user created.",
                                                "u_id" => $itemCheck->u_id,);
                    }
                } 
                else
                {
                    return $userArr = array("message" => "user data could not be creaated.");
                }
        }
    }
    else
    {
        return $userArr = array("message" => "user data could not be empty.");
    }
?>