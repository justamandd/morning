<?php

//require_once './Models/User.php';

namespace App\Controllers;

use App\Models\User;

    class UserController
    {

        public function saveUser()
        {
            //user = $u
            $u = new User();

            if(isset($_SESSION['id'])){ $u->setId($_POST['id']); }
            $u->setName($_POST['name']);
            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);
            $u->setType((int)$_POST['type']);

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

        public function login()
        {
            $u = new User();
            $u->setEmail($_POST['email']);
            $u->setPassword($_POST['password']);
            return $u->auth();
        }

        public function profile(int $id)
        {
            $u = new User();
            return $u->select($id);
        }
    }