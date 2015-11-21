<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 5:28 PM
 */
class _Inbox extends model
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
        $query = "SELECT CONCAT(u1.`first_name`, ' ', u1.`last_name`) AS from_user,
                         from_user_id,
                         CONCAT(u2.`first_name`, ' ', u2.`last_name`) AS to_user,
                         to_user_id,
                         `messages`.`message`, `messages`.`timesent`
                    FROM `messages`
                    LEFT JOIN `users` u1 ON u1.`user_id` = `messages`.`from_user_id`
                    LEFT JOIN `users` u2 ON u2.`user_id` = `messages`.`to_user_id`
                   WHERE `to_user_id` = :ida AND `from_user_id` = :idb
                  UNION
                  SELECT CONCAT(u1.`first_name`, ' ', u1.`last_name`) AS from_user,
                         from_user_id,
                         CONCAT(u2.`first_name`, ' ', u2.`last_name`) AS to_user,
                         to_user_id,
                         `messages`.`message`, `messages`.`timesent`
                    FROM `messages`
                    LEFT JOIN `users` u1 ON u1.`user_id` = `messages`.`from_user_id`
                    LEFT JOIN `users` u2 ON u2.`user_id` = `messages`.`to_user_id`
                   WHERE `to_user_id` = :idb AND `from_user_id` = :ida
                   ORDER BY `timesent` ASC";
        return $this->db->select($query,
            array(':ida' => $IDa, ':idb' => $IDb));
    }

    public function getReceivedConversations($uid)
    {
        $query = "SELECT *
                    FROM (
                          SELECT `from_user_id`, u1.`first_name`, u1.`last_name`, `message`, `message_id`
                            FROM `messages`
                                  INNER JOIN `users` u1 ON u1.`user_id`=`messages`.`from_user_id`
                           WHERE `from_user_id` IN
		                         (SELECT DISTINCT `from_user_id`
                                    FROM `messages`
                                   WHERE `to_user_id` = :id)
    				       ORDER BY message_id DESC
    				       ) AS res
                    GROUP BY from_user_id ASC
                    ORDER BY res.message_id";
        return $this->db->select($query, array(':id' => $uid));
    }

    public function getSentConversations($uid)
    {
        $query = "SELECT *
                    FROM (
                          SELECT `to_user_id`, u1.`first_name`, u1.`last_name`, `message`, `message_id`
                            FROM `messages`
                                  INNER JOIN `users` u1 ON u1.`user_id`=`messages`.`to_user_id`
                           WHERE `from_user_id` = :id
    				       ORDER BY message_id DESC
    				       ) AS res
                    GROUP BY to_user_id ASC
                    ORDER BY res.message_id";
        return $this->db->select($query, array(':id' => $uid));
    }

    public function getName($uid)
    {
        return $this->db->select("SELECT first_name, last_name FROM users WHERE user_id = :id", array(':id' => $uid));
    }

    public function newMessage($from, $to, $message)
    {
        return $this->db->insert('messages', array('from_user_id' => $from, 'to_user_id' => $to, 'message' => $message));
    }
}