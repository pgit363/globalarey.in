<?php
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';

    include_once '../../class/users.php';
    
    $database = new Database();

    $db = $database->getConnection();
    
    $item = new Users($db);

    $itemCheck = new Users($db);
    
    //acceptiong json encoded data from user
    $data = json_decode(file_get_contents("php://input"));
    
    $itemCheck->u_id = $data->u_id;
    
    //getting employee for checking is emp available
    $itemCheck->getSingleUser();

    if($itemCheck->name != null)
    {
        //if available then update
        $item->u_id = $data->u_id;
        
        // employee values
        $item->name = $data->name;

        $item->phone = $data->phone;

        $item->email = $data->email;

        $item->password = $data->password;

        $item->timestamp = date('Y-m-d H:i:s');

        if($item->updateUser())
        {
            $users = array("name" => $data->name,
                            "phone" => $data->phone,
                            "email" => $data->email,
                            "password" => $data->password,
                            "timestamp" => $item->timestamp,
                            );

                return $userArr = array("flag" => true,
                                        "message" => "user data updated.",
                                        "updatedUser" => $users);
        } 
        else
        {
            return $userArr = array("message" => "user data could not updated.");
        }
    }
    else
    {
        return $userArr = array("message" => "No record found.");
    }
?>