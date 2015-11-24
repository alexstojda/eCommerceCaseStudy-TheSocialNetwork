<?php

/**
 * @property _User wallUser
 */
class _Wall extends Model
{
    private $user;
    private $post_ids;
    private $friends;
    private $name;

    public function __construct() {
        parent::__construct();
    }

    public function init($new_user)
    {
        //GET USER INFORMATION TODO: About user tab and short info block like FB
        $this->setUser($new_user);
        $this->setName($new_user->getName());
        $this->setPosts($new_user);
    }

    //Getters

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

    }

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
        return $this->post_ids;
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
        //RETRIEVE ALL POSTS IDS
        $st = $this->db->select('SELECT post_id FROM post WHERE post_to = :to AND isnull(parent_id) ORDER BY creation_date DESC', array(
            ':to' => $user->getID()
        ));

        if(count($st) > 0) {
            foreach($st as $item) {
                $this->post_ids[] = $item['post_id'];
            }
        } else { //no posts on wall ;(
            echo 'Sucks to suck, ' . $this->getName();
        }
    }

}