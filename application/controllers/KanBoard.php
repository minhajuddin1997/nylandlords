<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KanBoard extends CI_Controller
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
        $data['projects'] = $this->db->where('client_projects_status', 0)->from('client_projects')->get()->result();
        $data['get_assign_result'] = $this->db->where('assign_project_status', 0)->from('assign_project')->get()->result();
        $data['sub_admin_list'] = $this->db->where('user_status', 0)->from('user')->get()->result();
        $data['develop_status'] = $this->db->from('development_status')->get()->result();

//	        $data['main_content'] = 'admin/kanban/list';
//			$general = $data + $this->general();
        $this->load->view('admin/kanban/kan', $data);

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

    public function toDoSumit()
    {

        if ($this->input->post('assign_project_id')) {

            $content = array(
                'client_projects_id' => $this->input->post('project_id'),
                'delivery_status' => $this->input->post('delivery_status'),
                'assign_project_priority' => $this->input->post('assign_project_priority'),
                'kanban_status'=>$this->input->post('dolist'),
                'assign_project_lead' => $this->input->post('sub_admin_id'),
                'development_status_id' => $this->input->post('development_status_id'),
                'assign_project_delivery_date' => $this->input->post('assign_project_delivery_date'),
            );

            $id = $this->home_m->update_data('assign_project', $content, array('assign_project_id' => $this->input->post('assign_project_id')));
            if ($id) {
                echo json_encode("1", true);
            } else {
                echo json_encode("2", true);
            }

        } else {
            $content = array(
                'client_projects_id' => $this->input->post('project_id'),
                'delivery_status' => $this->input->post('delivery_status'),
                'assign_project_priority' => $this->input->post('assign_project_priority'),
                'kanban_status'=>$this->input->post('dolist'),
                'assign_project_lead' => $this->input->post('sub_admin_id'),
                'development_status_id' => $this->input->post('development_status_id'),
                'assign_project_delivery_date' => $this->input->post('assign_project_delivery_date'),
            );

            $id = $this->admin_m->add_data('assign_project', $content);
            $content=array();
            $content = array(
                'assign_project_id' => $id,
                'user_id' => $this->input->post('sub_admin_id')
            );
            $this->admin_m->add_data('assign_project_user', $content);
            if ($id) {
                echo json_encode("1", true);

            } else {
                echo json_encode("2", true);
            }
        }
    }

    public function GetDetailData()
    {
        if ($this->input->post('client_projects_id')) {
            $query = $this->db->select('ap.delivery_status,ap.assign_project_priority,cp.project_name,ap.assign_project_id,ap.client_projects_id,ap.assign_project_lead,ap.development_status_id,ap.assign_project_delivery_date,ap.kanban_status')
                ->from('assign_project  ap')
                ->join('client_projects cp', 'cp.client_projects_id  = ap.client_projects_id')
                ->where('ap.assign_project_id ', $this->input->post('assign_id'))
                ->get()->row();
            echo json_encode($query, true);
        }
    }

    public function delete_card()
    {
        if ($this->input->post('assign_project_id')) {
            $content = array(
                'assign_project_status' => 1,
            );
            $data = $this->home_m->update_data('assign_project', $content, array('assign_project_id' => $this->input->post('assign_project_id')));
            if ($data) {
                echo json_encode("1", true);
            } else {
                echo json_encode("2", true);
            }
        }
    }
    public function statusChange(){
        if($this->input->post('assign_project_id')){

            $content=array(
                'kanban_status' =>$this->input->post('kanban_status')
            );
           $bolean= $this->home_m->update_data('assign_project', $content, array('assign_project_id' => $this->input->post('assign_project_id')));
            if($bolean){
                echo "1";
            }
            else{
               echo  "2";
            }
        }
    }

}

?>