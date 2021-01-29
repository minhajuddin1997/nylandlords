<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class ClientAppointment	extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->oip_email = "zar@plutoprojects.net";
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_name,role_permission')->join('user', 'user.role_id = role.role_id')->where('user.user_id', $this->session->userdata('user_id'))->get('role')->row();
            $this->permissions = json_decode($permissions->role_permission);
            $this->role_name = $permissions->role_name;
        }

    }
    public function index(){

        $data['records']=$this->db->where('client_id',$this->session->userdata('client_id'))
                            ->from('book_a_call')->get()->result();

        $data['main_content'] = 'front/all_appoint_client/list';
        $general = $data + $this->general();
        $this->load->view('front/inc/view', $general);
    }
    public function general()
    {
        $data['site_title'] = $this->home_m->get_single_field('settings', '', 'site_title');
        $data['header_logo'] = $this->home_m->get_single_field('settings', '', 'header_logo');
        $data['footer_logo'] = $this->home_m->get_single_field('settings', '', 'footer_logo');
        $data['fav_icon'] = $this->home_m->get_single_field('settings', '', 'fav_icon');
        $data['phone_no'] = $this->home_m->get_single_field('settings', '', 'phone_no');
        $data['address'] = $this->home_m->get_single_field('settings', '', 'address');
        $data['footer_tagline'] = $this->home_m->get_single_field('settings', '', 'footer_tagline');
        $data['email_add'] = $this->admin_m->get_single_field('settings', '', 'email_add');

        return $data;
    }
   
}
    ?>