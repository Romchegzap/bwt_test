<?php

namespace app\repositories;



abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $modelClassName = $this->getModelClass();
        $this->model = new $modelClassName;
    }

    abstract protected function getModelClass();

    protected function startConditions()
    {
        return clone $this->model;
    }

}