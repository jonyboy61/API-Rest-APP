<?php
    class User{
        //DB stuff
        private $conn;
        private $table = 'users';

        //Properties

        public int $id;
        public $nome;
        public $username;
        public $email;
        public $password;
        public $created_at;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get Posts
        public function read(){
            //Create Query
            $query = 'SELECT
               *
            FROM 
                '.$this->table.' 
                  ORDER BY
                   created_at DESC';

            //Prepare statements
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        public function login(){
            $query = "SELECT id, username, password, email, nome FROM ".$this->table." WHERE username='".$this->username."' AND password='".$this->password."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }



        //Get single Post
        public function read_single(){
            $query = 'SELECT *
        FROM 
            '.$this->table.'
             WHERE id = ?
             LIMIT 0,1';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

             //Bind Id
             $stmt->bindParam(1, $this->id);

             //Execute query
             $stmt->execute();

             $row = $stmt->fetch(PDO::FETCH_ASSOC);

             //Set properties
             $this->nome = $row['nome'];
             $this->username = $row['username'];
             $this->email = $row['email'];
             $this->password = $row['password'];
        }

        //Create Post
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . 
            $this->table .'
              SET 
                nome = :nome,
                username = :username,
                email = :email,
                password = :password';
                

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->username = htmlspecialchars(strip_tags($this->username));
               $this->email = htmlspecialchars(strip_tags($this->email));
               $this->password = htmlspecialchars(strip_tags($this->password));

               //Bind data
               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':username', $this->username);
               $stmt->bindParam(':email', $this->email);
               $stmt->bindParam(':password', $this->password);

               //Execute query
               if($stmt->execute()){
                return true;
               }

               //Print error if something goes wrong
               printf("Error: %s.\n", $stmt->error);


               return false;
        }

        //Update Post
        public function update(){
            // Create query
            $query = 'UPDATE ' . 
            $this->table .'
            SET nome = :nome,
             username = :username,
              email = :email,
               password = :password WHERE id = :id';

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->username = htmlspecialchars(strip_tags($this->username));
               $this->email = htmlspecialchars(strip_tags($this->email));
               $this->password = htmlspecialchars(strip_tags($this->password));
               $this->id = htmlspecialchars(strip_tags($this->id));



               //Bind data
               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':username', $this->username);
               $stmt->bindParam(':email', $this->email);
               $stmt->bindParam(':password', $this->password);
               $stmt->bindParam(':id', $this->id);

               //Execute query
               if($stmt->execute()){
                return true;
               }

               //Print error if something goes wrong
               printf("Error: %s.\n", $stmt->error);


               return false;
        }

        //Delete Post
        public function delete(){
            //Create Query
            $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
?>