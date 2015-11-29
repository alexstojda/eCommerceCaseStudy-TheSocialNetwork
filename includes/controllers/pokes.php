<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-21
 * Time: 9:15 PM
 */

/**
 * Class pokes
 */
class pokes extends Controller
{
    /**
     * @var _Pokes
     */
    protected $model;

    /**
     * pokes constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    /**
     * Loads the index page for pokes that displays the pokes sent and received by the current user
     */
    public function index()
    {
        $this->view->uniquePokesSent = $this->model->getUniquePokesSentTo(Session::get('my_user')['id']);
        $this->view->uniquePokesReceived = $this->model->getUniquePokesReceivedBy(Session::get('my_user')['id']);
        $this->view->title = 'My Pokes';
        $this->view->render('pokes/index');
    }

    /**
     * Sends a poke from the current user to the given user ID
     * @param $uid int ID of user being poked
     */
    public function poke($uid)
    {
        if ($this->model->areFriends($uid, Session::get('my_user')['id'])) {
            if ($this->model->poke($uid))
                header('Location: ' . URL . 'wall?u=' . $uid . '&poked=1');
        } else {
            header('Location: ' . URL . 'wall?u=' . $uid . '&notPoked=1');
        }
    }
}