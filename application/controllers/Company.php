<?php

class Company extends CI_Controller{

  public function Index()
	{
		$this->load->view('company/home');
	}




    public function Add_new_trip_S(){
        $this->load->library('form_validation') ;
        $result = '' ;

            // validation na2ees fash5 f lza 7aga zy l date lao m3dyy anhrda w facebook link lazem ykon link
            $this->form_validation->set_rules('trip_name' , 'trip Name' , 'required') ;
            $this->form_validation->set_rules('description' , 'description' , 'required') ;
            $this->form_validation->set_rules('start_date' , 'start_date' , 'required') ;
            $this->form_validation->set_rules('end_date' , 'end_date' , 'required') ;
            $this->form_validation->set_rules('cost' , 'profile cost' , 'required') ;

            $this->form_validation->set_rules('company_ownerID' , 'company_ownerID' , 'required') ;
            $this->form_validation->set_rules('facebook_link' , 'facebook_link' , 'required') ;
            $this->form_validation->set_rules('hotel_link' , 'hotel_link' , 'required') ;
            $this->form_validation->set_rules('trip_categoryID' , 'trip_categoryID' , 'required') ;
            $this->form_validation->set_rules('number_of_days' , 'number_of_days cost' , 'required') ;

            $this->form_validation->set_rules('hotel_rate' , 'hotel_rate' , 'required') ;
            $this->form_validation->set_rules('placeID' , 'placeID' , 'required') ;


            if($this->form_validation->run())
            {
                $this->load->model('Company_model');

                $trip_name = $this->input->post('trip_name') ;
                $description = $this->input->post('description') ;
                $start_date = $this->input->post('start_date') ;
                $end_date = $this->input->post('end_date') ;
                $cost = $this->input->post('cost') ;

                $company_ownerID = $this->input->post('company_ownerID') ;
                $facebook_link = $this->input->post('facebook_link') ;
                $hotel_link = $this->input->post('hotel_link') ;
                $trip_categoryID = $this->input->post('trip_categoryID') ;
                $number_of_days = $this->input->post('number_of_days') ;

                $hotel_rate = $this->input->post('hotel_rate') ;
                $placeID = $this->input->post('placeID') ;


                // kol deh parameters !!! L mafrod yt7to fe array $data w tb3t L array


                $this->Company_model->create_new_trip($trip_name , $description , $start_date , $end_date ,
                    $cost , $company_ownerID,$facebook_link,$hotel_link,
                    $trip_categoryID,$number_of_days,$hotel_rate,$placeID);

                $result = "done" ;
            }

            else{
                $result = validation_errors();
            }

        $data['result'] = $result ;

    }

    public function Add_new_trip_view(){
      $this->load->view('company/add_new_trip');
    }




    public function delete_Trip(){
        $result = '' ;

// leeeh a3mel kdaa w momken ab3t asln L ID bta3 l trip fe L URL w a5do 3la tool b get w a3mlo delete
        if($this->input->post('submit')){
            $id = $this->input->post('trip_id');
            $this->load->model('Company_model');
            $this->Company_model->delete_trip($id);
        }

// A result deh !!! bt7othaa t2leed bas ! xD :D

        $data['result'] = $result ;

        $this->load->view('delete_trip' , $data) ;


    }







}

?>
