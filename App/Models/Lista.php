<?php

    namespace App\Models;

    class Lista
    {
        private $id;
        private $name;
        private $fk_boardId;
        private $l_order;

        public function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0){
                try{
                    $query = "UPDATE list SET name = :name WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false;
                    }
                } catch (PDOException $err ){
                  echo 'ERRO: '.$e->getMessage();            
                }
            } else {
                try {
                    $query = "INSERT INTO list (id, name, fk_boardId) VALUES (NULL, :name, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':fk', getFk());
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                }catch( PDOException $err ){
                    echo 'ERRO: '.$e->getMessage();
                }
            }

        }

        public function delete(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "DELETE FROM list WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function select(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM list WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Lista::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function listListsBy(int $id_board)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM list WHERE fk_boardId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_board);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Board::class);
                }else{
                    return false; 
                }
            } catch (PDOException $e) {
                echo 'ERRO: '.$e->getMessage();
            }
        }

        public function changeOrderV(int $old, int $new)
        {

        }
        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getName()
        {
            return $this->name;
        }
        public function setName($name)
        {
            $this->name = $name;
        }
        public function getFk_boardId()
        {
            return $this->fk_boardId;
        }
        public function setFk_boardId($fk_boardId)
        {
            $this->fk_boardId = $fk_boardId;
        }
        public function getL_order()
        {
            return $this->l_order;
        }
        public function setL_order($l_order)
        {
            $this->l_order = $l_order;
        }
    }
?>