<?php

namespace app\repositories;

use app\model\FeedbackModel;

/**
 * Class FeedbackRepository
 *
 * Contains methods for working with Feedbacks.
 *
 * @package app\repositories
 */
class FeedbackRepository extends CoreRepository
{
    public function getModelClass()
    {
        return FeedbackModel::class;
    }

    public function getFeedbacksForMainPage()
    {
        $result = $this->startConditions()->getFeedbacks();
        return $result;
    }

    public function saveFeedback(array $fields)
    {
        $result = $this->startConditions()->saveFeedback($fields);
        return $result;
    }
}