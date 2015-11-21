<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/20/2015
 * Time: 4:45 PM
 */


class _Timeline extends Model
{
    private $user;
    private $posts;
    private $friends;

    public function __construct() {
        parent::__construct();
    }

    public function init($new_user)
    {
        //GET USER INFORMATION TODO: About user tab and short info block like FB
        $this->setUser($new_user);

       //Add post_by =  to friends' ids and privacy = public or just friends
        //RETRIEVE ALL POSTS
        $st = $this->db->select('SELECT * FROM post WHERE post_to = :to ORDER BY creation_date DESC', array(
            ':to' => $new_user->getID()
        ));

        if(count($st) > 0) {
            $this->posts = $st;
        } else { //no posts on wall ;(
            echo 'Sucks to suck, ' . $this->getName();
        }
    }

    //Getters

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    //Setters

    public function getUPosts()
    {
        return $this->posts;
    }

    public function getUFriends()
    {
        return $this->friends;
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

}