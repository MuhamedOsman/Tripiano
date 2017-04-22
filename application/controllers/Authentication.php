<?php


class authentication extends CI_Controller{

    public function sign_up_view()
    {
        $this->load->view('Sign_up_users' ) ;
    }

    public function sign_up_users()
    {
        $this->load->library('form_validation') ;
        $result = '' ;

            $this->form_validation->set_rules('user_name' , 'user_name' , 'required|is_unique[users.user_name]') ;
            $this->form_validation->set_rules('password' ,  'password' , 'required|min_length[6]') ;
            $this->form_validation->set_rules('email' , 'Email' , 'required|valid_email|is_unique[users.email]') ;
            $this->form_validation->set_rules('mobile_number' , 'mobile_Number' , 'required') ;
            $this->form_validation->set_rules('profile_picture' , 'profile picture' , 'required') ;

            if($this->form_validation->run())
            {
                $this->load->model('Enter');
                $user_name = $this->input->post('user_name') ;
                $password = $this->input->post('password') ;
                $email = $this->input->post('email') ;
                $mobile_number = $this->input->post('mobile_number') ;
                $profile_picture = $this->input->post('profile_picture') ;
                $token = md5($password);

                $this->Enter->sign_up_users($user_name,$password,$email,$mobile_number,$profile_picture,$token) ;

                $result = "done" ;
            }

            else{
                $result = validation_errors();
            }

            $data = array('result'=>$result);


          echo json_encode($data);



       // $data['result'] = $result ;




    }


    public function Sign_up_company()
    {

        $this->load->library('form_validation') ;
        $result = '' ;

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('user_name' , 'user_name' , 'required|is_unique[companies.user_name]') ;
            $this->form_validation->set_rules('password' , 'password' , 'required|min_length[6]') ;
            $this->form_validation->set_rules('email' , 'Email' , 'required|valid_email|is_unique[companies.email]') ;
            $this->form_validation->set_rules('mobile_number' , 'mobile_Number' , 'required') ;

            $this->form_validation->set_rules('address' , 'Address' , 'required') ;
            $this->form_validation->set_rules('facebook_link' , 'Facebook Link' , 'required') ;
            $this->form_validation->set_rules('website_link' , 'Website Link' , 'required') ;

            if($this->form_validation->run())
            {
                $this->load->model('Enter');

                $user_name = $this->input->post('user_name') ;
                $password = $this->input->post('password') ;
                $email = $this->input->post('email') ;
                $mobile_number = $this->input->post('mobile_number') ;

                $address = $this->input->post('address') ;
                $facebook_link = $this->input->post('facebook_link') ;
                $website_link = $this->input->post('website_link') ;


                $this->Enter->sign_up_company($user_name,$password,$email,$mobile_number, $address,$facebook_link,$website_link) ;

                $result = "done" ;
            }

            else{
                $result = validation_errors();
            }
        }

        $data['result'] = $result ;

        $this->load->view('Sign_up_company' , $data) ;


    }

    public function Sign_in_user()
    {

        $this->load->library('form_validation') ;
        $result = '' ;

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('email' , 'Email' , 'required') ;
            $this->form_validation->set_rules('password' , 'password' , 'required|min_length[6]') ;


            if($this->form_validation->run())
            {
                $this->load->model('Enter');

                $email = $this->input->post('email') ;
                $password = $this->input->post('password') ;

               $res = $this->Enter->Sign_in_user($email ,$password) ;

               if($res != false ) $result = "done" ;

               else $result="8alat L kalam dh ya keber" ;

            }

            else{
                $result = validation_errors();
            }
        }

        $data['result'] = $result ;

        $this->load->view('Sign_in_user' , $data) ;


    }

    public function Sign_in_company()
    {

        $this->load->library('form_validation') ;
        $result = '' ;

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('email' , 'Email' , 'required') ;
            $this->form_validation->set_rules('password' , 'password' , 'required|min_length[6]') ;


            if($this->form_validation->run())
            {
                $this->load->model('Enter');

                $email = $this->input->post('email') ;
                $password = $this->input->post('password') ;

                $res = $this->Enter->Sign_in_company($email,$password) ;

                if($res != false ) $result = "done" ;

                else $result="8alat L kalam dh ya keber" ;

            }

            else{
                $result = validation_errors();
            }
        }

        $data['result'] = $result ;

        $this->load->view('Sign_in_company' , $data) ;


    }

    public function Forgot_password()
    {
        $this->load->library('form_validation');
        $result = '';
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('email', 'email', 'required');
            if ($this->form_validation->run()) {

                $config['protocol'] = 'smtp';
                $config['smtp_host']='ssl://smtp.gmail.com';
                $config['smtp_user']='muhamedosman1297@gmail.com';
                $config['smtp_pass']='//TODO';
                $config['smtp_port']=465;


                $this->load->library('email' , $config);
                $this->email->set_newline("\r\n") ;

                $this->email->from('muhamedosman1297@gmail.com', "Site");
                $this->email->to($this->input->post('email'));
                $this->email->subject('Reset Your Password');

                $this->load->model('Enter');
                $token = $this->Enter->get_token($this->input->post('email'));

                $message = "hello" ;
              //  $message = "<p>This email has been sent as a request to reset our password</p>";
                //  $message.= "<p><a href='http://localhost/project/index.php/Authentication/Reset_password/".$token."'> Click here </a>if you want to reset your password, if not, then ignore</p>";

                $this->email->message($message);


                if ($this->email->send()) {
                    $result = "the email sent ! ";
                } else {
                    $result = $this->email->print_debugger() ;
                }
            } else {
                $result = "this mail is not in our DataBase !";
            }


        }

        $data['result'] = $result;

        $this->load->view('Forgot_password', $data);


    }

    public function Reset_password()
    {
        $result ='' ;
        $this->load->library('form_validation') ;
        if($this->input->Post('submit'))
        {
            $this->form_validation->set_rules('password' , 'password' , 'required|min_length[6]') ;
            $this->form_validation->set_rules('password2' , 'password' , 'required|matches[password]|min_length[6]') ;
            if($this->form_validation->run())
            {
                $token = $this->input->get('token') ;

                $new_password = $this->input->post('password') ;
                $this->load->model('Enter') ;
                $check = $this->Enter->Reset_password($token , $new_password) ;

                if($check == 0) { $result = "can't find matched account ! " ; }

                else {
                    $result = "done";
                }
            }

            else{
                $result = 'error in the form ! ' ;
            }

        }

        $data['result'] = $result ;

        $this->load->view('Reset_password' , $data) ;

    }



}

?>
