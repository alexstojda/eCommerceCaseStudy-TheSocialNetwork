<?php

class _Post extends Model
{

    private $post_id;
    private $post_by;
    private $post_by_name;
    private $post_to_name;
    private $post_to;
    private $post_text;
    private $post_image;
    private $date;
    private $privacy;

    public function __construct($tempID = 0)
    {
        parent::__construct();
        if($tempID == 0) {
            header("Location: ../home"); //TODO: change to timeline
        }
        $st = $this->db->select('SELECT * FROM post WHERE post_id = :id', array(
            ':id' => $tempID
        ));
        if(count($st) > 0) {
            $this->setAll($st[0]);
        }
    }

    public function setAll($array) {
        $this->post_id     = $array['post_id'];

        //WILL BE USED FOR WALL LINKS
        $this->post_by     = $array['post_by'];
        $this->post_to     = $array['post_to'];

        //GRABS ACTUAL NAMES FROM DB
        $this->post_by_name = $this->db->select('SELECT CONCAT(first_name,\' \', last_name) AS \'name\' FROM users WHERE user_id = :id', array(
            ':id' => $array['post_by']
        ))[0]['name'];

        $this->post_to_name = $this->db->select('SELECT CONCAT(first_name,\' \', last_name) AS \'name\' FROM users WHERE user_id = :id', array(
            ':id' => $array['post_to']
        ))[0]['name'];
        //FINISH SETTING THE REST
        $this->post_text   = $array['text'];
        $this->post_image  = $array['image_attachment'];
        $this->date        = $array['creation_date'];
        $this->privacy     = $array['privacy'];
    }

    //GETTERS
    public function getPostID()
    {
        return $this->post_id;
    }

    public function getPostBy()
    {
        return $this->post_by;
    }

    public function getPostTo()
    {
        return $this->post_to;
    }

    public function getPostByName()
    {
        return $this->post_by_name;
    }

    public function getPostToName()
    {
        return $this->post_to_name;
    }

    public function getPostText()
    {
        return $this->post_text;
    }

    public function getPostImage()
    {
        return $this->post_image;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPrivacy()
    {
        return $this->privacy;
    }


    //SETTERS
    public function setPostText($newThing)
    {
        $this->post_text = $newThing;
    }

    public function setPrivacy($newThing)
    {
        $this->privacy = $newThing;
    }

    public function setImage($newThing)
    {
        $this->post_image = $newThing;
    }

}
