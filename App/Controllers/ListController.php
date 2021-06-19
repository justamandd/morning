<?php

    namespace App\Controllers;

    use App\Models\Lista;

    class ListController{

        public function saveList(){
            try{
                $lista = new Lista();

                $lista->setId($_POST['id']);
                $lista->setName($_POST['name']);
                $lista->setfk_boardId('fk_boardId');
                $lista->setl_order('l_order');

                return $lista->save();
            } catch(PDOException $e){
                echo $e;
            }
        }

        public function removeList(){
            try{
                $lista = new Lista();
                return $lista->remove($id);
            } catch (PDOException $e){
                echo $e;
            }
        }

        public function findList(){
            try{
                $lista = new Lista();
                return $lista->find($_POST['id']);
            } catch (PDOException $e){
                echo $e;
            }
        }

        public function listList(){
            try{
                $lista = new Lista();
                $lista->setIdUser($_SESSION['id']);

                return $lista->listList();
            } catch(PDOException $e){
                echo $e;
            }
        }
    }
?>