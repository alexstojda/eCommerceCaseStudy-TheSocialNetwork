<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 7:57 PM
 */

class groups extends Controller
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {/*
        if (isset($_GET['g'])) {
            $gid = $_GET['g'];*/
        $uid = Session::get('my_user')['id'];

        //SETUP AND INIT BASIC WALL

        // $this->loadModel('Wall');
        //$this->model->init($uid);

        $st = $this->model->getGroups($uid);
        //GET list of groups
        if (!empty($st)) {

            foreach ($st as $a_post) {
                $this->view->groups[] = $a_post;
            }

        }

        //FINALLY RENDER THE PAGE HTML
        $this->view->title = 'Your Groups';
        $this->view->render('groups/index');
        //}

    }

    public function getAllGroups($uid)
    {

        $st = $this->db->select('SELECT groups.name FROM groups, group_members WHERE groups.group_id = group_members.group_id AND group_members.user_id = :id', array(
            ':id' => $uid));

    }

    public function group()
    {
        if (isset($_GET['g'])) {
            $gid = $_GET['g'];

            //SETUP AND INIT BASIC WALL for group

            $this->model->init($gid);
            $this->view->name = $this->model->getName();
            $this->view->description = $this->model->getDescription();
            $this->view->members = $this->model->getMembers();
            //GET POSTS FROM MODEL
            if (!empty($this->model->getPosts())) {
                foreach ($this->model->getPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Group_Post', $a_post['group_post_id']);
                }
            }


        } else {

            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
        //FINALLY RENDER THE PAGE HTML
        $this->view->title = $this->model->getName();
        $this->view->render('groups/group');

    }


    public function post()
    {
        if (isset($_POST['post'], $_GET['g'])) {

            if ($_FILES['picture']['name'] !== "") {

                $uploaddir = 'user_images/';
                $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
                $uploadfile = $uploaddir . self::randomGen(32) .'.'. $path_parts;

                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.\n";
                    $this->model = $this->getModel('Group_Post', $post = [
                        'from' => Session::get('my_user')['id'],
                        'to' => $_GET['g'],
                        'text' => $_POST['post'],
                        'image' =>  $uploadfile,
                        'privacy' => 0
                    ]);
                } else {
                    echo "Possible file upload attack!\n";
                }

            }
            else{
                $this->model = $this->getModel('Group_Post', $post = [
                    'from' => Session::get('my_user')['id'],
                    'to' => $_GET['g'],
                    'text' => $_POST['post'],
                    'image' => null,
                    'privacy' => 0
                ]);
            }

            header("Location: ../groups/group?g=" . $_GET['g']);
        } else {
            if (Session::get('my_user'))
                header("Location: ../groups");
            else
                header("Location: ../home");
        }
    }
}
