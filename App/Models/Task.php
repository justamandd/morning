<?php

    namespace App\Models;

    class Task
    {
        private static $table = 'task';

        private $id;
        private $name;
        private $finished;
        private $fk_checkListId;
        private $t_order;

        public function save()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0)
            {
                try {
                    $query = "UPDATE task SET name = :name, finished = :fin WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':fin', getFinished());
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
                    $query = "INSERT INTO task (id, name, finished, fk_checkListId) VALUES (NULL, :name, 0,:fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':fk', getId_checklist());
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
                $query = "DELETE FROM task WHERE id = :id";
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
                $query = "SELECT * FROM task WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Task::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function listTaskBy(int $id_checklist)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM task WHERE fk_cardId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_checklist);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Task::class);
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
        public function getFinished()
        {
            return $this->finished;
        }
        public function setFinished($finished)
        {
            $this->finished = $finished;
        }
        public function getFk_checkListId()
        {
            return $this->fk_checkListId;
        }
        public function setFk_checkListId($fk_checkListId)
        {
            $this->fk_checkListId = $fk_checkListId;
        }
        public function getT_order()
        {
            return $this->t_order;
        } 
        public function setT_order($t_order)
        {
            $this->t_order = $t_order;
        }
    }