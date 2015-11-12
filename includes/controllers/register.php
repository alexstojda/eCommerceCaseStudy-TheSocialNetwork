<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-12
 * Time: 5:08 PM
 */
class register extends Controller
{

    /**
     * register constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->view->title = 'Create new account';
        $this->page(0);
    }

    public function page($page) {
        switch ($page) {
            case 0:
                $this->view->render('register/index');
                break;
            default:
                $this->view->render('register/index');
        }
    }

    public function doAuthInfo() {

    }
}