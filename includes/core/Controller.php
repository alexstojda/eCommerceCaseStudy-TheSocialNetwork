<?php

class Controller {

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }
    
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
        public function loadModel($name, $modelPath = '../includes/models/') {
        
        $path = $modelPath . $name.'.php';
        
        if (file_exists($path)) {
            require $modelPath .$name.'.php';
            
            $modelName = $name . '';
            $this->model = new $modelName();
        }        
    }/*
    public function model($model){
        require_once '../includes/models/'. $model . '.php';
        return new $model();

    }

    public function view($view, $data){
        require_once '../includes/views/'. $model . '.php';
    }*/
}