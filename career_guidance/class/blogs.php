<?php
    class Blogs{

        // Connection
        private $conn;

        // Table
        private $db_table = "blogs";

        // Columns
        public $b_id;
        public $author_name;
        public $compnay_name;
        public $designation;
        public $blog_description;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getBlog(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createBlog(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        author_name = :author_name, 
                        compnay_name = :compnay_name,
                        designation = :designation,
                        blog_description = :blog_description,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->author_name=htmlspecialchars(strip_tags($this->author_name));
            $this->compnay_name=htmlspecialchars(strip_tags($this->compnay_name));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->blog_description=htmlspecialchars(strip_tags($this->blog_description));            
        
            // bind data
            $stmt->bindParam(":author_name", $this->author_name);
            $stmt->bindParam(":compnay_name", $this->compnay_name);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":blog_description", $this->blog_description);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleBlog(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            b_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->b_id);

            $stmt->execute();

            
            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->author_name = $dataRow['author_name'];
                $this->compnay_name = $dataRow['compnay_name'];
                $this->designation = $dataRow['designation'];
                $this->blog_description = $dataRow['blog_description'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        


        //check record
        public function getCheckSingleBlog(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            author_name = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->author_name);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->author_name = $dataRow['author_name'];
                $this->compnay_name = $dataRow['compnay_name'];
                $this->designation = $dataRow['designation'];
                $this->blog_description = $dataRow['blog_description'];
                $this->timestamp = $dataRow['timestamp'];
            }
            
        }        
    
        // DELETE
        function deleteBlog(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE b_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->b_id=htmlspecialchars(strip_tags($this->b_id));
        
            $stmt->bindParam(1, $this->b_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

