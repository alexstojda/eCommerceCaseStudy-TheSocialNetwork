<?php
//Exists to avoid redundant code between wall & timeline TODO@Alex Too different.. only useful thing would be the loadPosts If I have time on weekend ;add group walls to this...;
/**
 * @property Model model
 * @property string load
 */
abstract class postsContainer extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function init($uid)
    {
        //TODO@Alex Timeline/Wall Models. Can't really specify cos it has to be able to call it for both. Since it's loaded dynamically inspector no happy.
        $this->model->init($this->getModel('User', $uid));

        //GET POSTS FROM MODEL
        $this->load = 'all';
        $this->loadPosts();
    }


    public function loadPosts()
    {
        $offset = 0;
        $quantity = 0;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {//if ajax
            if (isset($_POST['u']))
                $this->model->init($this->getModel('User', $_POST['u']));

            if (isset($_POST['off']))
                $offset = (int)$_POST['off'];
            if (isset($_POST['quantity']))
                $quantity = (int)$_POST['quantity'];

            if ($offset > 0 && $quantity > 0)
                $posts = $this->model->getPosts($offset, $quantity);
            elseif ($offset > 0)
                $posts = $this->model->getPosts($offset);
            elseif ($quantity > 0)
                $posts = $this->model->getPosts(0, $quantity);
        } else {
            $posts = $this->model->getPosts();
        }

        if (!empty($posts)) {
            //$this->latest_id = $posts[0]['post_id'];
            foreach ($posts as $post) {
                if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'])) {
                    $this->post = $this->getModel('Post', $post);
                    include PATH . 'views/post/index.php';
                } else
                    $this->view->posts[] = $this->getModel('Post', $post);
            }
        } else {
            //self::anAlert('No more posts available');
        }
    }
}
