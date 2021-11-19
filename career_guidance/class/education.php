<?php
    class Education{

        // Connection
        private $conn;

        // Table
        private $db_table = "education";

        // Columns
        public $edu_id ;
        public $u_id;
        public $country;
        public $state;
        public $board;
        public $medium;
        public $standard;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEducation(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEducation(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        u_id  = :u_id , 
                        country = :country,
                        state = :state,
                        board = :board,
                        medium = :medium,
                        standard = :standard,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->u_id=htmlspecialchars(strip_tags($this->u_id));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->medium=htmlspecialchars(strip_tags($this->medium));
            $this->standard=htmlspecialchars(strip_tags($this->standard));            
        
            // bind data
            $stmt->bindParam(":u_id", $this->u_id);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":state", $this->state);
            $stmt->bindParam(":board", $this->board);
            $stmt->bindParam(":medium", $this->medium);
            $stmt->bindParam(":standard", $this->standard);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEducation(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            edu_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->edu_id);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->u_id = $dataRow['u_id'];
                $this->country = $dataRow['country'];
                $this->state = $dataRow['state'];
                $this->board = $dataRow['board'];
                $this->medium = $dataRow['medium'];
                $this->standard = $dataRow['standard'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        


        //check record
        public function getCheckSingleEducation(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            u_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->u_id);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->edu_id = $dataRow['edu_id'];
                $this->u_id = $dataRow['u_id'];
                $this->country = $dataRow['country'];
                $this->state = $dataRow['state'];
                $this->board = $dataRow['board'];
                $this->medium = $dataRow['medium'];
                $this->standard = $dataRow['standard'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        

        // UPDATE
        public function updateEducation(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        country = :country,
                        state = :state,
                        board = :board,
                        medium = :medium,
                        standard = :standard,
                        timestamp = :timestamp
                    WHERE 
                        edu_id = :edu_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->board=htmlspecialchars(strip_tags($this->board));
            $this->medium=htmlspecialchars(strip_tags($this->medium));
            $this->standard=htmlspecialchars(strip_tags($this->standard));  
            $this->edu_id=htmlspecialchars(strip_tags($this->edu_id));
          
        
            // bind data
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":state", $this->state);
            $stmt->bindParam(":board", $this->board);
            $stmt->bindParam(":medium", $this->medium);
            $stmt->bindParam(":standard", $this->standard);
            $stmt->bindParam(":timestamp", $this->timestamp);
            $stmt->bindParam(":edu_id", $this->edu_id);
           
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEducation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE edu_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->edu_id=htmlspecialchars(strip_tags($this->edu_id));
        
            $stmt->bindParam(1, $this->edu_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

