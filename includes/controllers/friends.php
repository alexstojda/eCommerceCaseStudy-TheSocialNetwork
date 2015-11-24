<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-23
 * Time: 10:35 AM
 */
class friends extends Controller
{
    /**
     * @var _Friends
     */
    protected $model;

    /**
     * friends constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function doNewFriend($idb) {
        $ida = $_SESSION['id'];
        if($this->model->addNewFriend($ida, $idb)){
            if($_SESSION['id'] == $ida)
                header('Location: ' . URL . 'wall?u='.$idb.'&newFriend=1');
        } else {
            $this->view->error = 'Seems that we weren\'t able to add that person as your friend.
                                    Maybe you are already friends?';
        }

    }

    public function doUnFriend($idb) {
        //TODO: Unfriend ppl
    }
}