<?php

/**
 * Class Controller
 *
 * @property model
 * @property view
 */
abstract class Controller
{

    public function __construct()
    {
        Session::init(); //init session for all pages
        $this->view = new View();
    }

    abstract public function index();
    /**
     *
     * @param string $name Name of the model
     * @param string $modelPath
     */
    public function loadModel($name, $modelPath = '../includes/models/')
    {
        $path = $modelPath . $name . '.php';

        if (file_exists($path)) {
            require_once $modelPath . $name . '.php';

            $modelName = '_' . $name;
            $this->model = new $modelName();
        }
    }

    /**
     * Loads a specified model and returns it.
     *
     * @param string $name Name of the model
     * @param string $modelPath
     * @return null
     */
    public function getModel($name, $param = null, $modelPath = '../includes/models/')
    {
        $path = $modelPath . $name . '.php';

        if (file_exists($path)) {
            require_once $modelPath . $name . '.php';
            $modelName = '_' . $name;
            //echo 'got params:' . $param;
            if (isset($param))
                return new $modelName($param);
            else
                return new $modelName();
        }
        return null;
    }
}