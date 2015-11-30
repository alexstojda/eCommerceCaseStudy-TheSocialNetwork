<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/21/2015
 * Time: 7:57 PM
 * @property _Groups model
 */
class groups extends postsContainer
{
    /**
     * groups constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    /**
     * used to turn a group member into an admin
     */
    public function makeAdmin()
    {
        if (isset($_POST['admin_id']) && isset($_GET['g'])) {
            $this->model->makeAdmin();
            header("Location: ../groups/group?g=" . $_GET['g']);
        }
    }

    /**
     * prepares the page where admin/owner can update the groups information
     */
    public function update()
    {
        $this->model->init($_POST['g']);
        $this->view->name = $this->model->getName();
        $this->view->description = $this->model->getDescription();
        $this->view->privacy = $this->model->getPrivacy();

        //SETUP AND INIT BASIC WALL
        if (isset($_POST['privacy']) && isset($_POST['description'])) {
            $this->model->updateGroup(); //make update
            header("Location: ../groups/group?g=" . $_POST['g']);
        }
        if (isset($_POST['g']) && isset($_POST['member_id'])) {
            $this->view->title = 'Update Group';
            $this->view->render('groups/update');
        }
    }

    /**
     * Removes member from the group
     */
    public function kick()
    {

        if (isset($_POST['member_id']) && isset($_GET['g'])) {
            $this->model->kick();
            header("Location: ../groups/group?g=" . $_GET['g']);
        }

    }

    /**
     * removes the group from the database and then redirects to the group page
     */
    public function delete()
    {

        if (isset($_POST['delete_group']) && isset($_GET['g'])) {
            $this->model->delete();
            header("Location: ../groups");
        }

    }

    /**
     * For admins and members only (owner does not have access)
     * removes user form the group
     */
    public function leave()
    {

        if (isset($_POST['leave_id']) && isset($_GET['g'])) {
            $this->model->leave();
            header("Location: ../groups");
        }

    }

    /**
     * adds the user to the group in the database
     */
    public function join()
    {

        if (isset($_POST['user_id']) && isset($_GET['g'])) {
            $this->model->join();
            header("Location: ../groups/group?g=" . $_GET['g']);
        }

    }

    /**
     * owner of the group has the power to remove an admins status, making him a regualer member
     */
    public function removeAdmin()
    {

        if (isset($_POST['admin_id']) && isset($_GET['g'])) {
            $this->model->removeAdmin();
            header("Location: ../groups/group?g=" . $_GET['g']);
        }

    }

    /**
     * lists all groups the user is in
     */
    public function index()
    {
        $uid = Session::get('my_user')['id'];
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

    /**
     * loads the create a group page
     */
    public function create()
    {
        $uid = Session::get('my_user')['id'];

        //SETUP AND INIT BASIC WALL
        if (isset($_POST['name']) && isset($_POST['privacy']) && isset($_POST['description'])) {

            $validName = $this->model->validateName();
            if (!$validName) {
                $this->view->alerts[] = ['Group name already taken', 'warning'];
                $this->view->title = 'Create Groups';
                $this->view->render('groups/create');
            } else {
                $this->model->createGroup($_POST['name'], $_POST['description'], $_POST['privacy'], $uid);
                header("Location: ../groups");
            }

        } else {
            $st = $this->model->getGroups($uid);
            //GET list of groups
            if (!empty($st)) {

                foreach ($st as $a_post) {
                    $this->view->groups[] = $a_post;
                }

                $this->view->validName = $this->model->validateName();
            }

            //FINALLY RENDER THE PAGE HTML
            $this->view->title = 'Create Groups';
            $this->view->render('groups/create');
            //}
        }

    }

    /**
     * Loads the groups wall
     */
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
                    $this->view->posts[] = $this->getModel('Post', $a_post['group_post_id']);
                }
            }
        } else {
            if (Session::get('my_user'))
                header("Location: ../groups");
            else
                header("Location: ../home");
        }
        //FINALLY RENDER THE PAGE HTML
        $this->view->title = $this->model->getName();
        $this->view->render('groups/group');

    }
}
