<?php
//Exists to avoid redundant code between wall & timeline TODO:add group walls to this...
abstract class postsContainer extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function init($uid)
    {
        $this->model->init($this->getModel('User', $uid));

        //GET POSTS FROM MODEL
        $this->load = 'all';
        $this->loadPosts();
    }

    public function loadPosts() {
        $offset = 0; $quantity = 5;
        if (isset($_POST['u']) )
            $this->model->init($this->getModel('User', $_POST['u']));

        if(isset($_POST['off']))
            $offset = (int) $_POST['off'];
        if(isset($_POST['quantity']))
            $quantity = (int) $_POST['quantity'];

        if ($quantity !== 5 && $offset > 0)
            $posts = $this->model->getUPosts($offset, $quantity);
        elseif ($offset > 0)
            $posts = $this->model->getUPosts($offset);
        else
            $posts = $this->model->getUPosts();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                if (isset($this->load) || isset($_POST['load']))
                    $this->view->posts[] = $this->getModel('Post', $post);
                else {
                    $this->post = $this->getModel('Post', $post);
                    include PATH . 'views/post/index.php';
                }
            }
        }
    }
}
?>