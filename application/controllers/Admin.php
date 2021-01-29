<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Admin	extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

        $this->oip_email = "info@nylandlords.com";
        if ($this->session->userdata('user_id')) {
            $permissions = $this->db->select('role_name,role_permission')->join('user', 'user.role_id = role.role_id')->where('user.user_id', $this->session->userdata('user_id'))->get('role')->row();
            $this->permissions = json_decode($permissions->role_permission);
            $this->role_name = $permissions->role_name;
        }

	}

	public function index()
	{	
		if($this->session->userdata('user_id')){
// 			$data['chartdatastatuswise'] = $this->admin_m->get_chart_data_pie();
// 			$data['paidcompareunpaid'] = $this->admin_m->get_chart_compare();
// 			$data['uploadedmonthwise'] = $this->admin_m->get_chart_uploaded_month_wise();
// 			$data['uploadedservicewise'] = $this->admin_m->get_chart_uploaded_service_wise();
// 			$data['uploadedpaymentwise'] = $this->admin_m->get_chart_payment_month_wise();
		
			$data['main_content'] = 'admin/user/list';		
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
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

	public function profile()
	{	
		if($this->session->userdata('user_id')){
			$data['records'] = $this->admin_m->get_list('user');
			$data['main_content'] = 'admin/user/profile';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
    
    public function list_inquiry()
	{			
		if($this->session->userdata('user_id')){

			$data['records'] = $this->admin_m->get_list('client_inquiry');
			$data['main_content'] = 'admin/client_inquiry/list';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
	
	public function lists($table)
	{

		if($this->session->userdata('user_active')){

			$data['records'] = $this->admin_m->get_list($table);
			$data['main_content'] = 'admin/'.$table.'/list';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
	
	public function all_client_details()
	{
	    if($this->session->userdata('user_active'))
	    {
	        $data['records'] = $this->admin_m->get_all_client();
			$data['main_content'] = 'admin/all_client_detail/list';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}	
	}
	
	public function view($table)
	{			
		if($this->session->userdata('user_id')){
			$id = $this->uri->segment(3);
			$table_id = $table.'_id	';
			$data['records'] = $this->admin_m->get_list($table,array($table_id => $id));
			$data['main_content'] = 'admin/'.$table.'/view';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}

	public function read_status_view($table)
	{	
		if($this->session->userdata('user_id')){
			$id = $this->uri->segment(3);
			$table_id = $table.'_id	';
			$data['records'] = $this->admin_m->get_list($table,array($table_id => $id));
			$general = $data['records'];
			$data['main_content'] = 'admin/'.$table.'/view';
			$body = $this->load->view('admin/client_payments/view',$general,TRUE);
			$result = send_email('nb@nadocrm.com','New client registration',$body);
			$general = $data + $this->general();
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
	public function add($table)
	{			
		if($this->session->userdata('user_active')){
			$data['main_content'] = 'admin/'.$table.'/add';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
	public function get_dropdown()
	{		
		$id = $this->input->post("id");
		$get_from = $this->input->post("get_from");
		$get_where = $this->input->post("get_where");
		$get_from_id = $get_from.'_id';
		$options = $this->admin_m->get_list($get_from,array($get_where.'_id'=>$id));
		echo '<option value="">Please Select</option>';
		foreach($options as $option){
			echo '<option value="'. $option->$get_from_id .'">'. get_name_by_id($get_from,$option->$get_from_id) .'</option>';
		}
		return;	
	}

	public function get_dropdown_clients()
	{		
		$id = $this->input->post("id");
		$get_from = $this->input->post("get_from");
		$get_where = $this->input->post("get_where");
		$get_from_id = $get_from.'_id';
		$options = $this->admin_m->get_list($get_from,array($get_where.'_id'=>$id));
		echo '<option value="">Please Select</option>';
		foreach($options as $option){
			echo '<option value="'. $option->$get_from_id .'">'. get_value_by_id($get_from,$option->$get_from_id,'inquiry_name') .'</option>';
		}
		return;	
	}
	public function add_data($table)
	{
	  
		if($this->session->userdata('user_active'))
		{
			foreach($_POST as $key => $val)  
			{  					
				if(strpos($key ,'slug') !== false)
				{
					$result = check_slug($table,$this->input->post($key));					
					$data[$key] = $result;					
				}
				else
				{
					$data[$key] = $this->input->post($key);  
				}				
			}  	
			if(!empty($this->input->post('client_password')))
			{
			    $data_str = '1234567890abcefghijklmnopqrstuvwxyz';
                $autogenerated=  substr(str_shuffle($data_str), 0,7);
                
				$data['client_password'] = $this->encryption->encrypt($autogenerated);
			}

			if(!empty($this->input->post('client_email')))
			{
				$this->form_validation->set_rules('client_email','Client email already exists or','required|is_unique[client.client_email]');
				
				if($this->form_validation->run())
				{
					$section['body'] = '<table>';
				
					if(!empty($_POST['client_email']))
					{
						$section['body'] .='<tr><td>User ID: '.$_POST['client_email'].'<br><td></tr>';
					}
					if(!empty($_POST['client_password']))
					{
						$section['body'] .='<tr><td>Password: '.$autogenerated.'<br><td></tr>';
					}
					
                    $section['body'] .='<tr><td><br>Use Following link to login into your dashboard</td></tr>';
                    $section['body'] .='<tr><td>'.base_url().'</td></tr>';
                    
					$section['body'] .='<tr><td><br>Auto genereated email from NY LandLords inquirys</td></tr>';
					$section['body'].= '</table>';
					$section['subject'] = 'Welcome to NYLandlords inquirys';
					$body = $this->load->view('email/template',$section, TRUE);
					$result = send_email($this->input->post("client_email"),'New Client Registration',$body);
					$result = send_email($this->oip_email,'New Client Registration',$body);

					$this->session->set_flashdata('msg', '1');
					$this->session->set_flashdata('alert_data', 'Client Registration Successfull');

					$id = $this->admin_m->add_data($table,$data);
					redirect('list/'.$table,'refresh');
				}
			}
			else
			{
				$id = $this->admin_m->add_data($table,$data);
					//redirect('list/'.$table,'refresh');
			}

			if(!empty($id))
			{				 
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Added Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Failed To Add');
				$data['main_content'] = 'admin/client/add';
				$general = $data + $this->general();		
				$this->load->view('admin/inc/view',$general);
			}	
			if($this->uri->segment(2) != "client")
			{
				redirect('list/'.$table,'refresh');
			}
			
		}		
		else{
			redirect('login');
		}	

	}
	
	public function edit($table)
	{			
		if($this->session->userdata('user_active')){
			$id = $this->uri->segment(3);
			$table_id = $table.'_id	';
			$data['records'] = $this->admin_m->get_list($table,array($table_id => $id));
			$data['main_content'] = 'admin/'.$table.'/edit';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}
	
	public function update_data($table)
	{	

		if($this->session->userdata('user_active')){
			$id = $this->uri->segment(3);
			foreach($_POST as $key => $val)  
			{  
				if(strpos($key ,'slug') !== false){
					$result = check_slug_edit($table,$this->input->post($key),$id);					
					$data[$key] = $result;					
				}
				elseif(strpos($key ,'product_info') !== false)
				{
					$data['product_info'] = serialize(array_combine($this->input->post('product_info_key'),$this->input->post('product_info_value')));			
				}
				else
				{
					if(strpos($key ,'product_img_image') !== false)
					{	
						$data2['product_img_status'] = '1'; 
						$this->admin_m->update_data('product_img',$data2,'product_id ='.$id.'');
						$cpt = count($this->input->post($key));
						for($i=0; $i<$cpt; $i++)
						{  
							$data1[$key] = $_POST[$key][$i]; 
							$data1['product_id'] = $id;							
							$this->admin_m->add_data('product_img',$data1);
						}
					}
					else
					{
						$data[$key] = $this->input->post($key);  	
					}						
				}	
			}  
			foreach($_FILES as $key => $val)  
			{  
				if($_FILES[$key]['name']){
					
					if(strpos($key ,'product_img_image') !== false){
						$this->upload_muntiimage('product_img',$key,$id);
					}else{
						$data[$key] = $this->upload_image($table,$key);
					}					
				}			
			}  
			
			if($table == "client")
			{
			    $data['client_password'] = $this->encryption->encrypt($this->input->post('client_password'));
			}
			
			$table_id = $table.'_id	';
			$result = $this->admin_m->update_data($table,$data,array($table_id=>$id));
			if($result)
			{

				if($table == "client_inquir")
				{   
					$clientData = $this->admin_m->get_list_single('client_inquiry',array('client_inquiry_id'=>$id));
			
				// 	for($i=0;$i<count(array($clientData)); $i++){
			 //           $clientToMail = $clientData->client_id;
			 //       }
                    $clientToMail = $clientData->client_id;

					$section['body'] = '<table>';
					
					$section['body'] .='<tr><td>inquiry Name: <b>'.$clientData->inquiry_name.'</b><br><td></tr>';
					$section['body'] .='<tr><td>inquiry Cost: <b>'.$clientData->inquiry_price.'</b><br><td></tr>';
					$section['body'] .='<tr><td>inquiry Status: <b>'.$clientData->delivery_status.'</b><td></tr>';
					$section['body'] .='<tr><td><br>Use following link to login into your dashboard</td></tr>';
                    $section['body'] .='<tr><td><br>'.base_url().'</td></tr>';
					$section['body'] .='<tr><td><br>This is a computer generated email and does not require signature.</td></tr>';
					$section['body'].= '</table>';
					$section['subject'] = 'inquiry Status Updated';
					$body = $this->load->view('email/template',$section, TRUE);
					$result = send_email(get_value_by_id("client",$clientToMail,'client_email'),'inquiry Status Update',$body);
				}
				
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Updated Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Update Failed');
			}
			if($this->uri->segment(1) == 'update_data'){
				redirect('edit/'.$table.'/'.$id,'refresh');
			}else{
				redirect('list/'.$table,'refresh');
			}
			redirect('list/'.$table,'refresh');
		}		
		else
		{
			redirect('login');
		}			
	}
	public function delete($table)
	{
		if($this->session->userdata('user_active')){
			$data[''.$table.'_status'] = 1;
			$id = $this->uri->segment(3);

			$table_id = $table.'_id	';
			$result = $this->admin_m->update_data($table,$data,array($table_id => $id));

			if($result){
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Deleted');
			}else{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Delete Failed');
			}
			redirect('list/'.$table,'refresh');
		}		
		else{
			redirect('login');
		}	
	}
	public function delete_support_chat($table){
	    
	   
	    	if($this->session->userdata('user_active')){
			$data[''.$table.'_status'] = 1;
			$id = $this->uri->segment(4);
         
			$table_id = $table.'_id	';
			$result = $this->admin_m->update_data($table,$data,array('sender_id' => $id));

			if($result){
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Deleted');
			}else{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Delete Failed');
			}
			redirect('list-'.$table,'refresh');
		}		
		else{
			redirect('login');
		}	
	    
	}

	public function upload_muntiimage($table,$field,$id)
	{		
		$config['upload_path'] = './uploads/'.$table.'';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']     = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);		
		$files = $_FILES;
		$cpt = count(array($_FILES[$field]['name']));
		$cpt;
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['f']['name']= $files[$field]['name'][$i];
			$_FILES['f']['type']= $files[$field]['type'][$i];
			$_FILES['f']['tmp_name']= $files[$field]['tmp_name'][$i];
			$_FILES['f']['error']= $files[$field]['error'][$i];
			$_FILES['f']['size']= $files[$field]['size'][$i]; 
			if($this->upload->do_upload('f')){
				
				$file_detail = $this->upload->data();
				$data1['comments_images_img'] = $file_detail['file_name'];
				$data1['comments_id'] = $id;
				$result = $this->admin_m->add_data('comments_images',$data1);	
				
			}else{						
				if(strpos($this->upload->display_errors(), 'did not select') !== false){
					return 1;
				}else{
					return 1;
				}
			}
		}		
		return 1;
	}
	public function upload_multifile($table,$field,$id)
	{	
		$config['upload_path'] = './uploads/'.$table.'';
		$config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip|xlsm|xls|csv|xlsb|xlw|xltx';
		$config['max_size']     = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);		
		$files = $_FILES;
		$cpt = count(array($_FILES[$field]['name']));
		$cpt;
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['f']['name']= $files[$field]['name'][$i];
			$_FILES['f']['type']= $files[$field]['type'][$i];
			$_FILES['f']['tmp_name']= $files[$field]['tmp_name'][$i];
			$_FILES['f']['error']= $files[$field]['error'][$i];
			$_FILES['f']['size']= $files[$field]['size'][$i]; 
			if($this->upload->do_upload('f')){
				
				$file_detail = $this->upload->data();
				$data1['comments_files_file'] = $file_detail['file_name'];
				$data1['extension'] = $file_detail['file_ext'];
				$data1['comments_id'] = $id;
				$result = $this->admin_m->add_data('comments_files',$data1);	
				
			}else{						
				if(strpos($this->upload->display_errors(), 'did not select') !== false){
					return 1;
				}else{
					
					return 1;
				}
			}
		}		
		return 1;
	}
	public function login()
	{
		if(!empty($_POST))
		{		
			$email = $this->input->post('email',TRUE);
			$password = $this->input->post('password',TRUE);
			$result = $this->admin_m->get_list('user',array('user_email'=>$email));
		
			if($result){
				foreach($result as $row){
					$id = $row->user_id;
					$pass = $row->user_pass;
					$email = $row->user_email;
					$image = $row->user_image;
					$type =	$row->user_type;
				}


				if($this->encryption->decrypt($pass) == $password){
					$session_data = array(
						'user_id' => $id,				
						'user_email' => $email,
						'user_type' => $type,
						'user_image' => $image,
						'user_active' =>  'yes',							
					);
					
					$section['body'] = '<table>';
					$section['body'] .='<tr><td>Admin Profile Service.<br>'.$email.' have been logged on with his profile for the system, if its unauthorized, Kindly Report.<td></tr>';
					
					$section['body'] .='<tr><td><br>Use Following link to login into your dashboard</td></tr>';
                    $section['body'] .='<tr><td>'.base_url("admin").'<br><br></td></tr>';
					$section['body'] .='<tr><td><br>This is a computer generated invoice and does not require signature.</td></tr>';
					$section['body'].= '</table>';
					$section['subject'] = 'Admin logged in into NYLand Lords Dashboard';
					$body = $this->load->view('email/template',$section, TRUE);
					$result = send_email($this->input->post("email"),'Admin logged in into NYLand Lords inquirys Dashboard',$body);
					
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata('msg', '1');
					$this->session->set_flashdata('alert_data', 'Login Successfull.');
					redirect('admin/list_inquiry');
				}else{
					$this->session->set_flashdata('msg', '2');
					$this->session->set_flashdata('alert_data', 'Invalid Email Or Password.');
					redirect('login');
				}							
			}else{				
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Invalid Email Or Password.');
				redirect('login');
			}
			
		}else{
			$this->load->view('admin/login');
		}
	}
	public function update_user()
	{
		if (!empty($_POST))
		{	
			$password = $this->input->post('user_pass',TRUE);
			$data['user_email'] = $this->input->post('user_email',TRUE);
			$data['user_pass'] = $this->encryption->encrypt($password);				
			$result = $this->admin_m->update_data('user',$data,array('user_id'=>1));				
			if($result == 'TRUE' ){
				redirect();				
			}else{				
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Failed To Update');
			}			
		}else{
			redirect('dashboard');
		}
	}

	public function update_password()
	{
		if (!empty($_POST))
		{	

			$password = $this->input->post('new_password',TRUE);
			$token = $this->uri->segment(3);
			$data['forgot_password_token'] = '';
			$data['user_pass'] = $this->encryption->encrypt($password);				
			$result = $this->admin_m->update_data('user',$data,array('forgot_password_token'=>$token));				
			if($result == 'TRUE' ){
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Password Changed Successfully');
				redirect('login','refresh');
			}else{				
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Password Resset Failed');
				redirect('login','refresh');
			}			
		}else{
			$this->load->view('admin/reset-password');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

	public function forget_form()
	{
		$this->load->view('admin/forget-form');
	}

	public function password_recovery_email()
	{
		if (!empty($_POST))
		{	
			$email = $this->input->post('user_email',TRUE);
			$result = $this->home_m->get_list('user',array('user_email'=>$email));
			if($result){
				$today = date("Ymd");
				$rand = strtoupper(substr(uniqid(sha1(time())),0,120));
				$unique = $today . $rand;
				$forgot_password_token = $unique;
				$data['forgot_password_token'] = $forgot_password_token;
				$this->admin_m->update_data('user',$data,array('user_email'=>$email));
				$this->resset_pass_email($email,$forgot_password_token);
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Reset link send successfull');
				redirect('admin/login');	
			}else{			
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Resset link send failed');			
				redirect('admin/login');
			}			
		}else{
			$this->load->view('login');
		}
	}	
	
	public function resset_pass_email($email,$forgot_password_token)
	{			
		$section['subject'] = 'Password Reset Link';
		$section['body'] = '<strong>Reset Link :</strong> <a href="'.base_url('admin/update_password/').$forgot_password_token.'">Click here and you will be redirected to the website.</a>';
		$body = $this->load->view('email/template',$section, TRUE);
		$result = send_email($email,'Password Reset Link',$body);
		if($result){
			return True;
		}else{			
			return False;
		}
	}

	public function photo_delete()
	{
		if (!unlink($_POST['photolink']))
		{
			echo 2;
		}
		else
		{
			echo 1;
		}

	}

	public function photo_upload()
	{
		if(!empty($_FILES['image']))
		{
			$image = single_image_upload($_FILES['image'],"./uploads/".$_POST['imagepath']);
			echo json_encode($image);
		}
		else
		{
			echo 2;
		}
	}

	public function admin_update_password()
	{
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('cnf_password', 'Confirm Password', 'trim|matches[new_password]');
		if (!$this->form_validation->run() == FALSE){

			$data = array(
				'user_pass' => $this->encryption->encrypt($this->input->post('new_password')),
			);
			$this->home_m->update_data('user',$data,array('user_id'=>5));

			$this->session->set_flashdata('msg', '1');
			$this->session->set_flashdata('alert_data', 'Password Updated');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$this->session->set_flashdata('msg', '2');
			$this->session->set_flashdata('alert_data', 'Password Update Failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function completed_inquiry()
	{			
		if($this->session->userdata('user_id')){

			$data['records'] = $this->admin_m->get_list('client_inquiry',array('complete_status' => 'completed'));
			$data['main_content'] = 'admin/client_inquiry/list';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}

	public function all_inquiry()
	{			
		if($this->session->userdata('user_id')){

			$data['records'] = $this->admin_m->get_list('client_inquiry',array('complete_status' => 'pending'));
			$data['main_content'] = 'admin/client_inquiry/list';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}			
	}


	public function inquiry_details($id)
	{
		if($this->session->userdata('user_id'))
		{
			$toupdatedata = array(
				"comments_read_admin" => "read"
			);

			$this->home_m->update_data('comments',$toupdatedata,array('inquiry_id'=>$id));

			$data['comments'] = $this->home_m->get_list('comments',array('inquiry_id' =>$id),'','comments_id','DESC');
			$data['records'] = $this->home_m->get_list('client_inquiry',array('client_inquiry_id' => $id));
			$data['main_content'] = 'admin/client_inquiry/details';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else
		{
			redirect('login');
		}
	}

	public function reply_comment()
	{
	    //print_r(count($_FILES['comments_images_img']));die;
		if($this->session->userdata('user_id'))
		{
			$data = array(
				'inquiry_id' => $this->input->post('inquiry_id'),
				'sender_id' => $this->input->post('sender_id'),
				'comments_text' => $this->input->post('comments_text'),
			);
			
            if(!empty($data['comments_text'])){
			    $return_id = $this->home_m->add_data('comments',$data);
			    
			   $clientData = $this->admin_m->get_list_single('client_inquiry',array('client_inquiry_id'=>$this->input->post('inquiry_id')));
    			
    			    $clientToMail = $clientData->client_id;
    			
            }

		
			
			
			if(isset($return_id))
			{
				$section['body'] = '<table>';
				$section['body'] .='<tr><td>Admin Name: '.get_name_by_id("user",$this->session->userdata('user_id')).'<br><td></tr>';
				$section['body'] .='<tr><td>inquiry Name: '.get_value_by_id("client_inquiry",$_POST['inquiry_id'],'inquiry_name').'<br><td></tr>';
				$section['body'] .='<tr><td>Comment on inquiry: '.$_POST['comments_text'].'<br><td></tr>';
				$section['body'] .='<tr><td><br>Use Following link to login into your dashboard</td></tr>';
				$section['body'] .='<tr><td><br>'.base_url("admin").'<br></td></tr>';
				$section['body'] .='<tr><td><br>This is a computer generated invoice and does not require signature.</td></tr>';
				$section['body'].= '</table>';
				$section['subject'] = 'New comment added by '.get_name_by_id("client",$_POST['sender_id']);
				$body = $this->load->view('email/template',$section, TRUE);
				$result = send_email(get_value_by_id("client",$clientToMail,'client_email'),'New comment on inquiry',$body);

				if(!empty($_FILES))
				{
					foreach($_FILES as $key => $val)  
					{  
						$this->upload_muntiimage('comments_images',$key,$return_id);
					}
				}

				if(!empty($_FILES))
				{
					foreach($_FILES as $keys => $val)  
					{  
						$this->upload_multifile('comments_files',$keys,$return_id);
					}
				}

				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Comment Successfull');
				
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Comment Failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}		
		else
		{
			redirect('login');
		}
	}

	public function inquiry_pending($id)
	{
		$toupdatedata = array(
			"complete_status" => "pending"
		);
		$this->home_m->update_data('client_inquiry',$toupdatedata,array('client_inquiry_id'=>$id));

		$this->session->set_flashdata('msg', '1');
		$this->session->set_flashdata('alert_data', 'Pending Marked');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function inquiry_completed($id)
	{
		$toupdatedata = array(
			"complete_status" => "completed"
		);
		$this->home_m->update_data('client_inquiry',$toupdatedata,array('client_inquiry_id'=>$id));

		$this->session->set_flashdata('msg', '1');
		$this->session->set_flashdata('alert_data', 'Pending Marked');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function files_upload_editor()
	{

		$multi_image = $_FILES['files']['name'];

		for($j=0; $j < count(array($_FILES['files']['tmp_name'])); $j++)
		{
			if($_FILES['files']['size'][$j] > 0){
				$image = multi_image_upload($_FILES['files'],$j,'./uploads/editor');
				if(is_array($image)){            
					$this->session->set_flashdata('error', $image);
				}else{
					exit(json_encode(base_url('uploads/editor/').$image));
				}
			}
		}  

	}

	//client support function
	public function get_list_support()
    {
     //  echo $this->session->userdata('user_id');die;
		if($this->session->userdata('user_active')){
			$data['records'] = $this->admin_m->get_support_data('support');
			//print_r($data);die;
			$data['main_content'] = 'admin/support/list';
			$general = $data + $this->general();
			$this->load->view('admin/inc/view',$general);
		}		
		else{
			redirect('login');
		}		

	}

	

	public function get_client_support($id)
	{
		if($this->session->userdata('user_active'))
		{
			//$data['comments'] = $this->admin_m->get_list('support',array('inquiry_id' => $id),'','support_id','DESC');
            $data['comments'] = $this->admin_m->get_list('support',array('user_id' => $this->session->userdata('user_id'),'inquiry_id' => $id),'','support_id','DESC');

            $data['template']=$this->db->where('user_id',$this->session->userdata('user_id'))->from('email_template')->get()->result();
			$data['main_content'] = 'admin/support/edit';
			$general = $data + $this->general();		
			$this->load->view('admin/inc/view',$general);
		}		
		else
		{
			redirect('login');
		}
	}

	public function reply_support()
	{
		
		if($this->session->userdata('user_active'))
		{
			$data = array(
			    'user_id'=>$this->session->userdata('user_id'),
				'inquiry_id' => $this->input->post('inquiry_id'),
				'sender_id' => $this->session->userdata('user_id'),
				'support_text' => $this->input->post('support_text'),
			);
			
            if(empty($data['support_text'])){
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Comment Failed');
                redirect($_SERVER['HTTP_REFERER']);
                exit;
            }
			$return_id = $this->home_m->add_data('support',$data);
		
			if($return_id)
			{
				$section['body'] = '<table>';
				$section['body'] .='<tr><td>Client Name: '.get_name_by_id("client",$this->session->userdata('user_id')).'<br><td></tr>';
				$section['body'] .='<tr><td>Comment on inquiry: '.$_POST['support_text'].'<br><td></tr>';
				$section['body'] .='<tr><td><br>Use Following link to login into your dashboard</td></tr>';
                $section['body'] .='<tr><td><br>'.base_url("admin").'<br><br></td></tr>';
				$section['body'] .='<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
				$section['body'].= '</table>';
				$section['subject'] = 'New comment added by '.get_name_by_id("client",$this->session->userdata('user_id'));
				$body = $this->load->view('email/template',$section, TRUE);
				$result = send_email($this->oip_email,'New comment on inquiry',$body);
				
				if(!empty($_FILES))
				{
					foreach($_FILES as $key => $val)  
					{  
						if(!empty($val['name']))
						{
							$this->upload_supp_multi_image('support_images',$key,$return_id);
						}
						
					}
				}

				if(!empty($_FILES))
				{
					foreach($_FILES as $key => $val)  
					{  
						$this->upload_supp_multi_file('support_files',$key,$return_id);
					}
				}
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Comment Successfull');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Comment Failed');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}		
		else
		{
			redirect('login');
		}
	}

	public function upload_supp_multi_file($table,$field,$id)
	{	
		$config['upload_path'] = './uploads/'.$table.'';
		$config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip';
		$config['max_size']     = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);		
		$files = $_FILES;
		if(empty($_FILES[$field]['name'][0]))
		{
			return false;
		}
		
		$cpt = count(array($_FILES[$field]['name']));
		
		
		$cpt;
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['f']['name']= $files[$field]['name'][$i];
			$_FILES['f']['type']= $files[$field]['type'][$i];
			$_FILES['f']['tmp_name']= $files[$field]['tmp_name'][$i];
			$_FILES['f']['error']= $files[$field]['error'][$i];
			$_FILES['f']['size']= $files[$field]['size'][$i]; 
			if($this->upload->do_upload('f')){
				
				$file_detail = $this->upload->data();
				$data1['support_files_file'] = $file_detail['file_name'];
				$data1['extension'] = $file_detail['file_ext'];
				$data1['support_id'] = $id;
				$result = $this->admin_m->add_data('support_files',$data1);	
				
			}else{						
				if(strpos($this->upload->display_errors(), 'did not select') !== false){
					return 1;
				}else{
					
					return 1;
				}
			}
		}		
		return 1;
	}
	
	public function upload_supp_multi_image($table,$field,$id)
	{		
		$config['upload_path'] = './uploads/'.$table.'';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']     = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);		
		$files = $_FILES;
		if(empty($_FILES[$field]['name'][0]))
		{
			return false;
		}
		
		$cpt = count(array($_FILES[$field]['name']));
		$cpt;
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['f']['name']= $files[$field]['name'][$i];
			$_FILES['f']['type']= $files[$field]['type'][$i];
			$_FILES['f']['tmp_name']= $files[$field]['tmp_name'][$i];
			$_FILES['f']['error']= $files[$field]['error'][$i];
			$_FILES['f']['size']= $files[$field]['size'][$i]; 
			if($this->upload->do_upload('f')){
				
				$file_detail = $this->upload->data();
				$data1['support_images_img'] = $file_detail['file_name'];
				$data1['support_id'] = $id;
				$result = $this->admin_m->add_data($table,$data1);	
				
			}else{						
				if(strpos($this->upload->display_errors(), 'did not select') !== false){
					return 1;
				}else{
				// 	$_SESSION["msg_detail"] = $this->upload->display_errors() ; 
				// 	$this->session->set_flashdata('msg', '2');
				// 	$this->session->set_flashdata('alert_data', 'Failed');
				// 	echo $this->upload->display_errors();
					return 1;
				}
			}
		}		
		return 1;
	}

	public function manual_pay()
	{
		$this->form_validation->set_rules('client_id','client','required');
		$this->form_validation->set_rules('inquiry_id','inquiry','required');
		$this->form_validation->set_rules('manual_payment','client','required');

		if($this->form_validation->run())
		{
			$rand = strtoupper(substr(uniqid(sha1(time())),0,5));
			$unique = $rand;
			$orders_no = $unique;

			$data = array(
				'client_id' => $this->input->post('client_id'),
				'inquiry_id' => $this->input->post('inquiry_id'),
				'client_payments_amount' => $this->input->post('manual_payment'),
				'uploaded_month' => date('m'),
				'year' => date("Y"),
				'payment_no' => $orders_no,
			);

			$payAdded = $this->admin_m->add_data('client_payments',$data);

			if($payAdded)
			{
				$clientinquiryToUpdate = $this->admin_m->get_list_single('client_inquiry',array('client_inquiry_id'=>$this->input->post('inquiry_id')));

			   $inquiryId = $clientinquiryToUpdate->client_inquiry_id;
			    
			//	$inquiryId = $clientinquiryToUpdate->client_inquirys_id;
				$inquiry_paid = $clientinquiryToUpdate->inquiry_paid + $this->input->post('manual_payment');
				$inquiry_balance = $clientinquiryToUpdate->inquiry_balance - $this->input->post('manual_payment');

				$toinsert = array(
					'inquiry_paid' =>$inquiry_paid,
					'inquiry_balance' =>$inquiry_balance,
				);

				$this->home_m->update_data('client_inquiry',$toinsert,array('client_inquiry_id' =>$this->input->post('inquiry_id')));

				$this->session->set_flashdata('msg', '1');
				$this->session->set_flashdata('alert_data', 'Payment added');


			}
			else
			{
				$this->session->set_flashdata('msg', '2');
				$this->session->set_flashdata('alert_data', 'Payment Failed');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$this->session->set_flashdata('msg', '1');
			$this->session->set_flashdata('alert_data', 'Payment added');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$this->session->set_flashdata('msg', '2');
			$this->session->set_flashdata('alert_data', 'Payment Failed');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	//ajax call for client status
	public function client_login_status(){
	    if($this->input->post("client_id")){
	     
	        $data['where']=array("client_id"=>$this->input->post("client_id"));
	        $content=array(
	            'client_login_detail'=>$this->input->post("client_type")
	                
	            );
	          $data['table']='client';
	           $id=$this->admin_m->update($data,$content);
	           if($id>0)
	           {
	               echo "success";
	           }
	           else{
	               echo "error";
	           }
	    }
	    
	}
    public function client_payment_due()
    {
        if ($this->input->get('id')) {
            $this->db->update('client_inquiry',['payment_due' => $this->input->get('status')],['client_inquiry_id' => $this->input->get('id')]);

            // Sending Email
            if ($this->input->get('status') == 'Yes') {
                $client_inquiry = $this->db->select('client_id, inquiry_name ,inquiry_type')->where('client_inquiry_id', $this->input->get('id'))->get('client_inquiry')->row();

                $section['body'] = '<table>';
                $section['body'] .='<tr><td>Client Name: <b>'.get_name_by_id("client",$client_inquiry->client_id).'</b><br><td></tr>';
                $section['body'] .='<tr><td>inquiry Name: <b>'.$client_inquiry->inquiry_name.'</b><br><td></tr>';
                $section['body'] .='<tr><td>inquiry Type: <b>'.get_name_by_id("department",$client_inquiry->inquiry_type).'</b><br><td></tr>';
                $section['body'] .='<tr><td><br>'.base_url("").'<br></td></tr>';
                $section['body'] .='<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'].= '</table>';
                $section['subject'] = 'This is just a reminder Email that your Payment is Due';
                $body = $this->load->view('email/template',$section, TRUE);
                $result = send_email($this->oip_email,'Payment Due',$body);
                send_email(get_value_by_id("client",$client_inquiry->client_id,'client_email'),'Payment Due',$body);


            }
            echo json_encode('Updated Successfully');
        }
    }
    //admin file get
    public function client_only_files(){
        $data['main_content'] = 'admin/client_all_files/list';
        $this->db->select('client_only_files.client_only_files_id,client.client_name,client_only_files.file_name');
        $this->db->from('client_only_files')
            ->join('client', 'client.client_id = client_only_files.client_id')
            ->where('client_only_files_status',0);
        $rec=$this->db->get();
        $result=$rec->result();

        $data['records']=$result;
        $general = $data + $this->general();
        $this->load->view('admin/inc/view',$general);
    }
    public  function  delete_client_file($id){
        if($id){
            $this->db->where('client_only_files_id',$id);
            $this->db->delete('client_only_files');
            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Record Delete Successfully');
            redirect('admin/client_only_files');
        }
        else{
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'Some Thing Went Wrong');
            redirect('admin/client_only_files');
        }
    }
    public function get_template(){
	    if($this->input->post('id')){
	        $data=$this->db->where('email_template_id',$this->input->post('id'))->from('email_template')->get()->row();
	        echo json_encode($data,true);
        }
    }

}
?>