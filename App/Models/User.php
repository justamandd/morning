<?php

    namespace App\Models;

    //require_once './connection.php';

    class User{
        
        private $id;
        private $name;
        private $email;
        private $password;
        private $type;
        
        public function save()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if(getId() > 0)
            {
                try {
                    $query = "UPDATE user SET name = :name, email = :email, password = :password, type = :type where id = :id";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id', getId());
                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':email', getEmail());
                    $stmt->bindValue(':password', getPassword());

                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $e) {
                    echo 'ERRO: '.$e->getMessage();
                }
            }
            else
            {
                try {
                    $query = "INSERT INTO user VALUES (NULL, :name, :email, :user, md5(:password), :type)";
                    $stmt = $conn->prepare($query);
        
                    $stmt->bindValue(':name', getName());
                    $stmt->bindValue(':email', getEmail());
                    $stmt->bindValue(':password', getPassword());
                    $stmt->bindValue(':type', getType());
                    $stmt->execute();
        
                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $e) {
                    echo 'ERRO: '.$e->getMessage();
                }
            }
        }

        public function remove(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "DELETE * FROM user WHERE id = :id";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false; 
                }
            } catch (PDOExcepion $e) {
                echo 'ERRO: '.$e->getMessage();
            }
        }

        public function select(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);
            
            try {
                $query = "SELECT * FROM user WHERE id = :id";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(User::class);
                }else{
                    return false; 
                }
            } catch (PDOExcepion $err) {
                echo 'ERRO: '.$err->getMessage();
            }
        }
        
        public function listUsers()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM user";
                $stmt = $conn->prepare($query);

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

        public function auth()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM user WHERE user = :username AND password = md5(:password)";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':email', getEmail());
                $stmt->bindValue(':password', getPassword());
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(User::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                echo 'ERRO: '.$err->getMessage();
            }
        }

        /*
        public function listAll()
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);
            try {
                $query = "SELECT * FROM user";
                $stmt = $conn->prepare($query);
                
                $result = array();

                if($stmt->execute()){
                    while ($rs = $stmt->fetchObject(User::class)) {
                        $result[] = $rs;
                    }
                }else{
                    $result = false;
                }
                return $result; 
            } catch (PDOExcepion $e) {
                echo 'ERRO: '.$e->getMessage();
            }
        } 
        */
        
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
        public function getEmail()
        {
            return $this->email;
        } 
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password)
        {
            $this->password = md5($password);
        }
        public function getType()
        {
            return $this->type;
        }
        public function setType($type)
        {
            $this->type = $type;
        }
    }
