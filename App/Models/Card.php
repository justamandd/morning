<?php

    namespace App\Models;

    class Card
    {
        private $id;
        private $name;
        private $description;
        private $dtDelivery;
        private $fk_listId;
        private $c_order;

        public function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0)
            {
                try {
                    $query = "UPDATE card SET name = :name, description = :description, dtDelivery = :dtDelivery, fk_listId = :fk_listId where id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':description', getDescription());
                    $stmt->bindValue(':dtDelivery', getDtDelivery());
                    $stmt->bindValue(':fk_listId', getFk_listId());
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $err) {
                    echo "Erro: " . $err->getMessage();
                }
            }
            else
            {
                try {
                    $query = "INSERT INTO card (id, name, description, fk_listId) VALUES (NULL, :name, :description, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':description', getDescription());
                    $stmt->bindValue(':fk', getFk());
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $err) {
                    echo "Erro: " . $err->getMessage();
                }
            }
        }

        public function delete(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "DELETE FROM card WHERE id = :id";
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
                $query = "SELECT * FROM card WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Card::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function listCardsBy(int $id_list)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM card WHERE fk_listId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', getFk());
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Lista::class);
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

        public function changeOrderH(int $old, int $new, int $id_list)
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
        public function getDescription()
        {
            return $this->description;
        }
        public function setDescription($description)
        {
            $this->description = $description;
        }
        public function getDtDelivery()
        {
            return $this->dtDelivery;
        }
        public function setDtDelivery($dtDelivery)
        {
            $this->dtDelivery = $dtDelivery;
        }
        public function getFk_listId()
        {
            return $this->fk_listId;
        }
        public function setFk_listId($fk_listId)
        {
            $this->fk_listId = $fk_listId;
        }
        public function getC_order()
        {
            return $this->c_order;
        }
        public function setC_order($c_order)
        {
            $this->c_order = $c_order;
        }
    }
?>