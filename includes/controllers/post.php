<?php

/**
 * @property _Post model
 */
class post extends Controller
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    { //TODO Implement privacy
        if (isset($_GET['id'])) {
            $this->view->post = $this->getModel('Post', $_GET['id']);
            $this->view->render('post/index');
        } else {
            header('Location: ../home');
        }
    }

    public function deletePost()
    {
        if (isset($_POST['postID'])) {
            $this->model->deletePost();
            header("Location: ../" . $_POST['origin']);
        } else {
            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
    }

    public function doPost()
    {
        if (isset($_POST['post'])) {
            //Check upload picture and moves with new name to our server's picture directory
            if ($_FILES['picture']['name'] !== "") {
                $uploaddir = 'user_images/';
                $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
                $uploadfile = $uploaddir . self::randomGen(32) . '.' . $path_parts;
            }
            //Savage fucking bullshit. Does all kinds of posts : groups, comments, normal ones
            /** @noinspection PhpVoidFunctionResultUsedInspection */
            $this->model = $this->getModel('Post', $post = array(
                'from' => Session::get('my_user')['id'],
                'to' => (isset($_GET['u']) ? $_GET['u'] : (isset($_GET['g']) ? null : Session::get('my_user')['id'])),
                'group' => (isset($_GET['g']) ? $_GET['g'] : header("Location: .." . $_POST['origin'] . '?fucked=up')),
                'text' => $_POST['post'],
                'image' => ((isset($uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile) && $_FILES['picture']['error'] ===0) ? $uploadfile : null),
                'parent' => (isset($_GET['reply']) ? $_GET['reply'] : null),
                'privacy' => 0
            ));
            header("Location: ../" . $_POST['origin']);
        } else {
            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
    }

    //Trying to make things expandable here god damn it.....
    public function newResponse() {
        if(isset($_POST['post_id'],$_POST['rep'])) {
            $this->loadModel('Response',[
                'user_id'  => Session::get('my_user')['id'],
                'post_id'  => $_POST['post_id'],
                'response' => $_POST['rep']
            ]);
            if ($_POST['set'] == 1)
                $this->model->add();
            elseif ($_POST['set'] == 0)
                $this->model->delete();

            $this->getResponse();
        } else {
            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
    }

    public function getResponse() {
        if(isset($_POST['post_id'],$_POST['rep'])) {
            $this->loadModel('Post',$_POST['post_id']);
            echo $this->model->getCount($_POST['rep']);
        }
    }
}