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

    public static function checkMember()
    {
        if (!Session::get('my_user')) {
            header('Location: ../auth?error=2');
            exit;
        }
    }

    //Generate random string for files mainly
    public static function randomGen($random_string_length) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }


    abstract public function index();

    /**
     * Used to autoload models on controller creation.
     * @param string $name Name of the model
     * @param string $modelPath
     */
    public function loadModel($name, $param = null, $modelPath = '../includes/models/')
    {
        $path = $modelPath . $name . '.php';

        if (file_exists($path)) {
            require_once $modelPath . $name . '.php';

            $modelName = '_' . $name;
            if (isset($param))
                $this->model = new $modelName($param);
            else
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

    public static function anAlert($msg,$type = 'warning') {
                echo '<div style="margin-left: 10%; margin-right: 10%" class="alert alert-' . $type . ' alert-dismissible" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    . $msg . '</div>';

    }
}