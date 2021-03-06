<?php

namespace App\Models;

class Team
{

    private $id;
    private $name;
    private $description;
    private $id_user;

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

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function save()
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        if ($this->id > 0) {
            try {
                $query = "UPDATE team SET name = :name, description = :desc WHERE id = :id_team";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':id_team', $this->id);
                $stmt->bindValue(':name', $this->name);
                $stmt->bindValue(':desc', $this->description);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo 'ERRO: ' . $e->getMessage();
            }
        } else {
            try {
                $query = "INSERT INTO team VALUES (NULL, :name, :desc, :id_user)";
                $stmt = $conn->prepare($query);

                $stmt->bindValue(':name', $this->name);
                $stmt->bindValue(':desc', $this->description);
                $stmt->bindValue(':id_user', $this->id_user);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    /*
                    if ($email != null) {
                        try {
                            $query = "SELECT id FROM team WHERE fk_userId = :id_user ORDER BY id DESC LIMIT 1";
                            $stmt = $conn->prepare($query);

                            $stmt->bindValue(':id_user', $this->id_user);
                            $stmt->execute();

                            if ($stmt->rowCount() > 0) {
                                return $stmt->fetch(\PDO::FETCH_ASSOC);
                            } else {
                                return false;
                            }
                        } catch (PDOException $err) {
                            echo 'Erro: ' . $e->getMessage();
                        }
                    } else {
                        return true;
                    }*/
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo 'Erro: ' . $e->getMessage();
            }
        }
    }

    public function remove($id)
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        try {
            $query = "DELETE FROM team WHERE id = :id_team";
            $stmt = $conn->prepare($query);

            $stmt->bindValue(':id_team', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'ERRO: ' . $e->getMessage();
        }
    }

    public function select(int $id)
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        try {
            $query = "SELECT * FROM team WHERE id = :id_team";
            $stmt->bindValue(':id_team', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchObject(Team::class);
            } else {
                return false;
            }
        } catch (PDOException $err) {
            return "Erro: " . $err->getMessage();
        }
    }

    public function selectBy()
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        try {
            $query = "SELECT * FROM team WHERE fk_userId = :id_user";
            $stmt = $conn->prepare($query);

            $stmt->bindValue(':id_user', $this->id_user);
            $stmt->execute();

            $result = array();

            if ($stmt->rowCount() > 0) {
                while ($rs = $stmt->fetchObject(Team::class)) {
                    $result[] = $rs;
                }
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function addEmail(int $id_team, $email)
    {
        $conn = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        try {
            $query = "INSERT INTO email VALUES(NULL, :email, :id_team)";
            $stmt = $conn->prepare($query);

            $stmt->bindValue(':email', $this->emaill);
            $stmt->bindValue(':id_team', $this->id_team);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $err) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
}
