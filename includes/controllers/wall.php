<?php

/**
 * @property _Wall model
 * @property _Friends friendsModel
 * @property _Register regModel
 *
 */
class Wall extends Controller
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {
        if (isset($_GET['u'])) {
            $uid = $_GET['u'];

            //SETUP AND INIT BASIC WALL

            //$this->loadModel('Wall');
            $this->model->init($this->getModel('User', $uid));
            $this->view->name = $this->model->getName();
            $this->view->id = $uid;

            //GET POSTS FROM MODEL
            $this->view->posts_to_load = $this->model->getUPosts();
            /*if (!empty($this->model->getUPosts())) {
                foreach ($this->model->getUPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Post', $a_post['post_id']);
                }
            }*/

            //FINALLY RENDER THE PAGE HTML
            $this->view->title = $this->model->getName() . '\'s Wall';
            $friendshipStatus = $this->checkFriendship();
            switch ($friendshipStatus) {
                case 0:
                    $this->view->friendButtonText = 'Add Friend';
                    $this->view->friendButtonTarget = URL . 'friends/doNewFriend/' . $uid;
                    break;
                case 1:
                    $this->view->friendButtonText = 'Cancel Friend Request';
                    $this->view->friendButtonTarget = URL . 'friends/doUnFriend/' . $uid;
                    break;
                case 2:
                    $this->view->friendButtonText = 'Confirm Friend Request';
                    $this->view->friendButtonTarget = URL . 'friends/doConfirmFriend/' . $uid;
                    break;
                case 3:
                    $this->view->friendButtonText = 'Remove Friend';
                    $this->view->friendButtonTarget = URL . 'friends/doUnFriend/' . $uid;
                    break;
            }
            $this->view->render('wall/index');
        } else {

            if (Session::get('my_user'))
                header("Location: ../wall?u=" . Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }
    }

    public function checkFriendship()
    {
        $ida = $_GET['u'];
        $idb = $_SESSION['id'];

        $this->friendsModel = $this->getModel('Friends');
        return $this->friendsModel->areFriends($ida, $idb);
    }

    public function edit() {
        $user = $_SESSION['my_user'];
        $this->regModel = $this->getModel('Register');

        $this->view->countries = $this->regModel->getCountries();
        $this->view->genders  = $this->regModel->getGenders();

        $this->view->user = $user;
        $this->view->render('wall/edit');
    }
}