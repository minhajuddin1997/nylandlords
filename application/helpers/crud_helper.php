<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('pagenation'))
{
	function pagenation($page_url="",$per_page="",$total_row="")
	 { 
	  $ci =& get_instance(); 
	  $data["base_url"] = $page_url;
	  $data["total_rows"] = $total_row;
	  $data["per_page"] = $per_page;
	  $data['use_page_numbers'] = FALSE;
  	

	  $data['first_link'] = '';
	  $data['last_link'] = ''; 

	  $data['next_tag_open'] = '<li><a>';
	  $data['next_tag_close'] = '</a></li>';

	  $data['prev_tag_open'] = '<li><a>';
	  $data['prev_tag_close'] = '</a></li>';

	  $data['num_tag_open'] = '<li><a>';
	  $data['num_tag_close'] = '</a></li>';

 	  $data['cur_tag_open'] = '<li class="active"><a>';
	  $data['cur_tag_close'] = '</a></li>';
	  
	  $ci->pagination->initialize($data);
	  $links = $ci->pagination->create_links();
	  return $links;					
	 }
}

if(!function_exists('multi_image_upload')){	
    function multi_image_upload($image,$index,$path){         
        $_FILES['image']['name']= $image['name'][$index];
        $_FILES['image']['type']= $image['type'][$index];
        $_FILES['image']['tmp_name']= $image['tmp_name'][$index];
        $_FILES['image']['error']= $image['error'][$index];
        $_FILES['image']['size']= $image['size'][$index];
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        $ci =& get_instance();
        $config['upload_path'] = ''.$path.''; 
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|txt';
        $ci->load->library('upload', $config);
        $ci->upload->initialize($config);
        if(!$ci->upload->do_upload('image')){ 
            return array('error' => $ci->upload->display_errors());
            }else{
            $file_detail = $ci->upload->data();				
            return	$file_detail['file_name'];			
        } 
        return FALSE;
    }
}

if (!function_exists('get_value_by_id'))
{
    function get_value_by_id($table,$id,$field)
    {                               
        $ci =& get_instance();
        $temp = $ci->home_m->get_value_by_id($table,$id,$field);
        if($temp){          
            $result = $temp->$field;               
            return $result;
        }else{
            return FALSE;
        } 
    }
}

if (!function_exists('check_slug'))
{
	function check_slug($table,$slug)
	{		
		$ci =& get_instance();	
		$records = $ci->admin_m->get_list($table,'','',$table.'_slug','',$slug);
		if($records){	
			$slug_temp = ''.$table.'_slug';
			foreach($records as $record){
				$result = $record->$slug_temp;
			}			
			$last_char = check_last_char($result);	
			if($last_char){
				$last_char = (int)substr($result , -1);	
				$new_slug = substr_replace($result, "", -2);
				if($new_slug != $slug){					
					return $slug;
				}else{					
					$new_slug = substr_replace($result, "", -1);
					$result = $new_slug.++$last_char;			
					return $result;
				}				
			}else{				
				$result = ''.$slug.'-0';			
				return $result;
			}				
		}else{
			return  $slug;
		}
			
	}
}
if (!function_exists('get_sub_total'))
{
	function get_sub_total()
	{	
		$ci =& get_instance();
		return $ci->cart->total();
	}	
}


if (!function_exists('get_id_by_slug'))
{
	function get_id_by_slug($table,$slug)
	{								
		$ci =& get_instance();
		$temp = $ci->admin_m->get_list($table,array(''.$table.'_slug'=>$slug));
		if($temp){			
			foreach($temp as $tp){
			    $id = $table.'_id';
				$result = $tp->$id;				
			}
			return $result;
		}else{
			return FALSE;
		} 
	}
}	

if (!function_exists('get_slug_by_id'))
{
	function get_slug_by_id($table,$id)
	{								
		$ci =& get_instance();
		$temp = $ci->admin_m->get_list($table,$table.'_id='.$id);
		if($temp){			
			$slug = $table.'_slug';
			foreach($temp as $tp){
				$result = $tp->$slug;				
			}
			return $result;
		}else{
			return FALSE;
		} 
	}
}	

if (!function_exists('get_single_field'))
{
	function get_single_field($tabel="",$where="",$field="")		
	{	
		$ci =& get_instance();
		$result = $ci->admin_m->get_single_field($tabel,$where,$field);
		if($result){			
			return $result;
		}else{
			return FALSE;
		}	
	}	
}


