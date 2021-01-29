<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->opi_email = "zar@plutoprojects.net";
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_name,role_permission')->join('user', 'user.role_id = role.role_id')->where('user.user_id', $this->session->userdata('user_id'))->get('role')->row();
            $this->permissions = json_decode($permissions->role_permission);
            $this->role_name = $permissions->role_name;
        }

    }

    public function index()
    {
        if ($this->session->userdata('user_id') == 5) {
            $data['records'] = $this->admin_m->get_list('user');

            $data['main_content'] = 'admin/admins/list';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function view($id)
    {
        if ($this->session->userdata('user_id') == 5) {

            $data['records'] = $this->admin_m->get_list('user', array('user_id' => $id));
            $data['main_content'] = 'admin/admins/view';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata('user_id') == 5) {

            $data['records'] = $this->admin_m->get_list('user', array('user_id' => $id));
            $data['roles'] = $this->db->select('role_id, role_name')->where('role_status', 0)->get('role')->result();
            $data['designations'] = $this->db->select('designation_id,designation_name')->get('designation')->result();
            $data['main_content'] = 'admin/admins/edit';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function add()
    {

        if ($this->session->userdata('user_id') == 5) {
            $data['roles'] = $this->db->select('role_id, role_name')->where('role_status', 0)->get('role')->result();
            $data['designations'] = $this->db->select('designation_id,designation_name')->get('designation')->result();
            $data['main_content'] = 'admin/admins/add';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
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

//    public function add_data()
//    {
//        if ($this->session->userdata('user_id') == 5) {
//            foreach ($_POST as $key => $val) {
//                if (strpos($key, 'slug') !== false) {
//                    $result = check_slug($table, $this->input->post($key));
//                    $data[$key] = $result;
//                } else {
//                    $data[$key] = $this->input->post($key);
//                }
//            }
//
//            if ($_POST['user_email'] == get_single_field('user', array('user_email' => $_POST['user_email']), 'user_email')) {
//                $this->session->set_flashdata('msg', '2');
//                $this->session->set_flashdata('alert_data', 'Admin Already Exists');
//                redirect($_SERVER['HTTP_REFERER']);
//            }
//
//            $data['user_image'] = single_image_upload($_FILES['user_image'], "./uploads/" . "user");
//            $data['user_pass'] = $this->encryption->encrypt($this->input->post('user_pass'));
//
//
//            $id = $this->admin_m->add_data('user', $data);
//
//            if (!empty($id)) {
//                $this->session->set_flashdata('msg', '1');
//                $this->session->set_flashdata('alert_data', 'Added Successfully');
//                redirect('administrator');
//            } else {
//                $this->session->set_flashdata('msg', '2');
//                $this->session->set_flashdata('alert_data', 'Failed To Add');
//                $data['main_content'] = 'admin/admins/add';
//                $general = $data + $this->general();
//                $this->load->view('admin/inc/view', $general);
//            }
//
//        } else {
//            redirect('login');
//        }
//
//    }
    public function add_data()
    {

        if ($this->session->userdata('user_id') == 5) {
      
            if ($_POST['user_email'] == get_single_field('user', array('user_email' => $_POST['user_email']), 'user_email')) {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Email Already Exists');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $data = array(
                'role_id' => $this->input->post('role_id',TRUE),
                'designation_id' => json_encode($this->input->post('designation_id',TRUE)),
                'user_name' => $this->input->post('user_name',TRUE),
                'user_email' => $this->input->post('user_email',TRUE),
                'user_phone' => $this->input->post('user_phone',TRUE),
                'user_pass' => $this->encryption->encrypt($this->input->post('user_pass')),
            );

            $data['user_image'] = single_image_upload($_FILES['user_image'], "./uploads/" . "user");
    
            if (isset($data['user_image']['status'])) {
                $this->session->set_flashdata('msg','2');
                $this->session->set_flashdata('alert_data',$data['user_image']['error']);
            }
            $id = $this->admin_m->add_data('user', $data);
            if (!empty($id)) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Added Successfully');
                redirect('administrator');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Failed To Add');
                $data['main_content'] = 'admin/admins/add';
                $general = $data + $this->general();
                $this->load->view('admin/inc/view', $general);
            }

        } else {
            redirect('login');
        }

    }

    public function delete($id)
    {
        if ($this->session->userdata('user_active')) {
            $data['user_status'] = 1;
            $result = $this->admin_m->update_data('user', $data, array('user_id' => $id));
            if ($result) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Deleted');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Delete Failed');
                redirect($_SERVER['HTTP_REFERER']);
            }

        } else {
            redirect('login');
        }
    }

//    public function update($id)
//    {
//        if ($this->session->userdata('user_id') == 5) {
//            foreach ($_POST as $key => $val) {
//                if (strpos($key, 'slug') !== false) {
//                    $result = check_slug($table, $this->input->post($key));
//                    $data[$key] = $result;
//                } else {
//                    $data[$key] = $this->input->post($key);
//                }
//            }
//
//            $data['user_pass'] = $this->encryption->encrypt($this->input->post('user_pass'));
//
//
//            $id = $this->admin_m->update_data('user', $data, array('user_id' => $id));
//
//            if (!empty($id)) {
//                $this->session->set_flashdata('msg', '1');
//                $this->session->set_flashdata('alert_data', 'Added Successfully');
//                redirect('administrator');
//            } else {
//                $this->session->set_flashdata('msg', '2');
//                $this->session->set_flashdata('alert_data', 'Failed To Add');
//                $data['main_content'] = 'admin/admins/add';
//                $general = $data + $this->general();
//                $this->load->view('admin/inc/view', $general);
//            }
//
//        } else {
//            redirect('login');
//        }
//    }
    public function update($id)
    {
        if ($this->session->userdata('user_id') == 5) {
            $data = array(
                'role_id' => $this->input->post('role_id',TRUE),
                'designation_id' => json_encode($this->input->post('designation_id',TRUE)),
                'user_name' => $this->input->post('user_name',TRUE),
                'user_phone' => $this->input->post('user_phone',TRUE),
                'user_pass' => $this->encryption->encrypt($this->input->post('user_pass')),
            );
            $id = $this->admin_m->update_data('user', $data, array('user_id' => $id));
            if (!empty($id)) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Added Successfully');
                redirect('administrator');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Failed To Add');
                $data['main_content'] = 'admin/admins/add';
                $general = $data + $this->general();
                $this->load->view('admin/inc/view', $general);
            }
        } else {
            redirect('login');
        }
    }
}