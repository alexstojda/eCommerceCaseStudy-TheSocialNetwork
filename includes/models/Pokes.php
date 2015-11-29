<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-21
 * Time: 9:32 PM
 */
class _Pokes extends Model
{

    /**
     * _Pokes constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getUniquePokesSentTo($uid)
    {
        return $this->db->select("SELECT
                                      poked as id,
                                      first_name,
                                      last_name,
                                      COUNT(poked) as count,
                                      poke_time
                                    FROM pokes
                                      INNER JOIN users u1 ON pokes.poked = u1.user_id
                                    WHERE poked_by = :id
                                    GROUP BY poked DESC
                                    ORDER BY poke_time DESC",
            array(':id' => $uid)
        );
    }
    public function getUniquePokesReceivedBy($uid)
    {
        return $this->db->select("SELECT
                                      poked_by as id,
                                      first_name,
                                      last_name,
                                      COUNT(poked) as count,
                                      poke_time
                                    FROM pokes
                                      INNER JOIN users u1 ON pokes.poked_by = u1.user_id
                                    WHERE poked = :id
                                    GROUP BY poked DESC
                                    ORDER BY poke_time DESC;",
            array(':id' => $uid)
        );
    }

    public function poke($uid)
    {
        if ($this->db->insert('pokes', array('poked_by' => Session::get('my_user')['id'], 'poked' => $uid)))
            return true;
        else
            return false;
    }

    public function areFriends($IDa, $IDb)
    {
        $res = $this->db->select("SELECT *
                                    FROM friends
                                   WHERE
                                       (
                                         (user_id_a = :ida AND user_id_b = :idb)
                                         OR
                                         (user_id_a = :idb AND user_id_b = :ida)
                                       )
                                       AND
                                       created_date IS NOT NULL",
            array(':ida' => $IDa, ':idb' => $IDb)
        );

        if (count($res) === 1)
            return true;
        else
            return false;
    }
}