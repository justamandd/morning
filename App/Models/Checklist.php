<?php

    namespace App\Models;

    class Checklist
    {
        private $id;
        private $name;
        private $fk_cardId;
        private $ch_order;

        public function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0)
            {
                try {
                    $query = "UPDATE checklist SET name = :name WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
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
                    $query = "INSERT INTO checklist (id, name, fk_cardId) VALUES (NULL, :name, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', getName());
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
                $query = "DELETE FROM checklist WHERE id = :id";
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
                $query = "SELECT * FROM checklist WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Checklist::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function listChecklistBy(int $id_card)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try 
            {
                $query = "SELECT * FROM checklist WHERE fk_cardId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_card);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Checklist::class);
                }else{
                    return false; 
                }
            } 
            catch (PDOException $e) 
            {
                echo 'ERRO: '.$e->getMessage();
            }
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
        public function getFk_cardId()
        {
            return $this->fk_cardId;
        }
        public function setFk_cardId($fk_cardId)
        {
            $this->fk_cardId = $fk_cardId;
        }
        public function getCh_order()
        {
            return $this->ch_order;
        }
        public function setCh_order($ch_order)
        {
            $this->ch_order = $ch_order;
        }
    }