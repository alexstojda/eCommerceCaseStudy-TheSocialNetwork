<?php

/**
 * @property array alerts
 * @property string title
 * @property array posts
 */
class View {

    public function __construct()
    {
        //echo 'this is a view';
    }

    public function render($name, $noInclude = false)
    {
        if ($noInclude) {
            require PATH . 'views/' . $name . '.php';
        }
        else {
            require PATH . 'views/header.php'; //replace by navbar eventually
            require PATH . 'views/navbar/index.php';

            //Rudementary alerts
            if (isset($this->alerts)) {
                foreach ($this->alerts as $alert) {
                    Controller::anAlert($alert[0],$alert[1]);
                }
            }

            require PATH . 'views/' . $name . '.php';
            require PATH . 'views/footer.php';
        }
    }

}