<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 5:09 PM
 */
class inbox extends Controller
{
    /**
     * @var _Inbox
     */
    protected $model;

    /**
     * inbox constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::checkMember();
    }

    /**
     * Loads the inbox page for the controller
     * Displays all conversations received by the current user
     */
    public function index()
    {
        $this->view->title = 'Inbox';
        $this->view->receivedMessages = $this->model->getReceivedConversations(Session::get('my_user')['id']);
        $this->view->render('inbox/index');
    }

    /**
     * Loads the sent conversations page
     * Displays all conversations sent by the current user
     */
    public function sent()
    {
        $this->view->title = 'Inbox - Sent';
        $this->view->sentMessages = $this->model->getSentConversations(Session::get('my_user')['id']);
        $this->view->render('inbox/sent');
    }

    /**
     * Loads a specific conversation with the given user
     * @param $uid int ID of user conversation is with
     */
    public function u($uid)
    {
        $name = $this->model->getName($uid);
        if (isset($name[0])) {
            $name = $name[0];
            $this->view->name = $name;
            $this->view->title = $name['first_name'] . ' ' . $name['last_name'] . ' - Messages';
            $this->view->messages = $this->model->getMessages(Session::get('my_user')['id'], $uid);
            $this->view->fromid = Session::get('my_user')['id'];
            $this->view->toid = $uid;
            $this->view->render('inbox/conversation');
        } else {
            $this->view->noUserError = 'User with ID ' . $uid . ' does not exist.';
            $this->index();
        }

    }

    /**
     * Sends a message using the POST data to the given user
     */
    public function doMessage()
    {
        $from = $_POST['from_id'];
        $to = $_POST['to_id'];
        $message = $_POST['message'];

        if ($this->model->newMessage($from, $to, $message))
            header('Location: ' . URL . 'inbox/u/' . $to);
        else {
            $this->view->error = 'Message unable to be sent. Please try again.';
            $this->u($to);
        }

    }
}