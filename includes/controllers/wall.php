<?php

/**
 * @property _Wall model
 *
 */
class Wall extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Session::checkMember();
    }

    public function index()
    {
        if (isset($_GET['u'])) {
            $uid = $_GET['u'];

            //SETUP AND INIT BASIC WALL

            //$this->loadModel('Wall');
            $this->model->init($this->getModel('User', $uid));
            $this->view->name = $this->model->getName();

            //GET POSTS FROM MODEL
            if (!empty($this->model->getUPosts())) {
                foreach ($this->model->getUPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Post', $a_post['post_id']);
                }
            }

            //FINALLY RENDER THE PAGE HTML
            $this->view->title = $this->model->getName() . '\'s Wall';
            $this->view->render('wall/index');
        } else {

            if (Session::get('my_user'))
                header("Location: ../wall?u=" . Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }
    }

    public function post()
    {
        if (isset($_POST['post'], $_GET['u'])) {

            if (isset($_FILES['picture'])) {
                $uploaddir = 'user_images/';
                echo '</br>' . $uploaddir;
                $uploadfile = $uploaddir . basename($_FILES['picture']['name']);

                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.\n";
                    $this->model = $this->getModel('Post', $post = [
                        'from' => Session::get('my_user')['id'],
                        'to' => $_GET['u'],
                        'text' => $_POST['post'],
                        'image' =>  $uploadfile,
                        'privacy' => 0
                    ]);
                } else {
                    echo "Possible file upload attack!\n";
                }

            }
            else{
                $this->model = $this->getModel('Post', $post = [
                    'from' => Session::get('my_user')['id'],
                    'to' => $_GET['u'],
                    'text' => $_POST['post'],
                    'image' => null,
                    'privacy' => 0
                ]);
            }

            header("Location: ../wall?u=" . $_GET['u']);
        } else {
            if (Session::get('my_user'))
                header("Location: ../wall?u=" . Session::get('my_user')['id']);
            else
                header("Location: ../home");
        }
    }
}