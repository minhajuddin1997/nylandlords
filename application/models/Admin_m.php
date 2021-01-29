<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {

	public function add_data($tabel,$data) 
	{
		$this->db->insert($tabel,$data);
		return $this->db->insert_id();
	}
		
	public function get_list($tabel="",$where="",$limit="",$order_col="",$order_by="",$like="")
	{
		$this->db->select('*');
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);		
		if($where){
			$this->db->where($where);
		}	
		if($limit){
			$this->db->limit($limit);
		}
		if($order_by){
			$this->db->order_by($order_col, $order_by);
		}	
		if($like){
			$this->db->like($order_col,$like);
		}	
		$query = $this->db->get();
		$result = $query->result();
		return $result; 		
	}

	
	public function get_support_data()
	{
//		return	$this->db->select('sender_id,user_id,client_name,sender_id')->where('support_status',false)->group_by('project_id')->join('client','client.client_id = support.sender_id','left')->get('support')->result();
        return	$this->db->select('sender_id,user_id,client_name,sender_id')->where('support_status',false)->where('user_id',$this->session->userdata('user_id'))->group_by('client_id')->join('client','client.client_id = support.sender_id','left')->get('support')->result();

    }

//     public function get_list_single($tabel="",$where="")
// 	{
// 		$sql = 'select * from ' . $tabel . ' where '.$tabel.'_status = 0 || 1 && '.$tabel.'_id = ' . $where['client_projects_id'];

// 		$r = $this->db->query($sql);
// 		if($r){
// 			$result = $r->result();
// 		}	
	
// 		//$results = $query->row();

