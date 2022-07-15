<?php
    class Material{
        //DB stuff
        private $conn;
        private $table = 'material';

        //Properties

        public $id;
        public $nome;
        public $serialno;
        public $preco;
        public $quantidade;

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
         $this->nome = $row['nome'];
         $this->serialno = $row['serialno'];
         $this->preco = $row['preco'];
         $this->quantidade = $row['quantidade'];
    }


        //Create Post
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . 
            $this->table .'
              SET 
                nome = :nome,
                serialno = :serialno,
                preco = :preco,
                quantidade = :quantidade';
                

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->serialno = htmlspecialchars(strip_tags($this->serialno));
               $this->preco = htmlspecialchars(strip_tags($this->preco));
               $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));

               //Bind data
               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':serialno', $this->serialno);
               $stmt->bindParam(':preco', $this->preco);
               $stmt->bindParam(':quantidade', $this->quantidade);

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
             serialno = :serialno,
              preco = :preco,
              quantidade = :quantidade
            WHERE id = :id';

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->serialno = htmlspecialchars(strip_tags($this->serialno));
               $this->preco = htmlspecialchars(strip_tags($this->preco));
               $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
               $this->id = htmlspecialchars(strip_tags($this->id));


               //Bind data
               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':serialno', $this->serialno);
               $stmt->bindParam(':preco', $this->preco);
               $stmt->bindParam(':quantidade', $this->quantidade);
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