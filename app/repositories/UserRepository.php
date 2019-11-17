<?php

namespace app\repositories;

use app\model\UserModel;

/**
 * Class UserRepository
 *
 * Contains methods for working with Users.
 *
 * @package app\repositories
 *
 */
class UserRepository extends CoreRepository
{
    public function getModelClass()
    {
        return UserModel::class;
    }

     /**
     * @param $email
     * @return array
     */
    public function getUserByEmail($email)
    {
        $result = $this->startConditions()->getUser('email', $email, '*');
        return $result;
    }

    /**
     *
     *   $fields = [
     *   'firstname' => ,
     *   'surname' => ,
     *   'email' => ,
     *   'password' => ,
     *   'gender' =>  ,
     *   'birthday' => ,
     *     ]
     *
     * @param array $fields
     * @return mixed
     */
    public function saveUser(array $fields)
    {
        $result = $this->startConditions()->saveUser($fields);
        return $result;
    }
}