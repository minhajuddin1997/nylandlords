<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Survey extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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


    public function index()
    {
       if ($this->session->userdata('client_id')) {
            $data['main_content'] = 'front/survey/view';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    public function get_senators(){
        $query = $this->db->query('SELECT DISTINCT nyc_senators_counties FROM nyc_senators');
        $row = $query->result();
        echo json_encode($row);
    }
    public function get_assembly(){
        $query = $this->db->query('SELECT DISTINCT nyc_assembly_counties FROM nyc_assembly');
        $row = $query->result();
        echo json_encode($row);
    }
    public function get_senators_districts(){
        $id = $_GET['val'];
        $sql = "SELECT nyc_senators_districts,nyc_senators_emails FROM nyc_senators WHERE nyc_senators_counties like '%". $id . "%'";
        $query = $this->db->query($sql);
        $row = $query->result();
        echo json_encode($row);
    }
    public function get_assembly_districts(){
        $id = $_GET['val'];
        $sql = "SELECT nyc_assembly_districts,nyc_assembly_emails FROM nyc_assembly WHERE nyc_assembly_counties like '%". $id . "%'";
        $query = $this->db->query($sql);
        $row = $query->result();
        echo json_encode($row);
    }
    public function test(){
        $filename= base_url() . 'uploads/support_files/ddsds.csv';    
        print_r($filename);
        $file = fopen($filename, "r");
        echo '<pre>';
        $data = array();
        while (($getData = fgetcsv($file)) !== FALSE)
        {
            $data['nyc_assembly_id'] = $getData[0];
            $data['nyc_assembly_name'] = $getData[1]; 
            $data['nyc_assembly_counties'] = $getData[2]; 
            $data['nyc_assembly_districts'] = $getData[3]; 
            $data['nyc_assembly_emails'] = $getData[4];
            $this->home_m->add_data('nyc_assembly',$data);
        }

        fclose($file);  
    }

    public function submit(){

        $first_name = $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $address =  $_POST['address'];
        $state =  $_POST['state'];
        $zip =  $_POST['zip'];
        $phone =  $_POST['phone'];
        $email =  $_POST['email'];
        $city =  $_POST['city'];
        $phone = $_POST['phone'];
        $email_senator=$_POST['senator_email'];
        $email_assembly = $_POST['assembly_email'];
        
     
    	$section['body'] = '<table>';
		$section['body'] .='<tr><td>Hi, my name is ' . $first_name . ' ' . $last_name . ' from ' . $address . ',' . $city . ',' . $state . ',' . $zip . '.<td></tr>';
		$section['body'] .='<tr><td>My phone number is ' . $phone . '. I am writing to you in opposition to S8667/A10827. I am a small property owner in NYS. Without
		significant amendments, the bill as written would push out many small property owners like myself. This legislation would incite widespread non payments by creating a loophole in which many persons, even 
		those that are financially-sound, could skip payments with no accountability. Essentially people like me would be expected to continue to provide safe housing and cover all the expenses required to do so, 
		while receiving no income for an indefinite period of time. The COVID period could last for years. I would not survive and then my tenants would be destabilized as well. This is a lose-lose scenario.
        Please oppose S8667/A10827 and find a better solution that would provide stability to all stakeholders including housing providers like myself.
		</td></tr>';
		$section['body'] .='<tr><td><br>Sincerly,</td></tr>';
		$section['body'] .='<tr><td>' . $first_name . ' ' . $last_name . '</td></tr>';
		$section['body'] .='<tr><td>' . $email . '</td></tr>';
		$section['body'] .='<tr><td>' . $address . '</td></tr>';
		$section['body'] .='<tr><td>' . $city . ',' . $state . ',' . $zip . '</td></tr>';
		$section['body'].= '</table>';
		$section['subject'] = 'Survey Form NYC Land Lords';
		$body = $this->load->view('email/template',$section, TRUE);
		$result = send_email($email_senator,'Survey Form NYC Land Lords',$body);
		$result2 = send_email($email_assembly,'Survey Form NYC Land Lords',$body);
		if($result || $result2){
		    $this->session->set_flashdata('msg', '1');
			$this->session->set_flashdata('alert_data', 'Email sent!');
		    redirect('Survey/index');
		} else{
		    $this->session->set_flashdata('msg', '2');
			$this->session->set_flashdata('alert_data', 'Something went wrong!');
		    redirect('Survey/index');
		}
    }
    
    public function cost(){
        if ($this->session->userdata('client_id')) {
            $data['main_content'] = 'front/cost/view';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    
}
?>