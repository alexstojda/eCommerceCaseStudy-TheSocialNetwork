<?php

class _Friends extends Model
{

    /**
     * _Friends constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getFriends($uid)
    {
        return $this->db->select('SELECT
                                      users.first_name,
                                      users.last_name,
                                      friends.user_id_a AS uid,
                                      friends.created_date
                                    FROM friends
                                         INNER JOIN users ON users.user_id = friends.user_id_a
                                   WHERE friends.user_id_b = :id
                                  UNION
                                  SELECT
                                      users.first_name,
                                      users.last_name,
                                      friends.user_id_b AS uid,
                                      friends.created_date
                                    FROM friends
                                         INNER JOIN users ON users.user_id = friends.user_id_b
                                   WHERE friends.user_id_a = :id;', array(':id' => $uid));
    }

    public function addNewFriend($id_from, $id_to)
    {
        if (!$this->areFriends($id_from, $id_to))
            return $this->db->insert('friends', array('user_id_a' => $id_from, 'user_id_b' => $id_to));
        else
            return false;
    }

    public function areFriends($ida, $idb)
    {
        $res = $this->db->select('SELECT * FROM friends WHERE (user_id_a = :ida AND user_id_b = :idb) OR (user_id_a = :idb AND user_id_b = :ida)',
                                array('ida' => $ida, ':idb' => $idb));

        if (count($res) == 0)
            return false;
        else
            return true;
    }

    public function confirmFriend($id_from, $id_to)
    {
        return $this->db->update('friends', array('created_date' => new DateTime()),
            "WHERE (user_id_a = $id_from AND user_id_b = $id_to)
                OR (user_id_b = $id_from AND user_id_a = $id_to)");
    }
}
