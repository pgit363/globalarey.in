<?php
    class Events{

        // Connection
        private $conn;

        // Table
        private $db_table = "events";

        // Columns
        public $e_id;
        public $event_name;
        public $event_date;
        public $publisher;
        public $link;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEvents(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEvents(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        event_name = :event_name, 
                        event_date = :event_date,
                        publisher = :publisher,
                        link = :link,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->event_name=htmlspecialchars(strip_tags($this->event_name));
            $this->event_date=htmlspecialchars(strip_tags($this->event_date));
            $this->publisher=htmlspecialchars(strip_tags($this->publisher));
            $this->link=htmlspecialchars(strip_tags($this->link));            
        
            // bind data
            $stmt->bindParam(":event_name", $this->event_name);
            $stmt->bindParam(":event_date", $this->event_date);
            $stmt->bindParam(":publisher", $this->publisher);
            $stmt->bindParam(":link", $this->link);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEvents(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            e_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->e_id);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->event_name = $dataRow['event_name'];
                $this->event_date = $dataRow['event_date'];
                $this->publisher = $dataRow['publisher'];
                $this->link = $dataRow['link'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        


        //check record
        public function getCheckSingleEvents(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            event_name = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->event_name);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->event_name = $dataRow['event_name'];
                $this->event_date = $dataRow['event_date'];
                $this->publisher = $dataRow['publisher'];
                $this->link = $dataRow['link'];
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

