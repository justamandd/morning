<?php

    namespace App\Models;

    class Checklist
    {
        private static $table = 'task';

        private $id;
        private $name;
        private $finished;
        private $fk_checkListId;
        private $t_order;

        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if($data["id"] != "")
            {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name, finished = :fin WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', $data['id']);
                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':fin', $data['finished']);
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
                    $query = "INSERT INTO ".self::$table." (id, name, finished, fk_checkListId) VALUES (NULL, :name, 0,:fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':fk', $data['id_checklist']);
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
                    return $stmt->fetchObject(Task::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function listTaskBy(int $id_checklist)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM".self::$table." WHERE fk_cardId = :fk";
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

        public static function changeOrderV(int $old, int $new)
        {

        }
    }