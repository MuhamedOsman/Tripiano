<?php
class Company_model extends CI_Model{

    public function create_new_trip($trip_name , $description , $start_date , $end_date ,
                                    $cost , $company_ownerID,$facebook_link,$hotel_link,$trip_categoryID,$number_of_days,$hotel_rate,$placeID)
    {
        $trip['name'] = $trip_name ;
        $trip['description'] = $description ;
        $trip['start_date'] = $start_date ;
        $trip['end_date'] = $end_date ;
        $trip['cost'] = $cost ;
        $trip['company_ownerID'] = intval($company_ownerID) ;

        $trip['facebook_link'] = $facebook_link ;
        $trip['trip_categoryID'] = intval($trip_categoryID) ;
        $trip['number_of_days'] = $number_of_days ;
        $trip['cost'] = $cost ;
        $trip['hotel_rate'] = $hotel_rate ;
        $trip['placeID'] = intval($placeID) ;

        var_dump($trip);
        $this->db->insert('trips' , $trip) ;
    }

    public function getTrip($tripID){
        $data = $this->db->where('id', $tripID);
        return $data;
    }

    public function Delete_Trip($tripID)
    {


        $this->db->where('id', $tripID);
        $this->db->delete('trips');

    }


}

?>