// 		return $result; 		
// 	}
    public function get_list_single($tabel="",$where="")
	{
		$this->db->select('*');
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);	
		$this->db->or_where(''.$tabel.'_status',1);	
		if($where){
			$this->db->where($where);
			$this->db->or_where($where);
		}	
		
		$query = $this->db->get();
		$result = $query->row();
		return $result; 		
	}
	public function sum_money($col,$where) 
	{	
		$this->db->select('*');
		$this->db->from('order_items');
		$this->db->where('order_items_status',0);
		if($where){
			$this->db->where($where);
		}
		
		$this->db->select_sum($col);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function sum_money_order($col,$where) 
	{	
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('orders_status',0);
		if($where){
			$this->db->where($where);
		}
		
		$this->db->select_sum($col);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function sum_money_tax($tabel="",$col,$date_from,$date_to,$where="")
	{
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->where(''.$tabel.'_status',0);		
		if($where){
			$this->db->where($where);
		}
		
		$this->db->where('orders_created_date >=', date('Y-m-d H:i:s', strtotime($date_from)));
		$this->db->where('orders_created_date <=', date('Y-m-d H:i:s', strtotime($date_to)));

		$this->db->select_sum($col);
		$query = $this->db->get();
		$result = $query->result();
		return $result; 		
	}

		public function get_list_members($tabel="",$where="")
	{
		$this->db->select('*');
		$this->db->from($tabel);		
		if($where){
			$this->db->where($where);
		}		
		$query = $this->db->get();
		$result = $query->result();
		return $result; 		
	}
	
	
	public function get_single_field($tabel="",$where="",$field="")		
	{
		$this->db->select('*');
		$this->db->from($tabel);	
		if(!$where){
			$where = $tabel.'_id > 0';
		}	
		$this->db->where($where);	
		$this->db->where(''.$tabel.'_status',0);
		$query = $this->db->get();
		$result = $query->row();
		if($result){
			$output = $result->$field;			
			return $output;  
		}else{
			return;
		}  
	}
	
	public function update_data($tabel,$data,$where)
	{

		$this->db->where(''.$tabel.'_status',0);			
		$this->db->where($where);			
		$result = $this->db->update($tabel, $data);
		return $result; 
	}
	public function update($data,$content)
	{				     
		if(isset($data['where']) && !empty($data['where'])){
			$this->db->where($data['where']);
		}
		$this->db->where($data['table'].'_status',0);
		$result = $this->db->update($data['table'],$content);			
		return $result; 
	}
	public function update_data_member($tabel,$data,$where)
	{			
		$this->db->where($where);			
		$result = $this->db->update($tabel, $data);
		return $result; 
	}
	public function get_single_instance($tabel,$id,$from)
	{
		$this->db->select($from);
		$this->db->from($tabel);	
		$this->db->where(''.$tabel.'_id',$id);						
		//$this->db->where(''.$tabel.'_status',0);		
		$query = $this->db->get();
		$result = $query->row();
		return $result; 		
	}

// 	public function get_chart_data_pie()
// 	{
// 		$this->db->select('delivery_status, count(delivery_status) as count');
// 		$this->db->from('client_inquiry');	
// 		$this->db->where('client_inquiry_status',0);
// 		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
// 		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
// 		$this->db->where('client_inquiry_date >=', $first_date);
// 		$this->db->where('client_inquiry_date <=', $second_date);
// 		$this->db->group_by('delivery_status');	
// 		$query = $this->db->get();
// 		return $query->result();
// 	}

// 	public function get_chart_compare()
// 	{
// 		$this->db->select('sum(inquiry_balance) as balance, sum(inquiry_paid) as paid');
// 		$this->db->from('client_inquiry');	
// 		$this->db->where('client_inquiry_status',0);
// 		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
// 		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
// 		$this->db->where('client_inquiry_date >=', $first_date);
// 		$this->db->where('client_inquiry_date <=', $second_date);
// 		$query = $this->db->get();
// 		return $query->result();
// 	}
// 	public function get_chart_payment_month_wise()
// 	{
// 		$this->db->select('uploaded_month,year, sum(client_payments_amount) as count,client_payments_date');
// 		$this->db->from('client_payments');	
// 		$this->db->where('client_payments_status',0);
// 		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
// 		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
// 		$this->db->where('client_payments_date >=', $first_date);
// 		$this->db->where('client_payments_date <=', $second_date);
// 		$this->db->group_by('uploaded_month,year');	
	
// 		//$this->db->order_by('uploaded_month');
// 		$query = $this->db->get();
// 		return $query->result();
// 	}


	public function get_chart_uploaded_month_wise()
	{
		$this->db->select('uploaded_month, uploaded_year,count(inquiry_balance) as count');
		$this->db->from('client_inquiry');	
		$this->db->where('client_inquiry_status',0);
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_inquiry_date >=', $first_date);
		$this->db->where('client_inquiry_date <=', $second_date);
		$this->db->group_by('uploaded_month,uploaded_year');	
		$query = $this->db->get();
		return $query->result();
	}

	public function get_chart_uploaded_service_wise()
	{
		$this->db->select('inquiry_type, sum(inquiry_price) as count');
		$this->db->from('client_inquiry');	
		$this->db->where('client_inquiry_status',0);
		$this->db->group_by('inquiry_type');	
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_all_client()
	{
	    
	    $this->db->select('client_inquiry.client_id,client.last_login,client.client_name,client.client_company,appointment_date,client.online_status,count(client_inquiry.client_id) as total_projects,sum(appointment_date) as appointment_date,sum(appointment_start_time) as appointment_start_time, sum(appointment_end_time) as appointment_end_time');
	    $this->db->from('client');	
	    $this->db->or_where('client_status',0);
	    $this->db->join('client_inquiry','client_inquiry.client_id = client.client_id','left');
	    $this->db->group_by('client.client_id');

	    $query = $this->db->get();
		return $query->result();
	}
	
	public function get_paid_total($id)
	{
	   $this->db->select('count(client_inquiry.client_id) as total_projects');
	   $this->db->from('client_inquiry');
	   $this->db->where('client_id',$id);
	   $this->db->where('client_inquiry_status',0);
	   $this->db->where('inquiry_balance <=',0.00);
	   
	   $query = $this->db->get();
		$filter = $query->row();
		return $filter->total_projects;
	}
}
?>