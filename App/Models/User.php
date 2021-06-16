<?php

    namespace App\Models;

    class User
    {
        private static $table = "user";

        private $id;
        private $name;
        private $email;
        private $password;
        private $type;

        //recebe um objeto com os dados necessários
        public static function save($data)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if($data["id"] != "")
            {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name, email = :email, password = :password, type = :type where id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', $data['id']);
                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':email', $data['email']);
                    $stmt->bindValue(':password', $data['password']);
                    $stmt->bindValue(':type', $data['type']);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return '';
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
                    $query = "INSERT INTO ".self::$table." VALUES (NULL, :name, :email, :user, md5(:password), :type)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $data['name']);
                    $stmt->bindValue(':email', $data['email']);
                    $stmt->bindValue(':password', $data['password']);
                    $stmt->bindValue(':type', $data['type']);
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

        //criar um trigger para excluir todos os dados
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
                    return $stmt->fetchObject(User::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function selectAll(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM ". self::$table;
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function authenticate($email, $password)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            $query = 'SELECT * FROM '.self::$table.' WHERE email = :email AND password = md5(:password)';
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $stmt->fetchObject(User::class);
            }else{
                return false; 
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
        public function getEmail()
        {
            return $this->email;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getType()
        {
            return $this->type;
        }
    }