<?php

class _Groups extends Model
{

    private $group_id;
    private $name;
    private $privacy;
    private $description;
    private $posts;
    private $members;

    public function __construct($tempID = 0)
    {
        parent::__construct();
    }

    public function init($group)
    {


        $temp = $this->db->select('SELECT * FROM groups WHERE group_id = :to', array(
            ':to' => $group
        ))[0];

        if(!empty($temp)) {
            $this->setName($temp['name']);
            $this->setDescription($temp['description']);
            $this->setPrivacy($temp['privacy']);
            $membersTemp = $this->db->select('SELECT CONCAT( users.first_name,  \' \', users.last_name ) AS  \'name\', users.user_id, user_status
                                            FROM groups
                                            INNER JOIN group_members ON groups.group_id = group_members.group_id
                                            INNER JOIN users ON users.user_id = group_members.user_id
                                            WHERE groups.group_id =:to', array(
                ':to' => $group
            ));

            $this->members = $membersTemp;
            //RETRIEVE ALL POSTS
            $st = $this->db->select('SELECT * FROM group_post WHERE group_id = :to ORDER BY creation_date DESC', array(
                ':to' => $group
            ));

            if (count($st) > 0) {
                $this->posts = $st;
            } else { //no posts on wall ;(
                echo 'Sucks to suck, ' . $this->getName();
            }
        }

    }

public function getGroups($uid){
    return $this->db->select('SELECT name, groups.group_id
                                FROM groups
                          INNER JOIN group_members
                                  ON groups.group_id=group_members.group_id
                               WHERE user_id = :to ', array(
        ':to' => $uid
    ));
   /* */
}

    //Getters
    public function getGroup_id()
    {
        return $$this->group_id;
    }

    public function getMembers()
    {
        return $this->members;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getPrivacy()
    {
        return $this->privacy;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getPosts(){
        return $this->posts;
    }

    //Setters

    public function setName($newThing)
    {
        $this->name = $newThing;
    }

    public function setPrivacy($newThing)
    {
        $this->privacy = $newThing;
    }

    public function setDescription($newThing)
    {
        $this->description = $newThing;
    }
}
