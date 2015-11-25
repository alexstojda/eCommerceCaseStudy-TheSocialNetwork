<?php

class Post extends Controller
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

    public function deletePost(){
       if (isset($_POST['postID']) && isset($_POST['post_type']) && isset($_POST['origin'])) {
              $this->model->deletePost();
           $return = ltrim($_POST['origin'],"/");
           header("Location: ../".$return);

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
                $uploadfile = $uploaddir . self::randomGen(32) .'.'. $path_parts;
            }
            //Savage fucking bullshit. Does all kinds of posts : groups, comments, normal ones
            $this->model = $this->getModel((isset($_GET['g']) ? 'Group_' : '').'Post', $post = [
                'from'    => Session::get('my_user')['id'],
                'to'      => (isset($_GET['u']) ? $_GET['u'] : (isset($_GET['g']) ? null : Session::get('my_user')['id'])),
                'group'   => (isset($_GET['g']) ? $_GET['g'] : header("Location: ..".$_POST['origin'].'?fucked=up')),
                'text'    => $_POST['post'],
                'image'   =>  ((isset($uploadfile) && move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) ? $uploadfile : null),
                'parent'  => (isset($_GET['reply']) ? $_GET['reply'] : null),
                'privacy' => 0
            ]);
            $return = ltrim($_POST['origin'],"/");
            header("Location: ../".$return);
        } else {
            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
    }


    public function getPosts()
    {
        //This is where all the posts come form...it's pretty fucking savage
    }

    public function getFriends()
    {
        //As sad as this method is named. It will be used to populate the table of friends on the side of the page.
        //may want to make this link to other pages as well
    }

}