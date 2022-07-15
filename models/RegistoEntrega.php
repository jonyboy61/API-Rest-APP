<?php
    class RegistoEntrega{
        //DB stuff
        private $conn;
        private $table = 'registos_entregas';
        private $table1 = 'registo_entregas_material';
        private $table2 = 'registo_entregas_equipamento';

        //Properties

        public $id;
        public $id_cliente;
        public $nome_cliente;
        public $id_user;
        public $id_material;
        public $nome_material;
        public $id_equipamento;
        public $nome_equipamento;
        public $nota_servico;
        public $serial_no;
        public $inicio;
        public $fim;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get All Records
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

       //Get single Record
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
         $this->id_user = $row['id_user'];
         $this->id_cliente = $row['id_cliente'];
         $this->id_material = $row['id_material'];
         $this->id_equipamento = $row['id_equipamento'];
         $this->nota_servico = $row['nota_servico'];
    }


        //Create Post
        public function create_material(){
            // Create query
            $query = 'INSERT INTO '. 
            $this->table1.'
              SET 
                nome_cliente = :nome_cliente,
                id_user = :id_user,
                nome_material = :nome_material,
                serial_no = :serial_no,
                inicio = :inicio';

                

               //Prepare statement
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome_cliente = htmlspecialchars(strip_tags($this->nome_cliente));
               $this->id_user = htmlspecialchars(strip_tags($this->id_user));
               $this->nome_material = htmlspecialchars(strip_tags($this->nome_material));
               $this->serial_no = htmlspecialchars(strip_tags($this->serial_no));
               $this->inicio = htmlspecialchars(strip_tags($this->inicio));

               //Bind data
               $stmt->bindParam(':nome_cliente', $this->nome_cliente);
               $stmt->bindParam(':id_user', $this->id_user);
               $stmt->bindParam(':nome_material', $this->nome_material);
               $stmt->bindParam(':serial_no', $this->serial_no);
               $stmt->bindParam(':inicio', $this->inicio);

               //Execute query
               if($stmt->execute()){
                return true;
               }

               //Print error if something goes wrong
               printf("Error: %s.\n", $stmt->error);


               return false;
        }

        public function create_equipamento(){
            // Create query
            $query = 'INSERT INTO '. 
            $this->table2.'
              SET 
                nome_cliente = :nome_cliente,
                id_user = :id_user,
                nome_equipamento = :nome_equipamento,
                serial_no = :serial_no';

                

               //Prepare statement
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome_cliente = htmlspecialchars(strip_tags($this->nome_cliente));
               $this->id_user = htmlspecialchars(strip_tags($this->id_user));
               $this->nome_equipamento = htmlspecialchars(strip_tags($this->nome_equipamento));
               $this->serial_no = htmlspecialchars(strip_tags($this->serial_no));

               //Bind data
               $stmt->bindParam(':nome_cliente', $this->nome_cliente);
               $stmt->bindParam(':id_user', $this->id_user);
               $stmt->bindParam(':nome_equipamento', $this->nome_equipamento);
               $stmt->bindParam(':serial_no', $this->serial_no);

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
            SET id_cliente = :id_cliente,
              id_tarefa = :id_tarefa,
              id_user = :id_user,
              id_trabalho = :id_trabalho,
              tipo_registo = :tipo_registo,
              img_servico = :img_servico,
              nota_servico = :nota_servico
            WHERE id = :id';

               //Prepare stateent
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
               $this->id_tarefa = htmlspecialchars(strip_tags($this->id_tarefa));
               $this->id_user = htmlspecialchars(strip_tags($this->id_user));
               $this->id_trabalho = htmlspecialchars(strip_tags($this->id_trabalho));
               $this->tipo_registo = htmlspecialchars(strip_tags($this->tipo_registo));
               $this->img_servico = htmlspecialchars(strip_tags($this->img_servico));
               $this->nota_servico = htmlspecialchars(strip_tags($this->nota_servico));
               $this->id = htmlspecialchars(strip_tags($this->id));


               //Bind data
               $stmt->bindParam(':id_cliente', $this->id_cliente);
               $stmt->bindParam(':id_tarefa', $this->id_tarefa);
               $stmt->bindParam(':id_user', $this->id_user);
               $stmt->bindParam(':id_trabalho', $this->id_trabalho);
               $stmt->bindParam(':tipo_registo', $this->tipo_registo);
               $stmt->bindParam(':img_servico', $this->img_servico);
               $stmt->bindParam(':nota_servico', $this->nota_servico);

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