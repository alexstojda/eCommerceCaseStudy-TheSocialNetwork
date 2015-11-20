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
        $query = "SELECT CONCAT(u1.`first_name`, ' ', u1.`last_name`) as from_user,
                         CONCAT(u2.`first_name`, ' ', u2.`last_name`) as to_user,
                         `messages`.`message`, `messages`.`timesent`
                    FROM `messages`
               LEFT JOIN `users` u1 ON u1.`user_id` = `messages`.`from_user_id`
               LEFT JOIN `users` u2 ON u2.`user_id` = `messages`.`to_user_id`
                   WHERE `to_user_id` = 2 AND `from_user_id` = 24
                  UNION
                  SELECT CONCAT(u1.`first_name`, ' ', u1.`last_name`) as from_user,
                         CONCAT(u2.`first_name`, ' ', u2.`last_name`) as to_user,
                         `messages`.`message`, `messages`.`timesent`
                    FROM `messages`
               LEFT JOIN `users` u1 ON u1.`user_id` = `messages`.`from_user_id`
               LEFT JOIN `users` u2 ON u2.`user_id` = `messages`.`to_user_id`
                   WHERE `to_user_id` = 24 AND `from_user_id` = 2
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