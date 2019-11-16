<?php

namespace app\model;

use mvc\model\Model;

/**
 * Class UserModel
 * @package app\model
 */
class UserModel extends Model
{

    /**
     * Load user from database by $unique_field.
     *
     * @return array
     */
    public function getUser(string $unique_field, $field_val, string $fields)
    {
        $params = ["$unique_field" => $field_val];
        $result = $this->db->getRows("SELECT $fields FROM users WHERE $unique_field = :$unique_field;", $params);
        return $result;
    }


    /**
     * @param array $fields
     * @return mixed
     */
    public function saveUser(array $fields)
    {
        $sql = 'INSERT INTO `users` (`firstname`, `surname`, `email`, `password`, `gender`, `birthday`) 
            VALUES (:firstname, :surname, :email, :password, :gender, :birthday);';
        $params = [
            'firstname' => $fields['firstname'],
            'surname' => $fields['surname'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'gender' =>  isset($fields['gender']) ? $fields['gender'] : null,
            'birthday' => isset($fields['birthday']) ? $fields['birthday'] : null,
        ];
        $res = $this->db->execQuery($sql, $params)['res'];
        return $res;
    }
}