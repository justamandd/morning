<?php

    namespace App\Models;

    class Team
    {
        private static $table = "team";
        
        private $id_team;
        private $name;
        private $description;
        private $id_user;


        public static function save($team, $email = "")
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            if($team["id"] != "")
            {
                try {
                    $query = "UPDATE ".self::$table." SET name = :name, description = :desc WHERE id = :id_team";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':id_team', $team['id_team']);
                    $stmt->bindValue(':name', $team['name']);
                    $stmt->bindValue(':desc', $team['description']);
                    $stmt->bindValue(':id_user', $team['id_user']);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        return true;
                    }else{
                        return false; 
                    }
                } catch (PDOException $e) {
                    echo 'Erro: '.$e->getMessage();
                }
            }
            else
            {
                try {
                    $query = "INSERT INTO ".self::$table." VALUES (NULL, :name, :desc, :id_user)";
                    $stmt = $conn->prepare($query);

                    $stmt->bindValue(':name', $team['name']);
                    $stmt->bindValue(':desc', $team['description']);
                    $stmt->bindValue(':id_user', $team['id_user']);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        if($email != null){
                            try {
                                $query = "SELECT id FROM ".self::$table." WHERE fk_userId = :id_user ORDER BY id DESC LIMIT 1";
                                $stmt = $conn->prepare($query);

                                $stmt->bindValue(':id_user', $team['id_user']);
                                $stmt->execute();

                                if($stmt->rowCount() > 0){
                                    return $stmt->fetch(\PDO::FETCH_ASSOC);
                                }else{
                                    return false; 
                                }
                            } catch (PDOException $err) {
                                echo 'Erro: '.$e->getMessage();
                            }
                        }else{
                            return true;
                        }
                    }else{
                        return false; 
                    }
                } catch (PDOException $e) {
                    echo 'Erro: '.$e->getMessage();
                }
            }
        }

        public function remove(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try 
            {
                $query = "DELETE FROM".self::$table."WHERE id = :id_team";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':id_team', $id);
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

        public static function select(int $id)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM ". self::$table ." WHERE id = :id_team";
                $stmt->bindValue(':id_team', $id);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchObject(Team::class);
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                return "Erro: " . $err->getMessage();
            }
        }

        public static function selectBy(int $id_user)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "SELECT * FROM".self::$table." fk_userId = :id_user";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':fk_userId', $id_user);
                $stmt->execute();

                $result = array();

                if($stmt->rowCount() > 0){
                    while($rs = $stmt->fetchObject(Board::class))
                    {
                        $result[] = $rs;
                    }
                    return $result;
                }else{
                    return false; 
                }
            } catch (PDOException $e) {
                echo 'Erro: '.$e->getMessage();
            }

        }

        public static function addEmail(int $id_team, $email)
        {
            $conn = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            try {
                $query = "INSERT INTO email VALUES (NULL, :email, :id_team)";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':id_team', $id_team);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false; 
                }
            } catch (PDOException $err) {
                echo 'Erro: '.$e->getMessage();
            }
        }

        public function getId()
        {
            return $this->id_team;
        }
        public function getName()
        {
            return $this->name;
        }
        public function getDescription()
        {
            return $this->description;
        }
        public function getIdUser()
        {
            return $this->id_user;
        }

}