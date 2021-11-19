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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->u_id = $data->u_id;

    $item->getSingleUser();
    
    if($item->name != null)
    {
        //if available then delete
        if($item->deleteUser())
        {
            return $employeeArr = array("message" => "user deleted.");
        } 
        else
        {
            return $employeeArr = array("message" => "user data could not be deleted.");
        }
    }
    else
    {
        return $employeeArr = array("message" => "No record found.");
    }
?>