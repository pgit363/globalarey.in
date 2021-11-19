<?php
    class Users{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $u_id;
        public $name;
        public $phone;
        public $email;
        public $password;
        public $timestamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUsers(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        phone = :phone,
                        email = :email,
                        password = :password,
                        timestamp = :timestamp";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->u_id=htmlspecialchars(strip_tags($this->u_id));
            
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":timestamp", $this->timestamp);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleUser(){
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
                $this->name = $dataRow['name'];
                $this->phone = $dataRow['phone'];
                $this->email = $dataRow['email'];
                $this->password = $dataRow['password'];
                $this->timestamp = $dataRow['timestamp'];
            }
           
        }        


        // LOGIN
        public function loginUser(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            password = ?
                        AND
                            email = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->password);

            $stmt->bindParam(2, $this->email);

            $stmt->execute();

           if ($dataRow = $stmt->fetch(PDO::FETCH_ASSOC)) 
           {
               $this->u_id = $dataRow['u_id'];
               $this->name = $dataRow['name'];
               $this->phone = $dataRow['phone'];
               $this->email = $dataRow['email'];
               $this->password = $dataRow['password'];
               $this->timestamp = $dataRow['timestamp'];
           }
           
           
        }        


        //check record
        public function getCheckSingleUser(){
            $sqlQuery = "SELECT
                            *
                        FROM
                            ". $this->db_table ."
                        WHERE 
                            email = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->email);

            $stmt->execute();

            if($dataRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->u_id = $dataRow['u_id'];
                $this->name = $dataRow['name'];
                $this->phone = $dataRow['phone'];
                $this->email = $dataRow['email'];
                $this->password = $dataRow['password'];
                $this->timestamp = $dataRow['timestamp'];
            }
            
           
        }        

        // UPDATE
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name,
                        phone = :phone,  
                        email = :email, 
                        password = :password, 
                        timestamp = :timestamp
                    WHERE 
                        u_id = :u_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->u_id=htmlspecialchars(strip_tags($this->u_id));
            
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":u_id", $this->u_id);
            $stmt->bindParam(":timestamp", $this->timestamp);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE u_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->u_id=htmlspecialchars(strip_tags($this->u_id));
        
            $stmt->bindParam(1, $this->u_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

