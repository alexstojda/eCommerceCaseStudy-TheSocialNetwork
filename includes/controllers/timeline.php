<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/20/2015
 * Time: 1:12 PM
 */
class timeline extends Controller
{

    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    public function index()
    {

            $uid = Session::get('my_user')['id'];

            //SETUP AND INIT BASIC WALL

            $this->loadModel('Wall');
            $this->model->init($this->getModel('User', $uid));
           // $this->view->name = $this->model->getName();

            //GET POSTS FROM MODEL
            if (!empty($this->model->getUPosts())) {
                foreach ($this->model->getUPosts() as $a_post) {
                    $this->view->posts[] = $this->getModel('Post', $a_post['post_id']);
                }
            }

            //FINALLY RENDER THE PAGE HTML
            $this->view->title = $this->model->getName() . '\'s Timeline';
            $this->view->render('timeline/index');

    }

    public function post()
    {
        if (isset($_POST['post'])) {

            if ($_FILES['picture']['name'] !== "") {

                $uploaddir = 'user_images/';
                $path_parts = pathinfo($_FILES["picture"]["name"])['extension'];
                $uploadfile = $uploaddir . self::randomGen(32) . '.' . $path_parts;

                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.\n";
                    $this->model = $this->getModel('Post', $post = [
                        'from' => Session::get('my_user')['id'],
                        'to' => $_GET['u'],
                        'text' => $_POST['post'],
                        'image' => $uploadfile,
                        'privacy' => 0
                    ]);
                } else {
                    echo "Possible file upload attack!\n";
                }

            } else {
                $this->model = $this->getModel('Post', $post = [
                    'from' => Session::get('my_user')['id'],
                    'to' => $_GET['u'],
                    'text' => $_POST['post'],
                    'image' => null,
                    'privacy' => 0
                ]);
            }

            header("Location: ../timeline");
        } else {
            if (Session::get('my_user'))
                header("Location: ../timeline");
            else
                header("Location: ../home");
        }
    }
}
?>