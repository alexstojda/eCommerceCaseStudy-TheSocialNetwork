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

    public function getUniquePokes($uid)
    {
        return $this->db->select("SELECT
                                      poked_by,
                                      poked,
                                      COUNT(poked),
                                      poke_time
                                    FROM pokes
                                    WHERE poked_by = 2 OR poked = 2
                                    GROUP BY poked DESC
                                    ORDER BY poke_time DESC",
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