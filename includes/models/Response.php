<?php

class _Response extends Model
{
    private $post_id;
    private $user_id; //maybe whole user if showing who likes what + FB style hover cards
    private $type;    //types : like, dislike, etc. anything available in response_types
    private $g_ = ''; //group prefix

    public function __construct($temp = null)
    {
        parent::__construct();
        //check if group cos fuck having 2 quasi-identical models
        if (isset($_GET['g']) || isset($_POST['is_group'])) {
            $this->g_ = 'group_';
        }

        if (is_array($temp)) { //created only by array cos all call to this model is by post...
            $this->user_id = $temp['user_id'];
            $this->post_id = $temp['post_id'];
            $this->type    = $temp['response'];
        } else
            header('Location: ../timeline');
    }


    public function add() {
        $this->delete(); //Get rid of your other response types on this post. Only one fam
        $response_id = $this->db->select('SELECT response_id FROM response_type WHERE description = :dsc',[
            ':dsc' => $this->type
        ])[0];

        $this->db->insert($this->g_.'post_likes', [
                      'user_id'  => $this->user_id,
            $this->g_.'post_id'  => $this->post_id,
                      'response' => $response_id['response_id']
        ]);
    }

    //You want to unlike your like? do this
    public function delete()
    {//Why not specify response type : I call this on every new like thing to unset previous crap. that with ajax should = right counters.
        $this->db->delete($this->g_.'post_likes','user_id = '.$this->user_id.' AND '.$this->g_.'post_id = '.$this->post_id);
    }

    //GETTERS
    public function getUid()
    {
        return $this->user_id;
    }

    public function getPid()
    {
        return $this->post_id;
    }

    public function getType()
    {
        return $this->type;
    }
}
