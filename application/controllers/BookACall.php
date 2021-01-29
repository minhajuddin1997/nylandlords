<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class BookACall extends CI_Controller
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

        $con = $this->db->select('*')
            ->from('default_available')
            ->where('to_date <=', $this->input->post('date'))
            ->where('from_date >=', $this->input->post('date'))
            ->where('user_id', $this->input->post('admin_id'))
            ->get()->result();

//          ->or_where('from_time',$this->input->get('time'))
        if (empty($con)) {
//            redirect('Home/get_support_chat_list');
            $json = 'Admin not Available This Day and Time';
            echo json_encode($json, true);
        } else {

            $data = array(
                'admin_id' => $this->input->post('admin_id'),
                'client_id' => $this->session->userdata('client_id'),
                'client_name' => $this->input->post('client_name'),
                'client_email' => $this->input->post('client_email'),
                'client_phone' => $this->input->post('client_phone'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'app_desc' => $this->input->post('app_desc'),

                'app_time' => $this->input->post('app_time'),
                'appoint_type_id' => $this->input->post('appoint_type_id'),
                'app_description' => $this->input->post('app_description'),
                'app_type' => $this->input->post('app_type'),
            );
            $id = $this->admin_m->add_data('book_a_call', $data);
            if ($id) {
                $section['body'] = '<table>';
                $section['body'] .= '<tr><td>Client Name: ' . $this->input->post('client_name') . '<br><td></tr>';
                $section['body'] .= '<tr><td>client email: ' . $this->input->post('client_email') . '<br><td></tr>';
                $section['body'] .= '<tr><td>client Phone: ' . $this->input->post('client_phone') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Date : ' . $this->input->post('date') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Time : ' . $this->input->post('time') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Appointment Type : ' . $this->admin_m->get_single_field('department', array('department_id' => $this->input->post('appoint_type_id')), 'department_name') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Appointment Description : ' . $this->input->post('app_description') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Appointment Total Time : ' . $this->input->post('app_time') . '<br><td></tr>';
                $section['body'] .= '<tr><td> Description (Additional): ' . $this->input->post('app_desc') . '<br><td></tr>';

                $section['body'] .='<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'] .= '</table>';
                $section['subject'] = 'Client Appointment';
                $body = $this->load->view('email/template', $section, TRUE);
                $result = send_email($this->oip_email, 'Appointment Email', $body);

                $json = 'success';
                echo json_encode($json, true);

            }
        }

    }

    public function getAppType()
    {
        if ($this->input->post('app_id', true)) {
            $data = $this->db->select('*')->from('appointment_type')
                ->where('appointment_type_id', $this->input->post('app_id', true))->get()->row();
            echo json_encode($data, true);
        }
    }

    public function getResultBook()
    {
        if ($this->input->post('id')) {

            $data = $this->db->select('*')
                ->from('book_a_call b')
                ->join('department d', 'b.appoint_type_id = d.department_id')
                ->where('book_a_call_id', $this->input->post('id'))
                ->get()->row();
            echo json_encode($data, true);
        }

    }
}
