<?php

    namespace App\Models;

    class Checklist
    {
        private static $table = 'checklist';

        private $id;
        private $name;
        private $fk_cardId;
        private $ch_order;

        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if($data["id"] != "")
            {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name WHERE id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', $data['id']);
                    $stmt->bindValue(':name', $data['name']);
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
                    $query = "INSERT INTO ".self::$table." (id, name, fk_cardId) VALUES (NULL, :name, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':fk', $data['id_card']);
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
                    return $stmt->fetchObject(Checklist::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function listChecklistBy(int $id_card)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try 
            {
                $query = "SELECT * FROM".self::$table." WHERE fk_cardId = :fk";
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
        public function getName()
        {
            return $this->name;
        }
        public function getFk_cardId()
        {
            return $this->fk_cardId;
        }
        public function getCh_order()
        {
            return $this->ch_order;
        }
    }