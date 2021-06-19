<?php

    namespace App\Controllers;

    use App\Models\Card;

    class CardController{

        public function saveCard(){
            try{
                $card = new Card();

                $card->setId($_POST['id']);
                $card->setName($_POST['name']);
                $card->setDescription($_POST['description']);
                $card->setDtDelivery($_POST['dtDelivery']);
                $card->setfk_listId($_POST['fk_listId']);
                $card->getC_order($_POST['c_order']);

                return $card->save();
            } catch(PDOException $e){
                echo $e;
            }
        }

        public function removeCard($id){
            try{
                $card = new Card();
                return $card->remove($id);
            } catch(PDOException $e){
                echo $e;
            }
            
        }

        public function findCard($id){
            try{
                $card = new Card();
                return $card->find($_POST['id']);
            } catch(PDOException $e){
                echo $e;
            }
        }

        public function listCard(){
            try{
                $card = new Card();
                $card->setIdUser($_SESSION['id']);

                return $card->listCardsBy();
            } catch(PDOException $e){
                echo $e;
            }
        }


    }
?>