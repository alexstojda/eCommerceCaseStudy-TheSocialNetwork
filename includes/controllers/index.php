<?php


/**
 * Class Index
 *
 * Basic home class to test mvc
 */
class Index extends Controller
{

    public function index()
    {
        $this->view->title = 'Home';
        $this->view->render('home/index');

    }

}