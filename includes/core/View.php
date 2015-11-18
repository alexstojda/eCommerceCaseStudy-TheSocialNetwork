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
                    echo '<div style="margin-left: 10%; margin-right: 10%" class="alert alert-' . $alert[1] . ' alert-dismissible" role="alert">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                        . $alert[0] . '</div>';
                }
            }

            require PATH . 'views/' . $name . '.php';
            require PATH . 'views/footer.php';
        }
    }

}