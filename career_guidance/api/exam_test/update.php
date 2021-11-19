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

    $itemCheck = new ExamTest($db);
    
    //acceptiong json encoded data from user
    $data = json_decode(file_get_contents("php://input"));
    
    $itemCheck->t_id = $data->t_id;
    
    //getting employee for checking is emp available
    $itemCheck->getSingleExamTest();

    if($itemCheck->standard != null)
    {
            //if available then update
            $item->t_id = $data->t_id;

            // employee values    
            $item->standard = $data->standard;    

            $item->field = $data->field;

            $item->stream = $data->stream;
    
            $item->question = $data->question;    

            $item->option_A = $data->option_A;

            $item->option_B = $data->option_B;

            $item->option_C = $data->option_C;

            $item->option_D = $data->option_D;

            $item->answer = $data->answer;

            $item->timestamp = date('Y-m-d H:i:s');

            if($item->updateExamTest())
            {
                return $educationArr = array("message" => "Exam question updated.");
            } 
            else
            {
                return $educationArr = array("message" => "Exam question could not updated.");
            }
    }
    else
    {
        return $educationArr = array("message" => "No record found.");
    }
?>