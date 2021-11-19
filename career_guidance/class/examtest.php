<?php
    class ExamTest{

        // Connection
        private $conn;

        // Table
        private $db_table = "exam_test";

        // Columns
        public $t_id ;
        public $standard;
        public $field;
        public $stream;
        public $question;
        public $option_A;
        public $option_B;
        public $option_C;
        public $option_D;
        public $answer;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getExamTestByFilter(){
            // $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            // $stmt = $this->conn->prepare($sqlQuery);
            // $stmt->execute();
            // return $stmt;

            $sqlQuery = "SELECT
                *
            FROM
                ". $this->db_table ."
            WHERE 
                standard = ?
            AND
                field = ?
            AND
                stream = ?
            LIMIT 5";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->standard);
            $stmt->bindParam(2, $this->field);
            $stmt->bindParam(3, $this->stream);

            $stmt->execute();

            return $stmt;
        }

        // CREATE
        public function createExamTest(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        standard  = :standard , 
                        field = :field,
                        stream = :stream,
                        question = :question,
                        option_A = :option_A,
                        option_B = :option_B,
                        option_C = :option_C,
                        option_D = :option_D,
                        answer = :answer,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->standard=htmlspecialchars(strip_tags($this->standard));
            $this->field=htmlspecialchars(strip_tags($this->field));
            $this->stream=htmlspecialchars(strip_tags($this->stream));
            $this->question=htmlspecialchars(strip_tags($this->question));
            $this->option_A=htmlspecialchars(strip_tags($this->option_A));
            $this->option_B=htmlspecialchars(strip_tags($this->option_B)); 
            $this->option_C=htmlspecialchars(strip_tags($this->option_C)); 
            $this->option_D=htmlspecialchars(strip_tags($this->option_D)); 
            $this->answer=htmlspecialchars(strip_tags($this->answer));            
        
            // bind data
            $stmt->bindParam(":standard", $this->standard);
            $stmt->bindParam(":field", $this->field);
            $stmt->bindParam(":stream", $this->stream);
            $stmt->bindParam(":question", $this->question);
            $stmt->bindParam(":option_A", $this->option_A);
            $stmt->bindParam(":option_B", $this->option_B);
            $stmt->bindParam(":option_C", $this->option_C);
            $stmt->bindParam(":option_D", $this->option_D);
            $stmt->bindParam(":answer", $this->answer);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleExamTest(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            t_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->t_id);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->t_id = $dataRow['t_id'];
                $this->standard = $dataRow['standard'];
                $this->field = $dataRow['field'];
                $this->stream = $dataRow['stream'];
                $this->question = $dataRow['question'];
                $this->option_A = $dataRow['option_A'];
                $this->option_B = $dataRow['option_B'];
                $this->option_C = $dataRow['option_C'];
                $this->option_D = $dataRow['option_D'];
                $this->answer = $dataRow['answer'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        


        //check record
        public function getCheckSingleExamTest(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            question = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->question);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->t_id = $dataRow['t_id'];
                $this->standard = $dataRow['standard'];
                $this->field = $dataRow['field'];
                $this->stream = $dataRow['stream'];
                $this->question = $dataRow['question'];
                $this->option_A = $dataRow['option_A'];
                $this->option_B = $dataRow['option_B'];
                $this->option_C = $dataRow['option_C'];
                $this->option_D = $dataRow['option_D'];
                $this->answer = $dataRow['answer'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        

        // UPDATE
        public function updateExamTest(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        standard  = :standard, 
                        field = :field,
                        stream = :stream,
                        question = :question,
                        option_A = :option_A,
                        option_B = :option_B,
                        option_C = :option_C,
                        option_D = :option_D,
                        answer = :answer,
                        timestamp = :timestamp
                    WHERE 
                        t_id = :t_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->standard=htmlspecialchars(strip_tags($this->standard));
            $this->field=htmlspecialchars(strip_tags($this->field));
            $this->stream=htmlspecialchars(strip_tags($this->stream));
            $this->question=htmlspecialchars(strip_tags($this->question));
            $this->option_A=htmlspecialchars(strip_tags($this->option_A));
            $this->option_B=htmlspecialchars(strip_tags($this->option_B)); 
            $this->option_C=htmlspecialchars(strip_tags($this->option_C)); 
            $this->option_D=htmlspecialchars(strip_tags($this->option_D));
            $this->answer=htmlspecialchars(strip_tags($this->answer));            
            $this->t_id=htmlspecialchars(strip_tags($this->t_id));

            // bind data
            $stmt->bindParam(":standard", $this->standard);
            $stmt->bindParam(":field", $this->field);
            $stmt->bindParam(":stream", $this->stream);
            $stmt->bindParam(":question", $this->question);
            $stmt->bindParam(":option_A", $this->option_A);
            $stmt->bindParam(":option_B", $this->option_B);
            $stmt->bindParam(":option_C", $this->option_C);
            $stmt->bindParam(":option_D", $this->option_D);
            $stmt->bindParam(":answer", $this->answer);
            $stmt->bindParam(":timestamp", $this->timestamp);
            $stmt->bindParam(":t_id", $this->t_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEducation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE t_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->t_id=htmlspecialchars(strip_tags($this->t_id));
        
            $stmt->bindParam(1, $this->t_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

