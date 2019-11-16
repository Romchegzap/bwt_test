<?php

namespace app\model;

use mvc\model\Model;

/**
 * Class FeedbackModel
 * @package app\model
 */
class FeedbackModel extends Model
{
    /**
     * Load feedbacks from db
     * @return array
     */
    public function getFeedbacks()
    {
        $result = $this->db->getRows('SELECT `name`, `message`, `email` FROM feedbacks;');
        return $result;
    }
    /**
     * Save feedback in db
     *
     * @param array
     * @return bool
     */
    public function saveFeedback(array $fields)
    {
        $sql = 'INSERT INTO `feedbacks` (`name`, `message`, `email`) 
            VALUES (:name, :body, :email);';

        $params = [
            'name' => $fields['name'],
            'body' => $fields['message'],
            'email' => $fields['email'],
        ];
        $res = $this->db->execQuery($sql, $params)['res'];
        return $res;
    }
}