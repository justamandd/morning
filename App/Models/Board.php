<?php

    namespace App\Models;

    class Board
    {
        private static $table = 'board';

        private $id;
        private $name;
        private $description;
        private $fk_teamId;

        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if ($data["id"] != "") {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name, description = :desc WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', $data['id']);
                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':description', $data['description']);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $err ) {
                    echo 'ERRO: '.$e->getMessage();
                }
            } else {
                try {
                    $query = "INSERT INTO ".self::$table." VALUES (NULL, :name, :desc, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':description', $data['description']);
                    $stmt->bindValue(':fk', $data['id_team']);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch  (PDOException $err ) {
                    echo 'ERRO: '.$e->getMessage();
                }
            }
        }

        public static function delete(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "DELETE FROM ". self::$table ." WHERE id = :id";
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

        public static function select(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM ". self::$table ." WHERE id = :id";
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

        public static function listBoards(int $id_team)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM".self::$table." WHERE fk_teamId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_team);
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

        public function getId()
        {
            return $this->id;
        } 
        public function getName()
        {
            return $this->name;
        }
        public function getDescription()
        {
            return $this->description;
        }
        public function getTeamId()
        {
            return $this->fk_teamId;
        }

    }