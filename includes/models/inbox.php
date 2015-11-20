<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 5:28 PM
 */
class _inbox extends model
{

    /**
     * _inbox constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getMessages($IDa, $IDb)
    {
        $query = "SELECT * FROM `messages` WHERE `to_user_id` = :ida AND `from_user_id` = :idb
                   UNION
                  SELECT * FROM `messages` WHERE `to_user_id` = :idb AND `from_user_id` = :ida
                   ORDER BY `timesent` DESC";
        return $this->db->select($query,
            array(':ida' => $IDa, ':idb' => $IDb));
    }

    public function getReceivedConversations($uid)
    {
        $query = "SELECT `from_user_id`, `to_user_id`, `message`
                    FROM `messages`
                   WHERE `from_user_id` IN
		                (SELECT DISTINCT `from_user_id`
                           FROM `messages`
                          WHERE `to_user_id` = :id)
                   GROUP BY `from_user_id`, `to_user_id`";
        return $this->db->select($query, array(':id' => $uid));
    }
}