<?php

    namespace App\Controllers;

    use App\Models\Task;

    class TaskController{

    public function saveTask(){
        try {
            $task = new Task();

            $task->setId($_POST['id']);
            $task->setName($_POST['name']);
            $task->setFinished($_POST['finished']);
            $task->setFk_checkListId($_REQUEST['fk_checkListId']);
            $task->setT_order($_POST['t_order']);

            if($task->save()){
                return true;
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function listTask($id){
        try {
            $task = new Task();
            $task->setFk_teamId($id);

            return $task->listTaskBy(); 
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function removeTask(){
        try {
            $task = new Task();
            return $task->remove($_POST['id']);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function findTask(){
        try {
            $task = new Task();
            return $task->find($_POST['id']);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    

}