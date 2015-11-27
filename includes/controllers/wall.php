<?php

/**
 * @property _Wall model
 * @property _Friends friendsModel
 * @property _Register regModel
 *
 */
class Wall extends postsContainer
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


            $this->init($uid);
            $this->view->name = $this->model->getName();
            $this->view->id = $uid;
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
        $idb = Session::get('my_user')['id'];

        $this->friendsModel = $this->getModel('Friends');
        return $this->friendsModel->areFriends($ida, $idb);
    }

    public function edit()
    {
        $user = $_SESSION['my_user'];
        $this->regModel = $this->getModel('Register');

        $this->view->countries = $this->regModel->getCountries();
        $this->view->genders = $this->regModel->getGenders();

        $this->view->user = $user;
        $this->view->title = 'Edit my Account';
        $this->view->render('wall/edit');
    }

    public function deleteMyAccountAndAllAssociatedData() {
        $uid = Session::get('my_user')['id'];
        $pass = $_POST['deletePassword'];

        /** @var _Register $model */
        $model = $this->getModel('Register');
        if($model->deleteAccount($uid, $pass) > 0){
            header('Location: '.URL);
        } else {
            $this->view->alerts[] = ['Password incorrect. Account not deleted! YAY :D<br/>I\'m taking you to a safe place now', 'success'];
            header('Refresh: 3; URL=http://devbana.tk/timeline');
            $this->view->render('home/index');
        }
    }
}