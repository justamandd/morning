<?php

    namespace App\Controllers;

    use App\Models\Board;

    class BoardController{

    public function saveBoard(){
        try {
            $board = new Board();

            $board->setId($_POST['id']);
            $board->setName($_POST['name']);
            $board->setDescription($_POST['description']);
            $board->setFk_teamId($_REQUEST['id_team']);

            if($board->save()){
                return true;
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function listBoardsTeam($id){
        try {
            $board = new Board();
            $board->setFk_teamId($id);

            return $board->listBoardsByTeams(); 
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function removeBoard(){
        try {
            $board = new Board();
            return $board->remove($_POST['id']);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function findBoard(){
        try {
            $board = new Board();
            return $board->find($_POST['id']);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    

}