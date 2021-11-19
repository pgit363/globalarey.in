<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    
    include_once '../../class/examtest.php';
    
    $database = new Database();
    
    $db = $database->getConnection();
    
    $item = new ExamTest($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->t_id = $data->t_id;

    $item->getSingleExamTest();
    
    if($item->standard != null)
    {
        //if available then delete
        if($item->deleteEducation())
        {
            return $examtestArr = array("message" => "Exam question deleted.");
        } 
        else
        {
            return $examtestArr = array("message" => "Exam question could not be deleted.");
        }
    }
    else
    {
        return $examtestArr = array("message" => "No record found.");
    }
?>