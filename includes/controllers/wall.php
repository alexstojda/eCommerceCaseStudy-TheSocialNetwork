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
            if (!empty($this->model->getUPosts())) {
                foreach ($this->model->getUPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Post', $a_post['post_id']);
                }
            }

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

    /*TODO:OBSOLETE use /post/doPost() now*/
    public function post()
    {
        if (isset($_POST['post'], $_GET['u'])) {

            if ($_FILES['picture']['name'] !== "") {
                $uploaddir = 'user_images/';
                $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
                $uploadfile = $uploaddir . self::randomGen(32) . '.' . $path_parts;
            }

            $this->model = $this->getModel('Post', $post = [
                'from' => Session::get('my_user')['id'],
                'to' => $_GET['u'],
                'text' => $_POST['post'],
                'image' => ((isset($uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) ? $uploadfile : null),
                'parent' => (isset($_GET['reply']) ? $_GET['reply'] : null),
                'privacy' => 0
            ]);

            header("Location: ../wall?u=" . $_GET['u']);
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