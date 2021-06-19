<?php

    namespace App\Models;

    class Board
    {
        private static $table = 'board';

        private $id;
        private $name;
        private $description;
        private $fk_teamId;

        public function save()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0){
                try {
                    $query = "UPDATE board SET name = :name, description = :desc WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':description', getDescription());
                    $stmt->execute();

                    if($stmt->rowCount() > 0)
                    {
                        return true;
                    }else{
                        return false;
                    }
                } catch (PDOException $err) {
                    echo 'ERRO: '.$err->getMessage();
                }
                if($result > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                try {
                    $query = "INSERT INTO board VALUES (NULL, :name, :desc, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':description', getDescription());
                    $stmt->bindValue(':fk', getId_team());
                    $stmt->execute();

                    if($stmt->rowCount() > 0)
                    {
                        return true;
                    }else{
                        return false;
                    }
                } catch (PDOException $err) {
                    echo 'ERRO: '.$e->getMessage();
                }
            }
        }

        public function delete(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try 
            {
                $query = "DELETE FROM board WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0)
                {
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $err) 
            {
                echo 'ERRO: '.$err->getMessage();
            }
        }

        public function select(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM board WHERE id = :id";
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Board::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public function listBoards(int $id_team)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM board WHERE fk_teamId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_team);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return false; 
                }
            } catch (PDOException $e) {
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
        public function getDescription()
        {
            return $this->description;
        }
        public function setDescription($description)
        {
            $this->description = $description;
        }
        public function getFk_teamId()
        {
            return $this->fk_teamId;
        }
        public function setFk_teamId($fk_teamId)
        {
            $this->fk_teamId = $fk_teamId;
        }
}