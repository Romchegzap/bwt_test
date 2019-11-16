<?php

namespace app\repositories;

use app\model\UserModel;

class UserRepository extends CoreRepository
{
    public function getModelClass()
    {
        return UserModel::class;
    }

    public function getUserByEmail($email)
    {
        $result = $this->startConditions()->getUser('email', $email, '*');
        return $result;
    }

    public function saveUser(array $fields)
    {
        $result = $this->startConditions()->saveUser($fields);
        return $result;
    }
}