if (!function_exists('get_name_by_id'))
{
	function get_name_by_id($table,$id)
	{								
		$ci =& get_instance();
		$temp = $ci->admin_m->get_list($table,$table.'_id='.$id);
		if($temp){			
			$name = $table.'_name';
			foreach($temp as $tp){
				$result = $tp->$name;				
			}
			return $result;
		}else{
			return FALSE;
		} 
	}
}	
if (!function_exists('get_image_by_id'))
{
	function get_image_by_id($table,$id)
	{								
		$ci =& get_instance();
		$temp = $ci->admin_m->get_list($table,$table.'_id='.$id);
		if($temp){			
			$image = $table.'_image';
			foreach($temp as $tp){
				$result = $tp->$image;				
			}
			return $result;
		}else{
			return FALSE;
		} 
	}
}

if (!function_exists('get_list'))
{
	function get_list($tabel="",$where="",$limit="",$order_col="",$order_by="",$like="")
	{		
		$ci =& get_instance();
		$records = $ci->home_m->get_list($tabel,$where,$limit,$order_col,$order_by,$like);
		if($records){	
			return $records;
		}else{
			return  FALSE;
		}
			
	}
}


if (!function_exists('scan_images_by_date'))
{
	function scan_images_by_date($dir) {
	    $ignored = array('.', '..', '.svn', '.htaccess');
	    $files = array();    
		if(!file_exists($dir)){
			mkdir($dir, 0777, true);
		}
	    foreach (scandir($dir) as $file) {
	        if (in_array($file, $ignored)) continue;
	        $files[$file] = filemtime($dir . '/' . $file);
	    }
	    arsort($files);
	    $files = array_keys($files);
	    return ($files) ? $files : false;
	}
}

if(!function_exists('single_image_upload')){	
	function single_image_upload($image,$path){         
		$_FILES['image']['name']= $image['name'];
		$_FILES['image']['type']= $image['type'];
		$_FILES['image']['tmp_name']= $image['tmp_name'];
		$_FILES['image']['error']= $image['error'];
		$_FILES['image']['size']= $image['size']; 
		if(!file_exists($path)){
			mkdir($path, 0777, true);
		}
		$ci =& get_instance();
		$config['upload_path'] = ''.$path.'';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|txt|docx|ppt|';
		$config['max_width'] = '400000';
		$config['max_height'] = '400000';
		$ci->load->library('upload', $config);
		$ci->upload->initialize($config);
		if(!$ci->upload->do_upload('image')){ 

			$error = array('error' => $ci->upload->display_errors());
			$error['status'] = 'error';
			return $error;
            
		}
		else
		{
			$file_detail = $ci->upload->data();				
			return	$file_detail['file_name'];			
		}
		return FALSE;
	}
}

if(!function_exists('summary_file_upload')){	
	function summary_file_upload($image,$path){         
		$_FILES['image']['name']= $image['name'];
		$_FILES['image']['type']= $image['type'];
		$_FILES['image']['tmp_name']= $image['tmp_name'];
		$_FILES['image']['error']= $image['error'];
		$_FILES['image']['size']= $image['size']; 
		if(!file_exists($path)){
			mkdir($path, 0777, true);
		}
		$ci =& get_instance();
		$config['upload_path'] = ''.$path.'';
		$config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip|xlsm|xls|csv|xlsb|xlw|xltx';
		$config['max_width'] = '400000';
		$config['max_height'] = '400000';
		$ci->load->library('upload', $config);
		$ci->upload->initialize($config);
		if(!$ci->upload->do_upload('image')){ 

			$error = array('error' => $ci->upload->display_errors());
			$error['status'] = 'error';
			return $error;
            
		}
		else
		{
			$file_detail = $ci->upload->data();				
			return	$file_detail['file_name'];			
		}
		return FALSE;
	}
}

if(!function_exists('send_email')){	
	function send_email($send_to,$subject,$body){
		$ci =& get_instance();
		$config['mailtype'] ='html';
// 		$config['protocol'] = 'smtp';
//         $config['smtp_host'] = 'ssl://mail.plutoprojects.net';
//         $config['smtp_user'] = 'info@nylandlords.com';
//         $config['smtp_pass'] = 'rU#JdAr=e6J@';
//         $config['smtp_port'] = 465;
		$ci->email->initialize($config);
    
		$ci->email->set_header('Header1', 'Email Information');
		$ci->email->from("info@nylandlords.com","NY Landlord");
		$ci->email->to($send_to);		
		$ci->email->subject($subject);
		$ci->email->message($body);
		if($ci->email->send()){
			return TRUE;	
		}else{
			return FALSE;
		}
	}
}