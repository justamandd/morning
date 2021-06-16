<?php
    namespace App\Controllers;

    use App\Models\User;

    class UserController
    {
        public function login()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $select = User::authenticate($data['email'], $data['password']);

            if($data['email'] == $select->getEmail() && $data['password'] == $select->getPassword())
            {
                return ['id'=>$select->getId(),'name'=>$select->getName(),'email'=>$select->getEmail(),'type'=>$select->getType()];
            }
            else
            {
                throw new \Exception("Email or password invalid");
            }
        }

        public function create()
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $sql = User::save($data);


        }

        public function update()
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $sql = User::save($data);


        }
    }