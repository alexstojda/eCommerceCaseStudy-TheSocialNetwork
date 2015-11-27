<?php

/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/20/2015
 * Time: 4:45 PM
 */
class _Timeline extends Model
{
    /**
     * @var _User user
     */
    private $user;
    private $posts;
    private $friends;

    public function __construct()
    {
        parent::__construct();
    }

    public function init($new_user)
    {
        $this->setUser($new_user);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }


    public function &getPosts($offset = 0, $quantity = 4)
    {//TODO@Alex Monster query that also does group posts for groups you're in?;
        $st = $this->db->select('SELECT * FROM `post` WHERE (`post_by` IN
                           (SELECT `user_id_a` AS uid FROM `friends` WHERE `user_id_b` = :id AND !isnull(created_date)
                            UNION
                            SELECT `user_id_b` AS uid FROM `friends` WHERE `user_id_a` = :id AND !isnull(created_date)) OR `post_by` = :id)
                                                                           AND isnull(parent_id) ORDER BY creation_date DESC LIMIT ' .
            $offset . ',' . $quantity, [':id' => $this->user->getID()]);

        if (count($st) > 0)
            $this->posts = $st;
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

}