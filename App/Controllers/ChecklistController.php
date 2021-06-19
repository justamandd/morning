<?php

    namespace App\Controllers;

    use App\Models\Checklist;

    class ChecklistController{

        public function saveChecklist(){
            try{
                $checklist = new Checklist();

                $checklist->setId($_POST['id']);
                $checklist->setName($_POST['name']);
                $checklist->setfk_cardId($_POST['fk_cardId']);
                $checklist->setCh_order($_POST['ch_order']);

                return $checklist->save();
            } catch(PDOException $e){
                echo $e;
            }
        }

        public function removeChecklist($id){
            try{
                $checklist = new Checklist();
                return $checklist->find($_POST['id']);
            } catch(PDOException $e){
                echo $e;
            }
        }

        public function listChecklist(){
            try{
                $checklist = new Checklist();
                $checklist->setIdUser($_SESSION['id']);

                return $checklist->listChecklists();
            } catch (PDOException $e){
                echo $e;
            }
        }

        public function findChecklist(){
            try{
                $checklist = new Checklist();
                return $checklist->find($_POST['id']);
            } catch (PDOException $e){
                echo $e;
            }
        }
    }
?>