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

    /**
     * @param $ida int User that requested the check
     * @param $idb int User that's being checked against
     * @return int 0 for not friends,
     *             1 for pending confirmation from other person,
     *             2 for pending confirmation from this person ($idb),
     *             3 for are friends.
     */
    public function areFriends($ida, $idb)
    {
        $res = $this->db->select('SELECT * FROM friends WHERE (user_id_a = :ida AND user_id_b = :idb) OR (user_id_a = :idb AND user_id_b = :ida)',
                                array('ida' => $ida, ':idb' => $idb));
        if (count($res) == 0)
            return 0;
        else if ($res[0]['created_date'] == null && $res[0]['user_id_b'] == $ida )
            return 1;
        else if ($res[0]['created_date'] == null && $res[0]['user_id_b'] != $ida )
            return 2;
        else
            return 3;
    }

    public function confirmFriend($id_from, $id_to)
    {
        $today = new DateTime('now');
        $today_string = $today->format('Y-m-d H:i:s');
        return $this->db->update('friends', array('created_date' => $today_string),
            "(user_id_a = $id_from AND user_id_b = $id_to) OR (user_id_b = $id_from AND user_id_a = $id_to)");
    }

    public function unFriend($id_from, $id_to) {
        return $this->db->delete('friends',
            "(user_id_a = $id_from AND user_id_b = $id_to) OR (user_id_a = $id_to AND user_id_b = $id_from)");
    }
}
