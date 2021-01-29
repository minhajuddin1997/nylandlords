<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Role extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_permission')->join('user','user.role_id = role.role_id')->where('user.user_id',$this->session->userdata('user_id'))->get('role')->row()->role_permission;
            $this->permissions = json_decode($permissions);
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

    public function index() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (!in_array('viewRole',$this->permissions)) {
            redirect('admin');
        }
        $data['records'] = $this->db->select('role_id, role_name')->where('role_status',0)->get('role')->result();
        $data['main_content'] = 'admin/role/list';
        $general = $data + $this->general();
        $this->load->view('admin/inc/view',$general);
    }

    public function add()
    {
        if($this->session->userdata('user_active')){
            if (!in_array('createRole',$this->permissions)) {
                redirect('admin');
            }
            $data['main_content'] = 'admin/role/add';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view',$general);
        }
        else{
            redirect('login');
        }
    }

    public function add_data()
    {
        if($this->session->userdata('user_active')){
            if ($this->input->post()) {
                $this->form_validation->set_rules('role_name','Role Name','trim|required|is_unique[role.role_name]');
                $this->form_validation->set_rules('role_permission[]','Permissions','trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $content = [
                        'role_name' => $this->input->post('role_name'),
                        'role_permission' => json_encode($this->input->post('role_permission')),
                    ];
                    $this->db->insert('role',$content);
                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'Added Successfully');
                    redirect('role','refresh');
                }
                else {
                    $this->add();
                }
            }
        }
        else{
            redirect('login');
        }
    }

    public function edit($id)
    {
        if($this->session->userdata('user_active')){
            if (!in_array('updateRole',$this->permissions)) {
                redirect('admin');
            }
            $data['record'] = $this->db->where(['role_status' => 0, 'role_id' => $id])->get('role')->row();
            $data['main_content'] = 'admin/role/edit';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view',$general);
        }
        else{
            redirect('login');
        }
    }

    public function update_data($id)
    {
        if($this->session->userdata('user_active')){
            if ($this->input->post()) {
                $this->form_validation->set_rules('role_name','Role Name','trim|required');
                $this->form_validation->set_rules('role_permission[]','Permissions','trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $content = [
                        'role_name' => $this->input->post('role_name'),
                        'role_permission' => json_encode($this->input->post('role_permission')),
                    ];
                    $this->db->update('role',$content, ['role_id' => $id]);
                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'Updated Successfully');
                    redirect('role','refresh');
                }
                else {
                    $this->edit($id);
                }
            }
        }
        else{
            redirect('login');
        }
    }

    public function delete($id)
    {
        if($this->session->userdata('user_active')){
            if (!in_array('deleteRole',$this->permissions)) {
                redirect('admin');
            }
            $result = $this->db->delete('role',array('role_id' => $id));
            if($result){
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Deleted Successfully.');
            }else{
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Delete Failed');
            }
            redirect('role','refresh');
        }
        else{
            redirect('login');
        }
    }
}
?>