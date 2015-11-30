<?php

/**
 * Class _Timeline
 * Like wall but only posts... and aaallll kinds of posts..
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

    /**
     * Grabs all posts sent to a specified id
     * @param int $offset to start at
     * @param int $quantity to get
     * @return array of posts
     */
    public function getPosts($offset = 0, $quantity = 4)
    {
        //GIANT ASS QUERY FOR OWN, FRIEND & GROUP POSTS...
        $st = $this->db->select('    SELECT post_id          AS post_id,
                                            post_by,
                                            post_to,
                                            NULL             AS group_id,
                                            text             AS text,
                                            image_attachment AS image_attachment,
                                            creation_date    AS creation_date
                                       FROM `post`
                                      WHERE (`post_by` IN
                                            (SELECT `user_id_a` AS uid
                                               FROM `friends`
                                              WHERE `user_id_b` = :id AND !isnull(created_date)
                                              UNION
                                             SELECT `user_id_b` AS uid
                                               FROM `friends`
                                              WHERE `user_id_a` = :id AND !isnull(created_date))
                                                 OR `post_by` = :id)
                                         AND isnull(parent_id)
                                       UNION
                                     (SELECT
                                             group_post_id    AS post_id,
                                             post_by,
                                             NULL             AS post_to,
                                             group_id,
                                             text             AS text,
                                             image_attachment AS image_attachment,
                                             creation_date    AS creation_date
                                        FROM group_post
                                       WHERE group_id IN (SELECT group_id
                                                            FROM group_members
                                                           WHERE user_id = 2)
                                         AND isnull(parent_id))
                                    ORDER BY creation_date DESC LIMIT ' .
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