<?php

class User extends CI_Controller{

    public function Edit_user_profile()
    {
        $result='' ;
        $flag_email= true ;     //to know if the email is unique or not
        $flag = true ;
        $flag_password = true ;

        $id = $this->input->get('id') ;
        echo $id ;
        $data['id'] =$id ;
        if($this->input->post('submit'))
        {
            $this->load->library('form_validation') ;

            if($this->input->post('password'))
            {
                $this->form_validation->set_rules('password' , 'password' , 'min_length[6]') ;
                if($this->form_validation->run()) {
                    $flag_password = true;

                }
                else{
                    echo 'hi' ;
                    $flag_password = false ;
                    $result='the password should be more than 6 digits and Email should be unique and valid  ! ' ;
                }

            }

            if($this->input->post('email'))
            {
                $this->form_validation->set_rules('email' , 'email' , 'is_unique[users.email]|valid_email') ;
                if($this->form_validation->run()) $flag_email = true ;
                else{
                    $flag_email = false ;
                    $result='the password should be more than 6 digits and Email should be unique and valid  !' ;
                }

            }


            if($flag_email == true && $flag_password==true) {


                if ($this->input->post('user_name') != "")
                    $data['user_name'] = $this->input->post('user_name');
                if ($this->input->post('password') != "")
                    $data['password'] = $this->input->post('password');
                if ($this->input->post('email') != "" )
                    $data['email'] = $this->input->post('email');
                if ($this->input->post('mobile_number') != "")
                    $data['mobile_number'] = $this->input->post('mobile_number');
                if ($this->input->post('profile_picture') != "")
                    $data['profile_picture'] = $this->input->post('profile_picture');

                $this->load->model('User_model');
                $this->User_model->Edit_user_profile($id, $data);
                $result = 'done' ;
            }
        }

        $data['result'] = $result ;

        $this->load->view('Edit_user_profile' , $data) ;
    }

    public function Deactivate_account()
    {
        $id = $this->input->get('id') ;
        $this->load->model('User_model') ;
        $this->User_model->Deactivate_account($id)  ;

    }
}

?>