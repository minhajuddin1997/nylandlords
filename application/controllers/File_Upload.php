<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class File_Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->oip_email = "zar@plutoprojects.net";
        $this->second = "zar@plutoprojects.net";

    }
    public function index(){
        $data['main_content'] = 'front/files_upload/list';
        $this->db->where('client_id',$this->session->userdata('client_id'));
        $rec=$this->db->get('client_only_files');
        $result=$rec->result();
        $data['records']=$result;
        $general = $data + $this->general();
        $this->load->view('front/inc/view',$general);
    }
    public function general()
    {
        $data['site_title'] = $this->home_m->get_single_field('settings','','site_title');
        $data['header_logo'] = $this->home_m->get_single_field('settings','','header_logo');
        $data['footer_logo'] = $this->home_m->get_single_field('settings','','footer_logo');
        $data['fav_icon'] = $this->home_m->get_single_field('settings','','fav_icon');
        $data['phone_no'] = $this->home_m->get_single_field('settings','','phone_no');
        $data['address'] = $this->home_m->get_single_field('settings','','address');
        $data['footer_tagline'] = $this->home_m->get_single_field('settings','','footer_tagline');
        $data['email_add'] = $this->admin_m->get_single_field('settings','','email_add');

        return $data;
    }
    public function file_view(){
        $data['main_content'] = 'front/files_upload/view';
        $general = $data + $this->general();
        $this->load->view('front/inc/view',$general);

    }
    public function mult_file(){

        $config['upload_path'] = './uploads/test'.'';
        $config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip|xlsm|xls|csv|xlsb|xlw|xltx';
        $config['max_size']     = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $files = $_FILES;

            $_FILES['file']['name']= $files['file']['name'];
            $_FILES['file']['type']= $files['file']['type'];
            $_FILES['file']['tmp_name']= $files['file']['tmp_name'];
            $_FILES['file']['error']= $files['file']['error'];
            $_FILES['file   ']['size']= $files['file']['size'];
            if($this->upload->do_upload('file')){

                $file_detail = $this->upload->data();
                $data1['file_name'] = $file_detail['file_name'];
                $data1['client_id'] =$this->session->userdata('client_id');

               $result = $this->admin_m->add_data('client_only_files',$data1);
               if($result){
                   return 1;
               }

            }else{
                if(strpos($this->upload->display_errors(), 'did not select') !== false){
                    return 1;
                }else{

                    return 1;
                }
            }
      //  }
        return 1;
    }
    public  function  delete($id){
        if($id){
            $this->db->where('client_only_files_id',$id);
            $this->db->delete('client_only_files');
            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Record Delete Successfully');
            redirect('/File_Upload');
        }
        else{
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'Some Thing Went Wrong');
            redirect('/File_Upload');
        }
    }
    public function get_upload_file_name($id)
    {
        // EXTRACT FILES DATA

        $this->db->where('client_only_files_id', $id);
        $rec    = $this->db->get('client_only_files');
        $result = $rec->result();
        // SEPERATE EXTENSION
        $get_file_name  = $result[0]->file_name;
        $new            = pathinfo($result[0]->file_name, PATHINFO_EXTENSION);
        $get_file_name1 = str_replace('.' . $new, '', $get_file_name);
        // FILL JSON ENCODED ARRAY
        $data = array(
            "name" => $get_file_name1,
            "ext"  => $new,
        );
        echo json_encode($data);
    }

    public function update_upload_file_name($id)
    {

        if (isset($_POST)) {
            // GET FILE NAME
            $this->db->select('file_name');
            $this->db->where('client_only_files_id', $id);
            $rec    = $this->db->get('client_only_files');
            $result = $rec->result();

            // UPDATE FILES IN DB
            $get_file_name = $_POST['file_name'] . '.' . $_POST['hidden_ext'];

            $this->db->set('file_name', $get_file_name);
            $this->db->where('client_only_files_id', $id);
            $this->db->update('client_only_files');
            // CHANGE FILE NAME IN DIRECTORY
            if ($this) {
                $response = $this->change_file_name($result[0]->file_name, $get_file_name);

                if ($response) {
                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'File Updated Successfully');
                    redirect('admin/client_only_files');
                }
            }
        }
    }

    public function change_file_name($name, $newName)
    {
        // GET DOCUMENT URI
        $direct = $_SERVER['DOCUMENT_ROOT'] . '/dev/uploads/test';
        if ($handle = opendir('./uploads/test')) {
            while (false !== ($entry = readdir($handle))) {
                $files[] = $entry;
            }
            foreach ($files as $row) {
                if ($row == $name) {
                    // RENAME FILE
                    $response = rename($direct . '/' . $row, $direct . '/' . $newName);
                }
            }
        }
        if (isset($response)) {
            return 1;
        }
    }


}
