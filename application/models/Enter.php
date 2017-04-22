<?php

class enter extends CI_Model{

    public function sign_up_users($user_name , $password , $email , $mobile_number , $profile_picture , $token)
    {
        $user['user_name'] = $user_name ;
        $user['password'] = $password ;
        $user['email'] = $email ;
        $user['mobile_number'] = $mobile_number ;
        $user['profile_picture'] = $profile_picture ;
        $user['token'] = $token ;

        $this->db->insert('users' , $user) ;
    }

    public function sign_up_company($user_name , $password , $email , $mobile_number , $address , $facebook_link , $website_link)
    {
        $user['user_name'] = $user_name ;
        $user['password'] = $password ;
        $user['email'] = $email ;
        $user['mobile_number'] = $mobile_number ;
        $user['address'] = $address;
        $user['facebook_link'] = $facebook_link ;
        $user['website_link'] = $website_link ;

        $this->db->insert('companies' , $user) ;
    }

    public function sign_in_user($email , $password)
    {
        $user['email'] = $email ;
        $user['password'] = $password ;

        $this->db->select('id') ;
        $this->db->where('email' , $email) ;
        $this->db->where('password' , $password ) ;
        $query = $this->db->get('users') ;

        return $query->result() ;
    }

    public function sign_in_company($email , $password)
    {
        $user['email'] = $email ;
        $user['password'] = $password ;

        $this->db->select('id') ;
        $this->db->where('email' , $email) ;
        $this->db->where('password' , $password ) ;
        $query = $this->db->get('companies') ;

        return $query->result() ;
    }

    public function get_token($email)
    {
        $this->db->select('token') ;
        $this->db->where('email' , $email) ;
        $query = $this->db->get('users') ;
        return $query->result() ;
    }

    public function Reset_password($token , $new_password)
    {
        $new_token = md5($new_password) ;
        $data['token'] = $new_token ;
        $data['password'] = $new_password ;


        $this->db->where('token' , $token) ;
        $this->db->update('users', $data) ;

        $this->db->where('token' , $new_token) ;
        $query = $this->db->get('users') ;


        return $query->num_rows() ;

    }





}

?>