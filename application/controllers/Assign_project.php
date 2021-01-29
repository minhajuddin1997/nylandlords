<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Assign_project extends CI_Controller
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

    public function index()
    {
        if ($this->session->userdata('user_id')) {
//            if (!in_array('viewAssignProjects', $this->permissions)) {
//                redirect('admin');
//            }

            $assign_project = $this->db->select('ap.assign_project_id, cp.project_name, cp.client_projects_id, ap.delivery_status, u.user_name, ap.development_status_id, ap.assign_project_priority, ap.assign_project_percentage, ap.assign_project_delivery_date, ap.assign_project_date')
                ->join('client_projects as cp', 'cp.client_projects_id = ap.client_projects_id')
                ->join('user as u', 'u.user_id = ap.assign_project_lead')
                ->join('assign_project_user as apu', 'apu.assign_project_id = ap.assign_project_id');

            if ($this->role_name == 'Production' || $this->role_name == 'SMM') {
                $assign_project = $assign_project->group_start()->or_where(['ap.assign_project_lead' => $this->session->userdata('user_id'), 'apu.user_id' => $this->session->userdata('user_id')])->group_end();

            }

            if ($this->input->get('id')) {
                $assign_project = $assign_project->where(['ap.assign_project_status' => 0, 'ap.delivery_status !=' => 'Final Delivery', 'ap.assign_project_id' => $this->input->get('id')]);

            }

            else {
                $assign_project = $assign_project->where(['ap.assign_project_status' => 0, 'ap.delivery_status !=' => 'Final Delivery']);

            }
            if($this->role_name == 'admin'){
                $assign_projects = $assign_project->group_by('ap.assign_project_id')
                    ->get('assign_project as ap')->result_array();
            }
            else {
                $assign_projects = $assign_project->group_by('ap.assign_project_id')
                    ->get('assign_project as ap')->result_array();
            }
            $records = [];
            foreach ($assign_projects as $projects) {
                $records [] = [
                    'assign_project_id' => $projects['assign_project_id'],
                    'project_name' => $projects['project_name'],
                    'user_name' => $projects['user_name'],
                    'development_status_id' => $projects['development_status_id'],
                    'delivery_status' => $projects['delivery_status'],
                    'assign_project_priority' => $projects['assign_project_priority'],
                    'assign_project_percentage' => $projects['assign_project_percentage'],
                    'assign_project_delivery_date' => $projects['assign_project_delivery_date'],
                    'assign_project_date' => $projects['assign_project_date'],
                    'client_projects_id' => $projects['client_projects_id'],
                    'assign_project_user' => $this->db->select('u.user_name, u.user_image')
                        ->join('user as u', 'u.user_id = apu.user_id', 'left')
                        ->where('apu.assign_project_id', $projects['assign_project_id'])
                        ->get('assign_project_user as apu')->result_array()
                ];
            }
            if ($this->role_name == 'Production') {
                $data['development_status'] = $this->db->select('development_status_id,development_status_name')->where_in('designation_id', json_decode($this->session->userdata('designation_id')))->order_by('development_status_name', 'ASC')->get('development_status')->result();
            } else {
                $data['development_status'] = $this->db->select('development_status_id,development_status_name')->where('development_status_status', 0)->order_by('development_status_name', 'ASC')->get('development_status')->result();
            }
            $data['records'] = $records;


            $data['main_content'] = 'admin/assign_projects/list';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function add()
    {
        if ($this->session->userdata('user_active')) {
            $data['client_projects'] = $this->db->select('client_projects_id, project_name')->where(['client_projects_status' => 0 , 'complete_status' => 'pending'])->get('client_projects')->result();
            $data['users'] = $this->db->select('user_id, user_name')->where('user_status', 0)->get('user')->result();
            $data['development_status'] = $this->db->select('development_status_id, development_status_name')->where('development_status_status', 0)->get('development_status')->result();
            $data['main_content'] = 'admin/assign_projects/add';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }
//
    public function add_data()
    {
        if ($this->session->userdata('user_active')) {
            if ($this->input->post()) {
                $assign_project_percentage = '';
                switch ($this->input->post('delivery_status')) {
                    case 'Brief':
                        $assign_project_percentage = 14.28;
                        break;
                    case 'Proposal':
                        $assign_project_percentage = 28.57;
                        break;
                    case 'Setup Stage':
                        $assign_project_percentage = 42.85;
                        break;
                    case 'In-Progress':
                        $assign_project_percentage = 57.13;
                        break;
                    case 'Initial Delivery':
                        $assign_project_percentage = 71.41;
                        break;
                    case 'Testing':
                        $assign_project_percentage = 85.69;
                        break;
                    case 'Final Delivery':
                        $assign_project_percentage = 100.00;
                        break;
                    default:
                        $assign_project_percentage = 0.00;
                        break;
                }
                $content = [
                    'client_projects_id' => $this->input->post('client_projects_id'),
                    'assign_project_lead' => $this->input->post('assign_project_lead'),
                    'development_status_id' => $this->input->post('development_status_id'),
                    'delivery_status' => $this->input->post('delivery_status'),
                    'assign_project_priority' => $this->input->post('assign_project_priority'),
                    'assign_project_percentage' => $assign_project_percentage,
                    'assign_project_delivery_date' => $this->input->post('assign_project_delivery_date'),
                ];
                $this->db->insert('assign_project', $content);
                $id = $this->db->insert_id();

                if (!empty($this->input->post('user_id'))) {
                    $content = [];
                    $count = count($this->input->post('user_id'));
                    for ($i = 0; $i < $count; $i++) {
                        $content [] = [
                            'assign_project_id' => $id,
                            'user_id' => $this->input->post('user_id')[$i]
                        ];
                    }
                    $this->db->insert_batch('assign_project_user', $content);
                }
                $this->db->update('client_projects',['delivery_status' => $this->input->post('delivery_status')],['client_projects_id' => $this->input->post('client_projects_id')]);
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Added Successfully');
                redirect('assign_project', 'refresh');

            }
        } else {
            redirect('login');
        }
    }
//
    public function edit($id)
    {
        if ($this->session->userdata('user_active')) {
//            if (!in_array('updateAssignProjects',$this->permissions)) {
//                redirect('admin');
//            }
            $data['users'] = $this->db->select('user_id, user_name')->where('user_status', 0)->get('user')->result();
            $data['record'] = $this->db->where(['assign_project_status' => 0, 'assign_project_id' => $id])->get('assign_project')->row();
            $data['members'] = $this->db->select('user_id')->where('assign_project_id',$data['record']->assign_project_id)->get('assign_project_user')->result();
            $data['development_status'] = $this->db->select('development_status_id, development_status_name')->where('development_status_status', 0)->get('development_status')->result();


            $data['main_content'] = 'admin/assign_projects/edit';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }
//
    public function update_data($id)
    {
        if ($this->session->userdata('user_active')) {
            if ($this->input->post()) {
                switch ($this->input->post('delivery_status')) {
                    case 'Brief':
                        $assign_project_percentage = 14.28;
                        break;
                    case 'Proposal':
                        $assign_project_percentage = 28.57;
                        break;
                    case 'Setup Stage':
                        $assign_project_percentage = 42.85;
                        break;
                    case 'In-Progress':
                        $assign_project_percentage = 57.13;
                        break;
                    case 'Initial Delivery':
                        $assign_project_percentage = 71.41;
                        break;
                    case 'Testing':
                        $assign_project_percentage = 85.69;
                        break;
                    case 'Final Delivery':
                        $assign_project_percentage = 100.00;
                        break;
                    default:
                        $assign_project_percentage = 0.00;
                        break;
                }
                $content = [
                        'assign_project_lead' => $this->input->post('assign_project_lead'),
                    'delivery_status' => $this->input->post('delivery_status'),
                    'development_status_id' => $this->input->post('development_status_id'),
                    'assign_project_priority' => $this->input->post('assign_project_priority'),
                    'assign_project_percentage' => $assign_project_percentage,
                    'kanban_status'=>$this->input->post('kanban_status'),
                ];
                if(!empty($this->input->post('assign_project_delivery_date'))) {
                    $content['assign_project_delivery_date'] = $this->input->post('assign_project_delivery_date');
                }
                $this->db->update('assign_project', $content, ['assign_project_id' => $id]);


                    $updateStatus=array(
                        'delivery_status'=>$this->input->post('delivery_status')
                    );
                    $this->db->update('client_projects', $updateStatus, ['client_projects_id' => $this->input->post('client_projects_id'),]);


//                Members update start
                $members = $this->db->select('user_id')->where('assign_project_id',$id)->get('assign_project_user')->result();
                $user_id = $this->input->post('user_id') ?? [];
                $assign_project_id = [];
                if (!empty($members)) {
                    foreach ($members as $member) {
                        if (!in_array($member->user_id,$user_id)) {
                            $this->db->delete('assign_project_user',['user_id' => $member->user_id, 'assign_project_id' => $id]);
                        } else {
                            $assign_project_id [] = $member->user_id;
                        }
                    }
                }
                if (!empty($user_id)) {
                    $length = count($this->input->post('user_id', TRUE));
                    for ($i = 0; $i < $length; $i++) {
                        if (!in_array($this->input->post('user_id', TRUE)[$i] ,$assign_project_id)) {
                            $content2 [] = [
                                'assign_project_id' => $id,
                                'user_id' => $this->input->post('user_id')[$i]
                            ];
                        }
                    }
                    if (!empty($content2)) {
                        $this->db->insert_batch('assign_project_user', $content2);
                    }
                }

//                Members Update End
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Updated Successfully');
                redirect('assign_project', 'refresh');

            }
        } else {
            redirect('login');
        }
    }

    public function project_details($id, $client_projects_id)
    {
        if ($this->session->userdata('user_id')) {
            $data['comments'] = $this->home_m->get_list('assign_project_comment', array('assign_project_id' => $id), '', 'assign_project_comment_id', 'DESC');
            $data['record'] = $this->db->where(['client_projects_status' => 0, 'client_projects_id' => $client_projects_id])->get('client_projects')->row();
          //  print_r($data['record']);die;
            $data['department_answer'] = $this->db->select('department_answer_id')->where(['department_id' => $data['record']->project_type, 'client_projects_id' => $client_projects_id])->get('department_answer')->result();

            $data['main_content'] = 'admin/assign_projects/details';
            $general = $data + $this->general();
            $this->load->view('admin/inc/view', $general);
        } else {
            redirect('login');
        }
    }
//
//    public function reply_comment()
//    {
//        if ($this->session->userdata('user_id')) {
//            $data = array(
//                'assign_project_id' => $this->input->post('project_id'),
//                'user_id' => $this->input->post('sender_id'),
//                'assign_project_comment_text' => $this->input->post('comments_text'),
//            );
//
//            $return_id = $this->db->insert('assign_project_comment', $data);
//            $return_id = $this->db->insert_id();
//
//            if ($return_id) {
//
//                if (!empty($_FILES)) {
//                    if ($_FILES['comments_files_file']['tmp_name']) {
//                        $assign_project_comment_file = [];
//                        for ($j = 0; $j < count($_FILES['comments_files_file']['tmp_name']); $j++) {
//                            if ($_FILES['comments_files_file']['size'][$j] > 0) {
//                                $comments_files_file = multi_files($_FILES['comments_files_file'], $j, './uploads/assign_project_comment_file');
//                                if (!empty($comments_files_file['file_name'])) {
//                                    $assign_project_comment_file [] = [
//                                        'assign_project_comment_id' => $return_id,
//                                        'assign_project_comment_file_name' => $comments_files_file['file_name'],
//                                        'assign_project_comment_file_extension' => $comments_files_file['file_ext'],
//                                    ];
//                                } else {
//                                    $this->session->set_flashdata('msg', '2');
//                                    $this->session->set_flashdata('alert_data', $comments_files_file);
//                                    redirect($_SERVER['HTTP_REFERER']);
//                                }
//                            }
//                        }
//                        if (!empty($assign_project_comment_file)) {
//                            $this->db->insert_batch('assign_project_comment_file', $assign_project_comment_file);
//                        }
//                    }
//
//                    if ($_FILES['comments_images_img']['tmp_name']) {
//                        $assign_project_comment_file = [];
//                        for ($j = 0; $j < count($_FILES['comments_images_img']['tmp_name']); $j++) {
//                            if ($_FILES['comments_images_img']['size'][$j] > 0) {
//                                $comments_images_img = multi_files($_FILES['comments_images_img'], $j, './uploads/assign_project_comment_file');
//                                if (!empty($comments_images_img['file_name'])) {
//                                    $assign_project_comment_file [] = [
//                                        'assign_project_comment_id' => $return_id,
//                                        'assign_project_comment_file_name' => $comments_images_img['file_name'],
//                                        'assign_project_comment_file_extension' => $comments_images_img['file_ext'],
//                                    ];
//                                } else {
//                                    $this->session->set_flashdata('msg', '2');
//                                    $this->session->set_flashdata('alert_data', $comments_images_img);
//                                    redirect($_SERVER['HTTP_REFERER']);
//                                }
//                            }
//                        }
//                        if (!empty($assign_project_comment_file)) {
//                            $this->db->insert_batch('assign_project_comment_file', $assign_project_comment_file);
//                        }
//                    }
//
//                }
//
//                $this->session->set_flashdata('msg', '1');
//                $this->session->set_flashdata('alert_data', 'Comment Successfull');
//
//                redirect($_SERVER['HTTP_REFERER']);
//            } else {
//                $this->session->set_flashdata('msg', '2');
//                $this->session->set_flashdata('alert_data', 'Comment Failed');
//                redirect($_SERVER['HTTP_REFERER']);
//            }
//
//        } else {
//            redirect('login');
//        }
//    }
//
//    public function delete($id)
//    {
//        if($this->session->userdata('user_active')){
//            if (!in_array('deleteAssignProjects',$this->permissions)) {
//                redirect('admin');
//            }
//            $this->db->delete('assign_project_comment',array('assign_project_id' => $id));
//            $this->db->delete('assign_project_user',array('assign_project_id' => $id));
//            $result = $this->db->delete('assign_project',array('assign_project_id' => $id));
//            if($result){
//                $this->session->set_flashdata('msg', '1');
//                $this->session->set_flashdata('alert_data', 'Deleted Successfully.');
//            }else{
//                $this->session->set_flashdata('msg', '2');
//                $this->session->set_flashdata('alert_data', 'Delete Failed');
//            }
//            redirect('assign_project','refresh');
//        }
//        else{
//            redirect('login');
//        }
//    }
//
    public function development_status()
    {
        if ($this->input->get('id')) {
            $this->db->update('assign_project',['development_status_id' => $this->input->get('status')],['assign_project_id' => $this->input->get('id')]);
            echo json_encode('Development Status Updated Successfully');
        }
    }
//
    public function delivery_status()
    {
        if ($this->input->get('id')) {
            $this->db->update('client_projects',['delivery_status' => $this->input->get('status')],['client_projects_id' => $this->input->get('id')]);
            $assign_project_percentage = '';
            switch ($this->input->get('status')) {
                case 'Brief':
                    $assign_project_percentage = 14.28;
                    break;
                case 'Proposal':
                    $assign_project_percentage = 28.57;
                    break;
                case 'Setup Stage':
                    $assign_project_percentage = 42.85;
                    break;
                case 'In-Progress':
                    $assign_project_percentage = 57.13;
                    break;
                case 'Initial Delivery':
                    $assign_project_percentage = 71.41;
                    break;
                case 'Testing':
                    $assign_project_percentage = 85.69;
                    break;
                case 'Final Delivery':
                    $assign_project_percentage = 100.00;
                    break;
                default:
                    $assign_project_percentage = 0.00;
                    break;
            }
            $content = [
                'delivery_status' => $this->input->get('status'),
                'assign_project_percentage' => $assign_project_percentage
            ];
            $this->db->update('assign_project',$content,['client_projects_id' => $this->input->get('id')]);
            echo json_encode('Delivery Status Updated Successfully.');
        }
    }
//
//    public function delivery_date()
//    {
//        if ($this->input->post('assign_project_id')) {
//            $this->db->update('assign_project',['assign_project_delivery_date' => $this->input->post('assign_project_delivery_date')],['assign_project_id' => $this->input->post('assign_project_id')]);
//            echo json_encode('Delivery Date Updated Successfully');
//        }
//    }
//
//    public function department_answer($id,$department_id)
//    {
//        $data['project_name'] = $this->db->select('project_name')->where('client_projects_id',$id)->get('client_projects')->row()->project_name;
//        $data['department_answer'] = $this->db->join('department as d','d.department_id = da.department_id')
//            ->join('department_question as dq','dq.department_question_id = da.department_question_id')
//            ->where(['da.department_id' => $department_id, 'da.client_projects_id' => $id])->get('department_answer as da')->result();
//        $general = $data + $this->general();
//        $this->load->view('front/client_projects/department_answer',$general);
//    }
//
//}
}

?>