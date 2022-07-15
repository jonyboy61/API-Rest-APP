<?php
    class RegistoTrabalho{
        //DB stuff
        private $conn;
        private $table = 'registos_trabalhos';
        private $table2 = 'registos_trabalhos1';

        //Properties

        public $id;
        public $id_cliente;
        public $nome_cliente;
        public $id_tarefa;
        public $nome_tarefa;
        public $id_user;
        public $nome_user;
        public $id_trabalho;
        public $nome_trabalho;
        public $tipo_registo;
        public $img_servico;
        public $nota_servico;
        public $inicio;
        public $fim;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get All Records
        public function read(){
            //Create Query
            $query = 'SELECT c.nome AS nome_cliente,
            t.descricao AS nome_trabalho,
            ta.descricao AS nome_tarefa, 
            u.nome AS nome_user
        FROM '.$this->table.' AS rt 
        LEFT JOIN clientes AS c ON rt.id_cliente=c.id
        LEFT JOIN trabalhos AS t ON rt.id_trabalho=t.id
        LEFT JOIN tarefas AS ta ON rt.id_tarefa=ta.id
        LEFT JOIN users AS u ON rt.id_user=u.id';

       
            //Prepare statements
            $stmt = $this->conn->prepare($query);
            
            //Execute query
            $stmt->execute();
            
            return $stmt;
            //var_dump($stmt);die;
        }

        public function readTrabalhosU(){
            //Create Query
            $query = 'SELECT nome_cliente AS nome_cliente,
            nome_trabalho AS nome_trabalho
        FROM '.$this->table2.' 
        WHERE id_user=?' ;

       
            //Prepare statements
            $stmt = $this->conn->prepare($query);

            //var_dump($stmt);die;
            //Bind ID
            $stmt->bindParam(1, $this->id_user);
            //Execute query
            $stmt->execute();
            
            return $stmt;

        }





       //Get single Record
        public function read_single(){
            $query = 'SELECT c.nome AS nome_cliente, 
        t.descricao AS nome_trabalho, 
        ta.descricao AS nome_tarefa, 
        u.nome AS nome_user
    FROM registos_trabalhos AS rt 
    LEFT JOIN clientes AS c ON rt.id_cliente=c.id
    LEFT JOIN trabalhos AS t ON rt.id_trabalho=t.id
    LEFT JOIN tarefas AS ta ON rt.id_tarefa=ta.id
    LEFT JOIN users AS u ON rt.id_user=u.id
        WHERE rt.id=? 
        LIMIT 0,1';

         //Prepare statement
         $stmt = $this->conn->prepare($query);

         //Bind Id
         $stmt->bindParam(1, $this->id);

         //Execute query
         $stmt->execute();


         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //Set properties
         $this->nome_cliente = $row['nome_cliente'];
         $this->nome_tarefa = $row['nome_tarefa'];
         $this->nome_user = $row['nome_user'];
         $this->nome_trabalho = $row['nome_trabalho'];
    }


        //Create Post
        public function create(){
            // Create query
            $query = 'INSERT INTO  
                '.$this->table2.' 
              SET 
                nome_cliente = :nome_cliente,
                nome_tarefa = :nome_tarefa,
                id_user = :id_user,
                nome_trabalho = :nome_trabalho,
                inicio = :inicio';

                

               //Prepare statement
               $stmt = $this->conn->prepare($query);

               //Clean data
               $this->nome_cliente = htmlspecialchars(strip_tags($this->nome_cliente));
               $this->nome_tarefa = htmlspecialchars(strip_tags($this->nome_tarefa));
               $this->id_user = htmlspecialchars(strip_tags($this->id_user));
               $this->nome_trabalho = htmlspecialchars(strip_tags($this->nome_trabalho));
               $this->inicio = htmlspecialchars(strip_tags($this->inicio));

               //Bind data
               $stmt->bindParam(':nome_cliente', $this->nome_cliente);
               $stmt->bindParam(':nome_tarefa', $this->nome_tarefa);
               $stmt->bindParam(':id_user', $this->id_user);
               $stmt->bindParam(':nome_trabalho', $this->nome_trabalho);
               $stmt->bindParam(':inicio', $this->inicio);

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