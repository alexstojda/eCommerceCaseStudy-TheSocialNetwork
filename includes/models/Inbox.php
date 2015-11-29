<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-19
 * Time: 5:28 PM
 */
class _Inbox extends Model
{

    /**
     * _inbox constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets all the messages sent between two users in reverse chronological order
     * @param $IDa Int User_ID of the first person in the conversation
     * @param $IDb Int User_ID of the second person in the conversation
     * @return array An array of messages sent between $IDa and $IDb in reverse chronological order
     */
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

    /**
     * Gets a list of the conversations received by the given ID
     * @param $uid int The ID of the user receiving the conversations
     * @return array Array of the conversations
     */
    public function getReceivedConversations($uid)
    {
        $query = "SELECT
                      `from_user_id`,
                      u1.`first_name`,
                      u1.`last_name`,
                      `message`,
                      `message_id`
                    FROM messages
                      INNER JOIN users u1 ON u1.user_id = messages.from_user_id
                    WHERE message_id IN
                          (SELECT Max(message_id)
                           FROM messages
                           WHERE to_user_id = :id
                           GROUP BY from_user_id)";
        return $this->db->select($query, array(':id' => $uid));
    }

    /**
     * Gets a list of the conversations sent by the given ID
     * @param $uid int the ID of the user sending the conversations
     * @return Array Array of the conversations
     */
    public function getSentConversations($uid)
    {
        $query = "SELECT
                      `to_user_id`,
                      u1.`first_name`,
                      u1.`last_name`,
                      `message`,
                      `message_id`
                    FROM messages
                      INNER JOIN users u1 ON u1.user_id = messages.to_user_id
                    WHERE message_id IN
                          (SELECT Max(message_id)
                           FROM messages
                           WHERE from_user_id = :id
                           GROUP BY to_user_id)";
        return $this->db->select($query, array(':id' => $uid));
    }

    /**
     * Gets the name of the userID
     * @param $uid Int ID of the user
     * @return Array indexed with 'first_name' and 'last_name'
     */
    public function getName($uid)
    {
        return $this->db->select("SELECT first_name, last_name FROM users WHERE user_id = :id", array(':id' => $uid));
    }

    /**
     * Sends new $message from $from to $to returns true if successful
     * @param $from int the ID of the user sending the message
     * @param $to int the ID of the user received the message
     * @param $message string the Content of the message
     * @return bool True if successful, False otherwise.
     */
    public function newMessage($from, $to, $message)
    {
        return $this->db->insert('messages', array('from_user_id' => $from, 'to_user_id' => $to, 'message' => $message));
    }
}