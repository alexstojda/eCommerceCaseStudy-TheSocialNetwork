<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/25/2015
 * Time: 10:51 PM
 */

class _Search extends Model
{
    private $foundUsers;
    private $foundGroups;

    public function searchUsers(){
        $st =  $this->db->select('SELECT * FROM `users` WHERE first_name like :search OR last_name like :search OR phone like :search OR email like :search  ',
            [ ':search'   => "%".$_POST['search']."%" ]);

        if(count($st)>0){
            return $st;
        }
        else
            return null;
    }
    public function searchGroups(){
        $st =  $this->db->select('SELECT * FROM `groups` WHERE name like :search',
            [ ':search'   => "%".$_POST['search']."%" ]);

        if(count($st)>0){
            return $st;
        }
        else
            return null;
    }



    public function getFoundUsers(){
        return $this->foundUsers;
    }
    public function getFoundGroups(){
        return $this->foundGroups;
    }

    public function setFoundUsers($array){
       $this->foundUsers = $array;
    }
    public function setFoundGroups($array){
        $this->foundGroups = $array;
    }
}