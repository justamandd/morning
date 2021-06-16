<?php

    namespace App\Models;

    class Card
    {
        private static $table = 'list';

        private $id;
        private $name;
        private $description;
        private $dtDelivery;
        private $fk_listId;
        private $c_order;

        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if($data["id"] != "")
            {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name, description = :description, dtDelivery = :dtDelivery, fk_listId = :fk_listId where id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', $data['id']);
                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':description', $data['description']);
                    $stmt->bindValue(':dtDelivery', $data['dtDelivery']);
                    $stmt->bindValue(':fk_listId', $data['fk_listId']);
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
                    $query = "INSERT INTO ".self::$table." (id, name, description, fk_listId) VALUES (NULL, :name, :description, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':description', $data['description']);
                    $stmt->bindValue(':fk', $data['fk']);
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
                    return $stmt->fetchObject(Card::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function listCardsBy(int $id_list)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM".self::$table." WHERE fk_listId = :fk";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk', $id_list);
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

        public static function changeOrderV(int $old, int $new)
        {

        }

        public static function changeOrderH(int $old, int $new, int $id_list)
        {

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
        public function getDtDelivery()
        {
                return $this->dtDelivery;
        }
        public function getFk_listId()
        {
                return $this->fk_listId;
        }
        public function getC_order()
        {
                return $this->c_order;
        }
    }