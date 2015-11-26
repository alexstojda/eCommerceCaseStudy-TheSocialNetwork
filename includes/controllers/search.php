<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/25/2015
 * Time: 10:48 PM
 */
class Search extends Controller
{
    public function index()
    {
        if (isset($_POST['search'])) {
            //TODO-andrew: Define functions
            $foundUsers = searchUsers();
            $foundGroups = searchGroups();

            $this->view->foundUsers = $foundUsers;
            $this->view->foundGroups = $foundGroups;

            $this->view->render('search/index');
        }
    }

}
