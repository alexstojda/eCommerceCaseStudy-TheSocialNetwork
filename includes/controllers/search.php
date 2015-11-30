<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/25/2015
 * Time: 10:48 PM
 * @property _Search model
 */
class search extends Controller
{
    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }
    /**
     * Prepares the list of users and groups linked to the search string
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            //TODO-andrew: Define functions

            $foundUsers =  $this->model->searchUsers();
            $foundGroups =  $this->model->searchGroups();

            $this->view->foundUsers = $foundUsers;
            $this->view->foundGroups = $foundGroups;
            $this->view->title = 'Results for "' . $_GET['search'] . '"';
            $this->view->render('search/index');
        }
    }

}
