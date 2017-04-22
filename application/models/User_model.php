<?php

class User_model extends CI_Model
{

    public function Edit_user_profile($id , $data)
    {
        $this->db->where('id' , $id) ;
        $this->db->update('users' , $data ) ;
    }


    public function Deactivate_account($id)
    {

        $this->db->where('id' , $id) ;
        $this->db->delete('users') ;

    }

}

?>