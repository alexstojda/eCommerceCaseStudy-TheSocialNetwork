<?php

class _Post extends Model
{

    private $post_id;
    private $post_by;
    private $post_by_name;
    private $post_by_img;
    private $post_to_name;
    private $post_to;
    private $post_text;
    private $post_image;
    private $date;
    private $privacy;
    private $comments;

    public function __construct($temp = null)
    {
        parent::__construct();

        if (is_array($temp)) {
            $this->db->insert('post', [
                'post_by' => $temp['from'],
                'post_to' => $temp['to'],
                'text' => $temp['text'],
                'image_attachment' => $temp['image'],
                'parent_id' => $temp['parent'],
                'privacy' => $temp['privacy']
            ]);
        } elseif (isset($temp)) {
            $st = $this->db->select('SELECT * FROM post WHERE post_id = :id', array(
                ':id' => $temp));
            if (count($st) > 0)
                $this->setAll($st[0]);
        }
            //header('Location: ../timeline');
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
        $this->setComments();

        $this->post_by_img = $this->db->select('SELECT profile_picture FROM users WHERE user_id = :id', array(
            ':id' => $array['post_by']
        ))[0]['profile_picture'];
    }

    public function setComments() {
        $st = $this->db->select('SELECT * FROM post WHERE parent_id = :id', array(
            ':id' => $this->post_id));
        if (count($st) > 0) {
            foreach($st as $post) {
                $this->comments[] = new self($post['post_id']);
            }
        }
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

    public function getPostByImg()
    {
        return $this->post_by_img;
    }

    public function getPostText()
    {
        return $this->post_text;
    }

    public function setPostText($newThing)
    {
        $this->post_text = $newThing;
    }

    public function getPostImage()
    {
        return $this->post_image;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getComments()
    {
        return $this->comments;
    }

    //SETTERS

    public function getPrivacy()
    {
        return $this->privacy;
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
