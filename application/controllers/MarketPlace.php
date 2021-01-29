<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(1);

class MarketPlace extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }
    
    public function general()
    {
    $data['site_title'] = $this->home_m->get_single_field('settings','','site_title');
    $data['header_logo'] = $this->home_m->get_single_field('settings','','header_logo');
    $data['footer_logo'] = $this->home_m->get_single_field('settings','','footer_logo');
    $data['fav_icon'] = $this->home_m->get_single_field('settings','','fav_icon');
    $data['phone_no'] = $this->home_m->get_single_field('settings','','phone_no');
    $data['address'] = $this->home_m->get_single_field('settings','','address');
    $data['footer_tagline'] = $this->home_m->get_single_field('settings','','footer_tagline');
    $data['email_add'] = $this->admin_m->get_single_field('settings','','email_add');
    return $data;
    }

    

    public function index()
    {
       if ($this->session->userdata('client_id')) {
            $data['records'] = $this->admin_m->get_list('services');
            $data['main_content'] = 'front/marketplace/list';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    
    public function view($id){
        if ($this->session->userdata('client_id')) {
            if(!empty($id)){
                $data['records'] = $this->admin_m->get_list('services',array('id'=>$id));
                $data['packages'] = $this->admin_m->get_list('packages');
            }
            $data['main_content'] = 'front/marketplace/view';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    
    public function add_data($inquiry){
      if ($this->session->userdata('client_id')) {
            $data['inquiry'] = $this->admin_m->get_list('services',array('id'=>$inquiry));
            $content = array(
              'client_id' => $this->session->userdata('client_id'),
              'inquiry_name' => $data['inquiry'][0]->name,
              'inquiry_type' => 29,
              'inquiry_summary' => $data['inquiry'][0]->description,
              'appointment_date' => '',
              'appointment_start_time' => '',
              'appointment_end_time' => '',
              'delivery_status' => 'Free Consultation',
              'payment_due' => 'Yes',
              'website_url' => 'None',
              'uploaded_month' => date('m'),
              'uploaded_year' => date('Y'),
              'ip_address' => $_SERVER['REMOTE_ADDR'],
              'os' => php_uname(),
              'browser' => $this->agent->browser(),
              'complete_status' => 'Pending',
              'client_inquiry_status' => '0',
            ); 
            $insert = $this->admin_m->add_data('client_inquiry',$content);
            if($insert){
                $data['records'] = $this->admin_m->get_list('client_inquiry', array('client_inquiry_id'=>$insert));
               	$this->session->set_flashdata('msg', '1');
			    $this->session->set_flashdata('alert_data', 'Inquiry Added');
                redirect('client-list/client_inquiry');
            }
      }
    }
    
    public function backgroundCheck(){
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://stage.rentprep.com/api/smartmove/application/create',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "Customer": {
                "referenceId": "1243"
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'x-apiKey: 8fce01db-c17c-4117-845e-aa635046b666',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $data['records'] = json_decode($response);
        $data['main_content'] = 'front/marketplace/backgroundCheck';
        $general = $data + $this->general();
        $this->load->view('front/inc/view', $general);
    }
    
    
    public function pays($inquiry, $id){
        if ($this->session->userdata('client_id')) {
            $data['inquiry'] = $this->admin_m->get_list('services',array('id'=>$inquiry));
            $data['records'] = $this->admin_m->get_list('packages',array('id'=>$id));
   
            $content = array(
              'client_id' => $this->session->userdata('client_id'),
              'inquiry_name' => $data['inquiry'][0]->name,
              'inquiry_type' => 29,
              'inquiry_summary' => $data['inquiry'][0]->description,
              'inquiry_price' => $data['records'][0]->package_price,
              'inquiry_paid' => '0',
              'inquiry_balance' => $data['records'][0]->package_price,
              'delivery_status' => 'Pending',
              'payment_due' => 'Yes',
              'website_url' => 'None',
              'uploaded_month' => date('m'),
              'uploaded_year' => date('Y'),
              'ip_address' => $_SERVER['REMOTE_ADDR'],
              'os' => php_uname(),
              'browser' => $this->agent->browser(),
              'complete_status' => 'Pending',
              'client_inquiry_status' => '0',
            );
            $insert = $this->admin_m->add_data('client_inquiry',$content);
            if($insert){
                $data['records'] = $this->admin_m->get_list('client_inquiry', array('client_inquiry_id'=>$insert));
            }
            $data['main_content'] = 'front/stripe/checkout';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    
}
?>