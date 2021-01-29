<?php 

class Home_M extends CI_Model{

	public function add_data($tabel,$data) 
	{
		$this->db->insert($tabel,$data);
		return $this->db->insert_id();
	}

    public function get_value_by_id($table = "",$id = "",$field = "")
	{
		$this->db->select($field)->where($table.'_id',$id);
        $query = $this->db->get($table);
        $result = $query->row();
        return $result;
	}
	public function get_column_list($tabel="",$column=""){
	    $this->db->select($column);
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);
		$query = $this->db->get();
		$result = $query->result();
		return $result; 
	}
	public function get_list($tabel="",$where="",$limit="",$order_col="",$order_by="",$like="",$join_tabel="",$join="",$group_by="",$offset="")
	{				
		$this->db->select('*');
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);		
		if($where){
			$this->db->where($where);
		}
		if($group_by){
			$this->db->group_by($group_by);
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
		if($offset){				
			$this->db->offset($offset);
		}			
		if($join){
			$this->db->join($join_tabel,$join,'left');		
		}	
		$query = $this->db->get();
		$result = $query->result();
		return $result; 		
	}

	public function get_list_single($tabel="",$where="",$limit="",$order_col="",$order_by="",$like="",$join_tabel="",$join="",$group_by="",$offset="")
	{				
		$this->db->select('*');
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);		
		if($where){
			$this->db->where($where);
		}
		if($group_by){
			$this->db->group_by($group_by);
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
		if($offset){				
			$this->db->offset($offset);
		}			
		if($join){
			$this->db->join($join_tabel,$join,'left');		
		}	
		$query = $this->db->get();
		$result = $query->row();
		return $result; 		
	}

	public function attributes($limit="",$where="",$order_col="",$order_by="",$group_by="")
	{			
		$this->db->select('*');
		$this->db->from('product_to_variant');				
		$this->db->where('product_to_variant_status',0);

		if($order_by){
			$this->db->order_by($order_col, $order_by);
		}
		if($group_by){
			$this->db->group_by($group_by);
		}		
		if($where){
			$this->db->where($where);
		}	
		if($limit){
			$this->db->limit($limit);
		} 
		$this->db->join('attribute','attribute.attribute_id = product_to_variant.attribute_id','left');
		$this->db->join('variant','variant.variant_id = product_to_variant.variant_id','left');
		$this->db->where('attribute_status',0);							
		$this->db->where('variant_status',0);					
		$query = $this->db->get();
		$result = $query->result();
		return $result; 
	}

	public function sum_function($tabel="",$col,$where="") 
	{	
		$this->db->select('*');
		$this->db->from($tabel);						
		$this->db->where(''.$tabel.'_status',0);

		if($where){
			$this->db->where($where);
		}

		$this->db->select_sum($col);
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

	public function delete_data($tabel,$data,$where)
	{
		$this->db->where(''.$tabel.'_status',0);			
		$this->db->where($where);			
		$result = $this->db->delete($tabel, $data);
		return $result; 
	}
	

	function contact_formdata($data)
	{
		$this->db->insert('contact_inquiry',$data);
	}

	public function record_exists($table,$record)
	{
		$this->db->where($record);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function get_payment_order($tabel="",$where="")
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

	public function update_order_payment($tabel,$data,$where)
	{
		$this->db->where($where);			
		$result = $this->db->update($tabel,$data);
		return $result; 
	}	
	
	public function get_chart_data_pie()
	{
		$this->db->select('delivery_status, count(delivery_status) as count');
		$this->db->from('client_projects');	
		$this->db->where('client_projects_status',0);
		$this->db->where('client_id', $this->session->userdata('client_id'));
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_projects_date >=', $first_date);
		$this->db->where('client_projects_date <=', $second_date);
		$this->db->group_by('delivery_status');	
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_chart_uploaded_service_wise()
	{
		$this->db->select('project_type, count(project_type) as count');
		$this->db->from('client_projects');	
		$this->db->where('client_projects_status',0);
		$this->db->where('client_id', $this->session->userdata('client_id'));
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_projects_date >=', $first_date);
		$this->db->where('client_projects_date <=', $second_date);
		$this->db->group_by('project_type');	
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function get_chart_payment_month_wise()
	{
		$this->db->select('uploaded_month, sum(client_payments_amount) as count');
		$this->db->from('client_payments');	
		$this->db->where('client_payments_status',0);
		$this->db->where('client_id', $this->session->userdata('client_id'));
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_payments_date >=', $first_date);
		$this->db->where('client_payments_date <=', $second_date);
		$this->db->group_by('uploaded_month');	
		$this->db->order_by('uploaded_month');
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function get_chart_uploaded_month_wise()
	{
		$this->db->select('uploaded_month, count(project_balance) as count');
		$this->db->from('client_projects');	
		$this->db->where('client_projects_status',0);
		$this->db->where('client_id', $this->session->userdata('client_id'));
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_projects_date >=', $first_date);
		$this->db->where('client_projects_date <=', $second_date);
		$this->db->group_by('uploaded_month');	
		$query = $this->db->get();
		return $query->result();
	}
	

	
	public function get_chart_compare()
	{
		$this->db->select('sum(project_balance) as balance, sum(project_paid) as paid');
		$this->db->from('client_projects');	
		$this->db->where('client_projects_status',0);
		$this->db->where('client_id', $this->session->userdata('client_id'));
		$second_date = date("Y-m-d 23:59:59",strtotime('+1 days'));	
		$first_date = date("Y-m-d 23:59:59",strtotime('-365 days'));
		$this->db->where('client_projects_date >=', $first_date);
		$this->db->where('client_projects_date <=', $second_date);
		$query = $this->db->get();
		return $query->result();
	}


	

}