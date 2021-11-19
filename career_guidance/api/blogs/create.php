<?php
    
    header("Access-Control-Allow-Origin: *");
    
    header("Content-Type: application/json; charset=UTF-8");
    
    header("Access-Control-Allow-Methods: POST");
    
    header("Access-Control-Max-Age: 3600");
    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    
    include_once '../../class/blogs.php';

    $database = new Database();
    
    $db = $database->getConnection();

    $item = new Blogs($db);

    $itemCheck = new Blogs($db);

    $data = json_decode(file_get_contents("php://input"));

    $itemCheck->author_name = $data->author_name;

    $itemCheck->getCheckSingleBlog();

    $item->author_name = $data->author_name;

    $item->compnay_name = $data->compnay_name;

    $item->designation = $data->designation;

    $item->blog_description = $data->blog_description;

    $item->timestamp = date('Y-m-d H:i:s');
    
    if($item->createBlog())
    {
        return $blogsArr = array("message" => "new Blogs added.");
    } 
    else
    {
        return $blogsArr = array("message" => "new Blogs could not be added.");
    }

?>