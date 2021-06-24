<?php

namespace App\Controllers;

use App\Models\Team;

class TeamController
{

    public static function saveTeam($team)
    {
        try {
            $t = new Team();

            $t->setId($team->getId());
            $t->setName($team->getName());
            $t->setDescription($team->getDescription());
            $t->setIdUser($team->getIdUser());

            return $t->save();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public static function listTeamsUser()
    {
        try {
            $team = new Team();
            $team->setIdUser((int)$_SESSION['id']);

            return $team->selectBy();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public static function removeTeam($id)
    {
        try {
            $team = new Team();
            return $team->remove($id);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public static function findTeam($id)
    {
        try {
            $team = new Team();
            return $team->select($id);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
