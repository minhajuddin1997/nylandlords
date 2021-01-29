<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->oip_email = "zar@plutoprojects.net";
        $this->second = "zar@plutoprojects.net";
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_name,role_permission')->join('user', 'user.role_id = role.role_id')->where('user.user_id', $this->session->userdata('user_id'))->get('role')->row();
            $this->permissions = json_decode($permissions->role_permission);
            $this->role_name = $permissions->role_name;
        }

    }
    public  function index($id=''){

       $this->db->select("*");
       $this->db->where('client_id',$id);
       $res=$this->db->get('logs');
       $data['records']=$res->result();
//       print_r($data);die;
       $data['main_content'] = 'admin/log/list';

        $general = $data + $this->general();
       $this->load->view('admin/inc/view',$general);

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