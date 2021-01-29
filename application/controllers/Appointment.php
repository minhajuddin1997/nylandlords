<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Appointment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->oip_email = "zar@plutoprojects.net";
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_name,role_permission')->join('user', 'user.role_id = role.role_id')->where('user.user_id',$this->session->userdata('user_id'))->get('role')->row();
            $this->permissions = json_decode($permissions->role_permission);
            $this->role_name = $permissions->role_name;
        }

    }

    public function index($form = '', $id = '')
    {

        if ($form == 'edit_form') {
            $data['records'] = $this->db->select('*')->from('appointment_type')->where('appointment_type_id', $id)
                ->get()->row();

        }
        $data['record'] = $this->db->select('*')
            ->from('book_a_call')
            ->where('admin_id',$this->session->userdata('user_id'))
            ->get()->result();
          //  print_r( $data['record']);die;

        $data['depart'] = $this->db->select('*')
            ->from('department')
            ->where('department_status', 0)
            ->get()->result();

        $data['default_time'] = $this->db->where('user_id',$this->session->userdata('user_id'))
            ->from('default_available')->get()->row();

        $data['email'] = $this->db->where('admin_id',$this->session->userdata('user_id'))
            ->from('book_a_call')->order_by("book_a_call_id ", "desc")->get()->result();


        $data['main_content'] = 'admin/appoint/list';
        $general = $data + $this->general();
        $this->load->view('admin/inc/view',$general);
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

    public function add_appoint_type($form = '', $id = '')
    {

        if ($_POST) {
            $content = array(
                'user_id' => $this->session->userdata('user_id'),
                'app_depart' => $this->input->post('app_depart'),
                'app_type' => $this->input->post('app_type'),
                'app_description' => $this->input->post('app_description'),
                'app_time' => $this->input->post('app_time'),
            );

            if ($form == 'edit_form') {

                $result = $this->db->where('appointment_type_id ', $id)
                    ->update('appointment_type', $content);

            } else {
                $id = $this->admin_m->add_data('appointment_type', $content);
            }
            if ($id) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Appointment Detail Add SuccessFully.');
                redirect('Appointment/index');
            } else if ($result) {

                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Appointment Detail Update SuccessFully.');
                redirect('Appointment/index');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong.');
                redirect('Appointment/index');
            }
        }
    }

    public function view_list($form = '', $id = '')
    {

        if ($form == 'edit_form') {
            $data['record'] = $this->db->select('*')->from('appointment_type')->where('appointment_type_id', $id)
                ->get()->row();
        } else {
            $data['records'] = $this->db->select('*')->from('appointment_type')->where('user_id', $this->session->userdata('user_id'))
                ->get()->result();
        }
        $data['main_content'] = 'admin/appoint/all_app_list';
        $general = $data + $this->general();

        $this->load->view('admin/inc/view', $general);
    }

    public function view_list_delete($id)
    {

        if ($this->db->where('appointment_type_id', $id)->from('appointment_type')->delete()) {
            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Appointment Detail Delete SuccessFully.');
            redirect('Appointment/view_list');
        } else {
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong.');
            redirect('Appointment/view_list');
        }

    }

    public function email_setting()
    {
        $data['records']=$this->db->select('*')->from('email_setting')->get()->result();
        $data['main_content'] = 'admin/email_setting/emails';
        $general = $data + $this->general();
        $this->load->view('admin/inc/view', $general);

    }

    public function add_email_msg()
    {
        if ( $this->input->post('message')) {

            $this->form_validation->set_rules('department_id','Department Name','required|is_unique[email_setting.department_id]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'validation Error');
                $data['record'] = $this->db->select('*')->from('department')->get()->result();
                $data['main_content'] = 'admin/email_setting/add_email';
                $general = $data + $this->general();
                $this->load->view('admin/inc/view', $general);
            }else {
                $content = array(
                    'message' => $this->input->post('message'),
                    'department_id' => $this->input->post('department_id'),
                    'user_id' => $this->session->userdata('user_id'),

                );
                $this->admin_m->add_data('email_setting', $content);
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Email Message Add SuccessFully.');
                redirect('Appointment/email_setting');
            }

        }
        else {

            $data['record'] = $this->db->select('*')->from('department')->get()->result();
            $data['main_content'] = 'admin/email_setting/add_email';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        }

    }
    public function delete_email_msg($id){
        $data=$this->db->where('email_setting_id ',$id)->from('email_setting')->delete();

            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', ' Email Message Delete SuccessFully.');
        redirect('Appointment/email_setting');

    }
    public function edit_email_msg($id){


        if( $this->input->post('message')){
        $content = array(
            'message' => $this->input->post('message'),
            'department_id' => $this->input->post('department_id'),
            'user_id' => $this->session->userdata('user_id'),

        );

        $result = $this->db->where('email_setting_id', $id)
            ->update('email_setting', $content);

        $this->session->set_flashdata('msg', '1');
        $this->session->set_flashdata('alert_data', 'Email Message Update SuccessFully.');
        redirect('Appointment/email_setting');
        }
        else{

            $data['departs'] = $this->db->select('*')->from('department')->get()->result();
            $data['record']=$this->db->where('email_setting_id',$id)->from('email_setting')->get()->row();

            $data['main_content'] = 'admin/email_setting/edit_email';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        }
    }
    public function send_email_to_admin($depart_id='',$bookCallId=''){

            $result = $this->db->where('department_id ', $depart_id)
                        ->where('user_id',$this->session->userdata('user_id'))
                        ->from('email_setting')->get()->row();


            $book= $this->db->where('book_a_call_id', $bookCallId)->where('admin_id',$this->session->userdata('user_id'))
                    ->from('book_a_call')->get()->row();

            if($result){

                $section['body'] = '<table>';
                $section['body'] .= '<tr><td>Department : ' . get_single_field('department',array('department_id'=>$result->department_id),'department_name') . '<br><td></tr>';
                $section['body'] .= '<tr><td>Message: ' . $result->message . '<br><td></tr>';
                $section['body'] .= '</table>';
                $section['subject'] = 'Appointment Response';
                $body = $this->load->view('email/template', $section, TRUE);
              
                $clientEmail = send_email($book->client_email, 'Appointment Email ', $body);
                if(!empty($clientEmail)){

                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'Email Successfully Send.');
                    redirect('Appointment/index');
                }
                else{
                    $this->session->set_flashdata('msg', '2');
                    $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong');
                    redirect('Appointment/index');
                }
            }else{
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'SomeThing Went Wrong');
                redirect('Appointment/index');
            }


    }
}