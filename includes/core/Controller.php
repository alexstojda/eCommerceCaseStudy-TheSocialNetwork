<?php

class Controller
{

    function __construct()
    {
        Session::init();
        $this->view = new View();
    }

    /**
     *
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = '../includes/models/')
    {
        $path = $modelPath . $name . '.php';

        if (file_exists($path)) {
            require $modelPath . $name . '.php';
            $modelName = '_' . $name;
            $this->model = new $modelName();
            return $this->model;
        }
    }

}