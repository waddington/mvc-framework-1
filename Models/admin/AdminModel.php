<?php
// This is my model that all other models used in the admin area extend
// This just stores the type of model that it is and is used only to show use of inheritance
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 25/04/17
 * Time: 12:58
 */
class AdminModel
{
    private $modelType;

    // Just storing the type of model
    public function __construct($type)
    {
        $this->modelType = $type;
    }

    // Retrieving the type of model
    public function getModelType() {
        return $this->modelType;
    }
}