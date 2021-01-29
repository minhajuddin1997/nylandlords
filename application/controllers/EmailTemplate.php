<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class EmailTemplate extends CI_Controller
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

    public function index()
    {
        $data['records'] = $this->db->from('email_template')
            ->where('user_id', $this->session->userdata('user_id'))->get()->result();
        $data['main_content'] = 'admin/email_temp/list';
        $general = $data + $this->general();
        $this->load->view('admin/inc/view', $general);
    }

    public function general()
    {
        $data['site_title'] = $this->admin_m->get_single_field('settings', '', 'site_title');
        $data['header_logo'] = $this->admin_m->get_single_field('settings', '', 'header_logo');
        $data['fav_icon'] = $this->admin_m->get_single_field('settings', '', 'fav_icon');
        $data['phone_no'] = $this->admin_m->get_single_field('settings', '', 'phone_no');
        $data['email_add'] = $this->admin_m->get_single_field('settings', '', 'email_add');
        $data['address'] = $this->admin_m->get_single_field('settings', '', 'address');
        $data['user_name'] = $this->admin_m->get_single_field('user', '', 'user_name');
        $data['user_image'] = $this->admin_m->get_single_field('user', '', 'user_image');


        return $data;
    }

    public function add_template()
    {
        if ($_POST) {
            $content = array(
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
            );
            $id = $this->admin_m->add_data('email_template', $content);
            if ($id) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Email Template Add Successfully ');
                redirect('EmailTemplate/index');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong');
                redirect('EmailTemplate/index');
            }
        } else {
            $data['main_content'] = 'admin/email_temp/add';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        }
    }

    public function delete_email_template($id)
    {
        if ($id) {
            $result = $this->db->where('email_template_id', $id)->from('email_template')->delete();
            if ($result) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Email Template Delete Successfully ');
                redirect('EmailTemplate/index');
            }
        }
    }

    public function edit_email_template($id)
    {

        if ($_POST) {
            $content = array(
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
            );
            $result = $this->db->where('email_template_id', $id)
                ->update('email_template', $content);
            if ($result) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Email Template Update Successfully ');
                redirect('EmailTemplate/index');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong');
                redirect('EmailTemplate/index');
            }
        } else {
            $data['record'] = $this->db->where('email_template_id', $id)->from('email_template')->get()->row();

            $data['main_content'] = 'admin/email_temp/edit';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        }
    }


}