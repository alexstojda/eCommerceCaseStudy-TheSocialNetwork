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

    public function doNewFriend($idb)
    {
        $ida = Session::get('my_user')['id']; //$ida ALWAYS has to be the person sending the request. This is used as part of friend validation later.
        if ($this->model->addNewFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $idb . '&friendRequest=1');
        else {
            $this->view->error = 'Seems that we weren\'t able to add that person as your friend.
                                    Maybe you two are already friends?';
            //TODO: Error for this
        }

    }

    public function doUnFriend($idb)
    {
        $ida = Session::get('my_user')['id'];
        if ($this->model->unFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $idb . '&unFriend=1');
        else {
            $this->view->error = 'Uhm, it would seem you were never friends to begin with. Maybe try being friends with them first before kicking them to the curb.';
            //TODO: Error for this
        }
    }

    public function doConfirmFriend($ida)
    {
        $idb = Session::get('my_user')['id'];
        if ($this->model->confirmFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $ida . '&newFriend=1');
        else {
            $this->view->error = 'Seems that we weren\'t able to add that person as your friend.
                                    Maybe you two are already friends?';
            echo 'derp';
            echo $this->model->getError();
        }
    }
}