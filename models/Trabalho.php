<?php
    class Trabalho{
        //DB stuff
        private $conn;
        private $table = 'trabalhos';

        //Properties

        public $id;
        public $descricao;

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
                '.$this->table .'' ;

            //Prepare statements
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        //Get single Post
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
         $this->descricao = $row['descricao'];
    }


        //Create Post
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . 
            $this->table .'
              SET 
                descricao = :descricao';
                

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->descricao = htmlspecialchars(strip_tags($this->descricao));
               
               //Bind data
               $stmt->bindParam(':descricao', $this->descricao);

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
            SET descricao = :descricao
            WHERE id = :id';

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->descricao = htmlspecialchars(strip_tags($this->descricao));
               $this->id = htmlspecialchars(strip_tags($this->id));


               //Bind data
               $stmt->bindParam(':descricao', $this->descricao);
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