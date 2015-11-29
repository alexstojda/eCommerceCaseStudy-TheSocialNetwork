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

    /**
     * Loads the index page of the controller
     * Shows a list of friends and links to groups or to create a group
     */
    public function index()
    {
        $uid = Session::get('my_user')['id'];

        $st = $this->model->getFriends($uid);
        //GET list of groups
        if (!empty($st)) {

            foreach ($st as $a_post) {
                $this->view->friends[] = $a_post;
            }

        }
        //FINALLY RENDER THE PAGE HTML
        $this->view->title = 'Your Friends';
        $this->view->render('friends/index');

    }

    /**
     * Sends a friend request to the given user
     * @param $idb int The user receiving a friend request
     */
    public function doNewFriend($idb)
    {
        $ida = Session::get('my_user')['id']; //$ida ALWAYS has to be the person sending the request. This is used as part of friend validation later.
        if ($this->model->addNewFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $idb . '&friendRequest=1');
        else {
            $this->view->error = 'Seems that we weren\'t able to add that person as your friend.
                                    Maybe you two are already friends?';
        }

    }

    /**
     * Unfriends the given user
     * @param $idb int User to be unfriended
     */
    public function doUnFriend($idb)
    {
        $ida = Session::get('my_user')['id'];
        if ($this->model->unFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $idb . '&unFriend=1');
        else {
            $this->view->error = 'Uhm, it would seem you were never friends to begin with. Maybe try being friends with them first before kicking them to the curb.';
        }
    }

    /**
     * Confirms a friend request with the given user
     * @param $ida int ID of friend to confirm request with
     */
    public function doConfirmFriend($ida)
    {
        $idb = Session::get('my_user')['id'];
        if ($this->model->confirmFriend($ida, $idb))
            header('Location: ' . URL . 'wall?u=' . $ida . '&newFriend=1');
        else {
            $this->view->error = 'Seems that we weren\'t able to add that person as your friend.
                                    Maybe you two are already friends?';
        }
    }
}