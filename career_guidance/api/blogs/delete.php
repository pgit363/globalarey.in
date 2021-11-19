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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->b_id = $data->b_id;

    $item->getSingleBlog();
    
    if($item->author_name != null)
    {
        //if available then delete
        if($item->deleteBlog())
        {
            return $blogsArr = array("message" => "Blogs deleted.");
        } 
        else
        {
            return $blogsArr = array("message" => "Blogs could not be deleted.");
        }
    }
    else
    {
        return $blogsArr = array("message" => "No record found.");
    }
?>