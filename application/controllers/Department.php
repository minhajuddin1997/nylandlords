<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Department extends CI_Controller {
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

    public function add_data()
    {
        if($this->session->userdata('user_active')){
            if ($this->input->post()) {
                $content = [
                    'department_name' => $this->input->post('department_name')
                ];
                $this->db->insert('department',$content);
                $id = $this->db->insert_id();
                if (is_array($this->input->post('question')) && !empty($id)) {
                    $questionLength = count($this->input->post('question'));
                    $content = [];
                    for ($i = 0; $i < $questionLength; $i++) {
                        $content []= [
                            'department_question_text' => $this->input->post('question')[$i],
                            'department_question_type' => $this->input->post('question_type')[$i],
                            'department_question_options' => (!empty($this->input->post('op')[$i]) ? json_encode($this->input->post('op')[$i]) : ''),
                            'department_id' => $id
                        ];
                    }
                    $this->db->insert_batch('department_question',$content);
                }
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Added Successfully');
                redirect('list/department','refresh');
            }
        }
        else{
            redirect('login');
        }
    }

    public function update_data($id)
    {
        if($this->session->userdata('user_active')){
            if ($this->input->post()) {
                $content = [
                    'department_name' => $this->input->post('department_name')
                ];
                $this->db->update('department',$content, ['department_id' => $id]);
//                Department update start
                $departments = $this->db->select('department_question_id')->where('department_id',$id)->get('department_question')->result();
                if (is_array($this->input->post('question')) && !empty($id)) {
                    $questionLength = count($this->input->post('question'));
                    $content = [];
                    for ($i = 0; $i < $questionLength; $i++) {
                        if (!empty($departments[$i]->department_question_id)) {
                            continue;
                        }
                        else {
                            $content = [
                                'department_question_text' => $this->input->post('question')[$i],
                                'department_question_type' => $this->input->post('question_type')[$i],
                                'department_question_options' => (!empty($this->input->post('op')[$i]) ? json_encode($this->input->post('op')[$i]) : ''),
                                'department_id' => $id
                            ];
                        }
                        $this->db->insert('department_question',$content);
                    }
                }
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Updated Successfully');
                redirect('list/department','refresh');
            }
        }
        else{
            redirect('login');
        }
    }

    public function edit($id)
    {
        if($this->session->userdata('user_active')){
            if (!in_array('updateDepartment',$this->permissions)) {
                redirect('admin');
            }
            $data['record'] = $this->db->where(['department_status' => 0, 'department_id' => $id])->get('department')->row();
            $data['departments'] = $this->db->where(['department_question_status' => 0, 'department_id' => $id])->get('department_question')->result();
            $data['main_content'] = 'admin/department/edit';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view',$general);
        }
        else{
            redirect('login');
        }
    }

    public function questions()
    {
        $id = $this->input->get('project_type');
        $department_question = $this->db->where('department_id',$id)->get('department_question')->result();
        echo json_encode($department_question);
    }

    public function client_projects()
    {
        if($this->session->userdata('user_active')){
            if ($this->input->post()) {
                $record = [
                    'client_id' => $this->input->post('client_id'),
                    'delivery_status' => $this->input->post('delivery_status'),
                    'uploaded_month' => $this->input->post('uploaded_month'),
                    'project_name' => $this->input->post('project_name'),
                    'project_price' => $this->input->post('project_price'),
                    'project_paid' => $this->input->post('project_paid'),
                    'project_balance' => $this->input->post('project_balance'),
                    'project_type' => $this->input->post('project_type'),
                    'project_summary' => $this->input->post('project_summary'),
                ];
                $this->db->insert('client_projects',$record);
                $id = $this->db->insert_id();
                foreach ($this->input->post() as $key => $value) {
                    if ($key == 'client_id' || $key == 'delivery_status' || $key == 'uploaded_month' || $key == 'project_name' || $key == 'project_price' || $key == 'project_paid' || $key == 'project_balance' || $key == 'project_type' || $key == 'project_summary') {
                        continue;
                    }
                    $content [] = [
                        'department_question_id' => $key,
                        'department_answer_text' => (is_array($value) ? json_encode($value) : $value),
                        'client_projects_id' => $id,
                        'client_id' => $this->input->post('client_id'),
                        'department_id' => $this->input->post('project_type')
                    ];
                }
                $this->db->insert_batch('department_answer',$content);
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Added Successfully');
                redirect('list/client_projects','refresh');
            }
        }
        else{
            redirect('login');
        }
    }

    public function client_add()
    {
        if($this->session->userdata('client_id')){
            if ($this->input->post()) {
                /*echo "<pre>";
                print_r($_FILES);die();*/
                $record = [
                    'inquiry_name' => $this->input->post('inquiry_name'),
                    'client_id' => $this->input->post('client_id'),
                    'delivery_status' => $this->input->post('delivery_status'),
                    'inquiry_type' => $this->input->post('inquiry_type'),
                    'inquiry_summary' => $this->input->post('inquiry_summary'),
                    'uploaded_month' => $this->input->post('uploaded_month'),
                    'signature_path'=>$this->input->post("image_path"),

                ];
                if(!empty($_FILES['summary_file']['name']))
                {
                    $record['summary_file'] = summary_file_upload($_FILES['summary_file'],"./uploads/"."client_projects");
                    if (isset($record['summary_file']['status']) || $record['summary_file'] == 'error') {
                        $this->session->set_flashdata('msg', '2');
                        $this->session->set_flashdata('alert_data', $record['summary_file']['error']);
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
                $this->db->insert('client_inquiry',$record);
                $id = $this->db->insert_id();
                foreach ($this->input->post() as $key => $value) {
                    if ($key == 'client_id' || $key == 'delivery_status' || $key == 'uploaded_month' || $key == 'inquiry_name' || $key == 'inquiry_type' || $key == 'inquiry_summary') {
                        continue;
                    }
                    $content [] = [
                        'department_question_id' => $key,
                        'department_answer_text' => (is_array($value) ? json_encode($value) : $value),
                        'client_inquiry_id' => $id,
                        'client_id' => $this->input->post('client_id'),
                        'department_id' => $this->input->post('inquiry_type')
                    ];
                }
                $this->db->insert_batch('department_answer',$content);

                $section['body'] = '<table>';
                $section['body'] .='<tr><td>Client Name: <b>'.get_name_by_id("client",$_POST['client_id']).'</b><br><td></tr>';
                $section['body'] .='<tr><td>Inquiry Name: <b>'.$_POST['inquiry_name'].'</b><br><td></tr>';
                $section['body'] .='<tr><td>Inquiry Type: <b>'.get_name_by_id("department",$_POST['inquiry_type']).'</b><br><td></tr>';
                $section['body'] .='<tr><td>Inquiry Summary: '.$_POST['inquiry_summary'].'<br><td></tr>';
                $section['body'] .='<tr><td><br>'.base_url("").'<br></td></tr>';
                $section['body'] .='<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'].= '</table>';
                $section['subject'] = 'New project added by '.get_name_by_id("client",$_POST['client_id']);
                $body = $this->load->view('email/template',$section, TRUE);
                $result = send_email($this->oip_email,'New Inquiry added',$body);
              //  send_email($this->second,'New project added',$body);
                $result = send_email(get_value_by_id("client",$_POST['client_id'],'client_email'),'New project added',$body);

                if(!empty($id))
                {
                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'Added Successfully');
                }
                else
                {
                    $this->session->set_flashdata('msg', '2');
                    $this->session->set_flashdata('alert_data', 'Failed To Add');
                }
            }
            redirect('client-list/client_inquiry','refresh');
        }
        else{
            redirect('login');
        }
    }
}
?>