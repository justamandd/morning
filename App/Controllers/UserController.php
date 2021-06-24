<?php

//require_once './Models/User.php';

namespace App\Controllers;

use App\Models\User;

    class UserController
    {

        public static function saveUser()
        {
            //user = $u
            $u = new User();

            if(isset($_SESSION['user_id'])){$u->setId($_SESSION['user_id']);}
            $u->setName($_POST['name']);
            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);
            $u->setType($_POST['type']);

            return $u->save();

            /*echo '<div class="alert h6 mt-2" role="alert" style="color: #856404;background-color: #fff3cd;border-color: #ffeeba;">
                User already exists.
            </div>';*/
        }

        public function listAll()
        {
            $u = new User();
            return $u->listUsers();
        }

        public function delete(int $id)
        {
            $u = new User();
            $u = $u->remove($id);
        }

        public static function login()
        {
            $u = new User();
            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);
            return $u->auth();
        }

        public static function profile(int $id)
        {
            $u = new User();
            return $u->select($id);
        }
    }