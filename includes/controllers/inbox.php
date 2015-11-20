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
    }

    public function index()
    {
        $this->view->title = 'Inbox';
        $this->view->receivedMessages = $this->model->getReceivedConversations(Session::get('id'));
        $this->view->render('inbox/index');
    }

    public function sent() {
        $this->view->title = 'Inbox - Sent';
        $this->view->sentMessages = $this->model->getSentConversations(Session::get('id'));
        $this->view->render('inbox/sent');
    }

    public function u($uid) {
        $name = $this->model->getName($uid)[0];
        $this->view->title = $name['first_name'] . ' ' . $name['last_name'] . ' - Messages';
        $this->view->messages = $this->model->getMessages(Session::get('id'), $uid);
        $this->view->render('inbox/conversation');
    }
}