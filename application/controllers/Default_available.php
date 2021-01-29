<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Default_available	extends CI_Controller
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
    public function index($id=''){
        $data=array(
            'user_id'=>$this->session->userdata('user_id'),

            'to_date'=>$this->input->post('to_date'),
            'from_date'=>$this->input->post('from_date'),
            'to_time'=>$this->input->post('to_time'),
            'from_time'=>$this->input->post('from_time'),

        );

        $rec=$this->db->where('user_id ',$id)
                ->from('default_available')->get()->row();
        if(!empty($rec)){

            $result = $this->db->where('default_available_id  ',$rec->default_available_id)
                ->update('default_available', $data);
            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Date and Time Update SuccessFully.');
            redirect('Appointment/index');
        }
        else {

            $id = $this->admin_m->add_data('default_available', $data);
            if ($id) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Date and Time Add SuccessFully.');
                redirect('Appointment/index');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong.');
                redirect('Appointment/index');
            }
        }

    }
    public function general()
    {
        $data['site_title'] = $this->admin_m->get_single_field('settings','','site_title');
        $data['header_logo'] = $this->admin_m->get_single_field('settings','','header_logo');
        $data['fav_icon'] = $this->admin_m->get_single_field('settings','','fav_icon');
        $data['phone_no'] = $this->admin_m->get_single_field('settings','','phone_no');
        $data['email_add'] = $this->admin_m->get_single_field('settings','','email_add');
        $data['address'] = $this->admin_m->get_single_field('settings','','address');
        $data['user_name'] = $this->admin_m->get_single_field('user','','user_name');
        $data['user_image'] = $this->admin_m->get_single_field('user','','user_image');


        return $data;
    }
}