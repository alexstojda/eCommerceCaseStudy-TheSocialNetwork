<?php

class View {

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        if ($noInclude) {
            require PATH . 'views/' . $name . '.php';
        }
        else {
            require PATH . 'views/header.php';
            require PATH . 'views/' . $name . '.php';
            require PATH . 'views/footer.php';
        }
    }

}