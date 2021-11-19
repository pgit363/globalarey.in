<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $request = $_SERVER['REQUEST_METHOD'];

    $token = base64_encode("admin"."admin123");

    $authToken = "";

    $data = array();

    foreach (getallheaders() as $name => $value) 
    {
        if($name == "Authorization")
        {
            $authToken = ltrim($value,"Bearer ");
        }
    }

    if($authToken == "YWRtaW5hZG1pbjEyMw==")
    {
        switch ($request) 
        {
            case 'GET':
                response($data[]=array("status"=>http_response_code(401),"message"=>"server request not allowed"));
            break;
            
            case 'POST':
                response(get());
            break;
            
            case 'PUT':
                response($data[]=array("status"=>http_response_code(401),"message"=>"server request not allowed"));
            break;
            
            case 'DELETE':
                response($data[]=array("status"=>http_response_code(401),"message"=>"server request not allowed"));
            break;
            
            default:
                response($data[]=array("status"=>http_response_code(401),"message"=>"server request not allowed"));
            break;
        }
    }
    else if(empty($authToken))
    {
        response($data = array("status"=>http_response_code(404),"message"=>"token Required..!"));
    }
    else
    {
        response($data = array("status"=>http_response_code(401),"message"=>"invalid Token..!"));
    }

    function get()
    {
        include_once '../../config/database.php';
        
        include_once '../../class/examtest.php';
        
        $database = new Database();
        
        $db = $database->getConnection();

        $items = new ExamTest($db);

        $data = json_decode(file_get_contents("php://input"));

        $items->standard = $data->standard;
        
        $items->field = $data->field;
        
        $items->stream = $data->stream;

        $stmt = $items->getExamTestByFilter();
        
        $examtestCount = $stmt->rowCount();

        if($examtestCount > 0)
        {    
            $examtestArr = array();
            $examtestArr["message"] =  true;
            $examtestArr["examtestCount"] =  array($examtestCount);
            $examtestArr["examtest"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                $e = array("t_id" => $t_id,
                            "standard" => $standard,
                            "field" => $field,
                            "stream" => $stream,
                            "question" => $question,
                            "option_A" => $option_A,
                            "option_B" => $option_B,
                            "option_C" => $option_C,
                            "option_D" => $option_D,
                            "answer" => $answer,
                            "timestamp" => $timestamp
                        );

                array_push($examtestArr["examtest"], $e);
            }
            return $examtestArr;
        }
        else
        {
            return $examtestArr = array("message" => "No record found.");
        }
    }    

    function response($data)
    {
        $myObj =new stdClass();
        
        $myObj->status = "ok";
        
        $myObj->code = http_response_code(200);
        
        $myObj->response = $data;
        
        echo  json_encode($myObj);
    }
?>