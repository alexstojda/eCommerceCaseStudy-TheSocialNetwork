<?php

/**
 * @property _User wallUser
 */
class _Wall extends Model
{
    private $user;
    private $posts;
    private $friends;
    private $name;

    public function __construct() {
        parent::__construct();
    }

    public function init()
    {
        //GET USER INFORMATION TODO: About user tab and short info block like FB
        $this->setUser($this->wallUser);
        $this->setName($this->wallUser->getName());

        //RETRIEVE ALL POSTS
        $st = $this->db->select('SELECT * FROM post WHERE post_to = :from', array(
            ':from' => $this->wallUser->getID()
        ));

        if(count($st) > 0) {
            $this->posts = $st;
        } else { //no posts on wall ;(
            echo 'PUT NO POST MESSAGE ON THE WALL';
        }
    }

    //Getters
    public function getUser()
    {
        return $this->user;
    }

    public function getUPosts()
    {
        return $this->posts;
    }

    public function getUFriends()
    {
        return $this->friends;
    }

    public function getName()
    {
        return $this->name;
    }

    //Setters
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setFriends($user)
    {
        /*
        Get friends from database
        */
    }

    public function setPosts($user)
    {
        /*
        Get posts from database
        */
    }

    public function setName($name)
    {
        $this->name = $name;

    }

}