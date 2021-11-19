<?php
    class StudentExams{

        // Connection
        private $conn;

        // Table
        private $db_table = "student_exams";

        // Columns
        public $se_id;
        public $u_id;
        public $stndard;
        public $field;
        public $stream;
        public $rightanswer;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getStudentExams(){
            $sqlQuery = "SELECT
                *
            FROM
                ". $this->db_table ."";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->execute();
            
            return $stmt;
        }
        
          public function getStudentExamsById(){
            $sqlQuery = "SELECT
                *
            FROM
                ". $this->db_table ."
            WHERE
                u_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->u_id);
            
            $stmt->execute();
            
            return $stmt;
        }


        // CREATE
        public function createStudentExams(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        u_id = :u_id, 
                        standard = :standard,
                        field = :field,
                        stream = :stream,
                        rightanswer = :rightanswer,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->u_id=htmlspecialchars(strip_tags($this->u_id));
            $this->standard=htmlspecialchars(strip_tags($this->standard));
            $this->field=htmlspecialchars(strip_tags($this->field));
            $this->stream=htmlspecialchars(strip_tags($this->stream));
            $this->rightanswer=htmlspecialchars(strip_tags($this->rightanswer));            
        
            // bind data
            $stmt->bindParam(":u_id", $this->u_id);
            $stmt->bindParam(":standard", $this->standard);
            $stmt->bindParam(":field", $this->field);
            $stmt->bindParam(":stream", $this->stream);
            $stmt->bindParam(":rightanswer", $this->rightanswer);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleStudentExams(){
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
                $this->se_id = $dataRow['se_id'];
                $this->u_id = $dataRow['u_id'];
                $this->standard = $dataRow['standard'];
                $this->field = $dataRow['field'];
                $this->stream = $dataRow['stream'];
                $this->rightanswer = $dataRow['rightanswer'];
                $this->timestamp = $dataRow['timestamp'];
            }
        }        


        //check record
        public function getCheckSingleStudentExams(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            stream = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->stream);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->event_name = $dataRow['se_id'];
                $this->event_date = $dataRow['u_id'];
                $this->publisher = $dataRow['standard'];
                $this->link = $dataRow['field'];
                $this->stream = $dataRow['stream'];
                $this->rightanswer = $dataRow['rightanswer'];
                $this->timestamp = $dataRow['timestamp'];
            }
            
        }        

        // UPDATE
        public function updateEvent(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        event_name = :event_name, 
                        event_date = :event_date,
                        publisher = :publisher,
                        link = :link,
                        timestamp = :timestamp
                    WHERE 
                        e_id = :e_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->event_name=htmlspecialchars(strip_tags($this->event_name));
            $this->event_date=htmlspecialchars(strip_tags($this->event_date));
            $this->publisher=htmlspecialchars(strip_tags($this->publisher));
            $this->link=htmlspecialchars(strip_tags($this->link));        
            $this->e_id=htmlspecialchars(strip_tags($this->e_id));    
        
            // bind data
            $stmt->bindParam(":event_name", $this->event_name);
            $stmt->bindParam(":event_date", $this->event_date);
            $stmt->bindParam(":publisher", $this->publisher);
            $stmt->bindParam(":link", $this->link);
            $stmt->bindParam(":e_id", $this->e_id);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEvent(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE e_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->e_id=htmlspecialchars(strip_tags($this->e_id));
        
            $stmt->bindParam(1, $this->e_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

