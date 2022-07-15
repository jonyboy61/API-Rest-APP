<?php
    class Cliente{
        //DB stuff
        private $conn;
        private $table = 'clientes';

        //Properties

        public $id;
        public $nome;
        public $morada;
        public $telefone;
        public $email;
        public $nif;
        public $cod_postal;
        public $latitude;
        public $longitude;

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
                '.$this->table ;

            //Prepare statements
            $stmt = $this->conn->prepare($query);

            //Execute query
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
             $this->morada = $row['morada'];
             $this->telefone = $row['telefone'];
             $this->email = $row['email'];
             $this->nif = $row['nif'];
             $this->cod_postal = $row['cod_postal'];
             $this->latitude = $row['latitude'];
             $this->longitude = $row['longitude'];
        }

        //Create Post
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . 
            $this->table .'
              SET 
                nome = :nome,
                morada = :morada,
                telefone = :telefone,
                email = :email,
                nif = :nif,
                cod_postal = :cod_postal,
                latitude = :latitude,
                longitude = :longitude';
                

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->morada = htmlspecialchars(strip_tags($this->morada));
               $this->telefone = htmlspecialchars(strip_tags($this->telefone));
               $this->email = htmlspecialchars(strip_tags($this->email));
               $this->nif = htmlspecialchars(strip_tags($this->nif));
               $this->cod_postal = htmlspecialchars(strip_tags($this->cod_postal));
               $this->latitude = htmlspecialchars(strip_tags($this->latitude));
               $this->longitude = htmlspecialchars(strip_tags($this->longitude));

               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':morada', $this->morada);
               $stmt->bindParam(':telefone', $this->telefone);
               $stmt->bindParam(':email', $this->email);
               $stmt->bindParam(':nif', $this->nif);
               $stmt->bindParam(':cod_postal', $this->cod_postal);
               $stmt->bindParam(':latitude', $this->latitude);
               $stmt->bindParam(':longitude', $this->longitude);

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
             morada = :morada,
             telefone = :telefone,
              email = :email,
              nif = :nif,
              cod_postal = :cod_postal,
              latitude = :latitude,
              longitude = :longitude
            WHERE id = :id';

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome = htmlspecialchars(strip_tags($this->nome));
               $this->morada = htmlspecialchars(strip_tags($this->morada));
               $this->telefone = htmlspecialchars(strip_tags($this->telefone));
               $this->email = htmlspecialchars(strip_tags($this->email));
               $this->nif = htmlspecialchars(strip_tags($this->nif));
               $this->cod_postal = htmlspecialchars(strip_tags($this->cod_postal));
               $this->latitude = htmlspecialchars(strip_tags($this->latitude));
               $this->longitude = htmlspecialchars(strip_tags($this->longitude));
               $this->id = htmlspecialchars(strip_tags($this->id));



               //Bind data
               $stmt->bindParam(':nome', $this->nome);
               $stmt->bindParam(':morada', $this->morada);
               $stmt->bindParam(':telefone', $this->telefone);
               $stmt->bindParam(':email', $this->email);
               $stmt->bindParam(':nif', $this->nif);
               $stmt->bindParam(':cod_postal', $this->cod_postal);
               $stmt->bindParam(':latitude', $this->latitude);
               $stmt->bindParam(':longitude', $this->longitude);
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