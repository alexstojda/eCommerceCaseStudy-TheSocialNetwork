<?php

/**
 * @property array error
 * @property string title
 */
class View {

    function __construct() {
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
            require PATH . 'views/' . $name . '.php';
            require PATH . 'views/footer.php';
        }
    }

}