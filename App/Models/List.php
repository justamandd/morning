<?php

    namespace App\Models;

    class Lista
    {
        private static $table = 'list';

        private $id;
        private $name;
        private $fk_boardId;
        private $l_order;

        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if ($data["id"] != "") {
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
                } catch (PDOException $err ) {
                    echo 'ERRO: '.$e->getMessage();
                }
            } else {
                try {
                    $query = "INSERT INTO ".self::$table." (id, name, fk_boardId) VALUES (NULL, :name, :fk)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':fk', $data['id_board']);
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
                    return $stmt->fetchObject(Lista::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function listListsBy(int $id_board)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM".self::$table." WHERE fk_boardId = :fk";
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

        public static function changeOrderV(int $old, int $new)
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

        public function getFk_boardId()
        {
            return $this->fk_boardId;
        }

        public function getL_order()
        {
            return $this->l_order;
        }
    }