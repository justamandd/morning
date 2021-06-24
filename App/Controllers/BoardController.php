<?php

    namespace App\Controllers;

    use App\Models\Board;

    class BoardController{

    public static function saveBoard(){
        try {
            $board = new Board();

            if(isset($_REQUEST['id'])){ $board->setId($_REQUEST['id']); }
            $board->setName($_REQUEST['name']);
            $board->setDescription($_REQUEST['description']);
            $board->setFk_teamId((int)$_REQUEST['id_team']);

            if($board->save()){
                return true;
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public static function listBoardsTeam($id){
        try {
            $board = new Board();

            return $board->listBoards($id); 
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