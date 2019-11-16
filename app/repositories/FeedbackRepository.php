<?php

namespace app\repositories;

use app\model\FeedbackModel;

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