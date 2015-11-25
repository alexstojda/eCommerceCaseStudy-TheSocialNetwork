<?php
//Exists to avoid redundant code between wall & timeline TODO:add group walls to this...
abstract class postsContainer extends Controller
{
    private $count;

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
            $this->count = count($posts);
            foreach ($posts as $post) {
                if (isset($this->load) || isset($_POST['load']))
                    $this->view->posts[] = $this->getModel('Post', $post);
                elseif (isset( $_SERVER['HTTP_X_REQUESTED_WITH'])) {
                    $this->post = $this->getModel('Post', $post);
                    include PATH . 'views/post/index.php';
                }
            }
        } else {
            self::anAlert('No more posts available');
        }
    }

    public function &getCount() {
        echo json_encode($this->count);
    }
}
?>