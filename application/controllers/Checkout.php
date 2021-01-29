<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Checkout extends CI_Controller
{
 
  public function pay()
  { 
    if($this->session->userdata('client_id')){
      $data['main_content'] = 'front/stripe/checkout';   
      $data['client_inquiry_id'] = $this->uri->segment(3);
      
      $data['inquiry_balance'] = $this->home_m->get_single_field('client_inquiry',array('client_inquiry_id' =>$this->uri->segment(3)),'inquiry_balance');
      
      $general = $data + $this->general();    
      $this->load->view('front/inc/view',$general);
    }   
    else{
      redirect('client-login');
    }   
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



  public function check()
  {
    //check whether stripe token is not empty
    if(!empty($_POST['stripeToken']))
    {
      //get token, card and user info from the form
      $token  = $_POST['stripeToken'];
      $card_num = $_POST['card_num'];
      $card_cvc = $_POST['cvc'];
      $card_exp_month = $_POST['exp_month'];
      $card_exp_year = $_POST['exp_year'];
      $price = $_POST['total_amount'];
      $project_id = $_POST['inquiry_id'];
      
      $phone = $this->session->userdata('client_phone_number');
      $user_id = $this->session->userdata('client_id');
      $email = $this->session->userdata('client_email');
      $name = $this->session->userdata('client_name');
      
      require_once APPPATH."third_party/stripe/init.php";
      
      //-------------------STRIPE TEST ---------------------------------
    //set api key - test
      $stripe = array(
        "secret_key"      => "sk_test_V4PV0QL4LzjH0Bn4hbp3HuLe",
        "publishable_key" => "pk_test_bbpGR0QxhGaiNwq94HzFyQbT"
      ); 
      

      
      \Stripe\Stripe::setApiKey($stripe['secret_key']);
      $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
      ));
      
      $itemName = "Physical Card";
      $itemNumber = 1;//$id;
      $itemPrice = floatval($price * 100);//why price is multiplied by 100
      $currency = "usd";
      $orderID = 1;//$id;
      
      $charge = \Stripe\Charge::create(array(
       'customer' => $customer->id,
       'amount' => $itemPrice,
       'currency' => $currency,
       'description' => $itemNumber,
       'metadata' => array(
         'item_id' => $itemNumber
       )
     ));
      $chargeJson = $charge->jsonSerialize();
      if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
      {
        //order details 
        $amount = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];
        $date = date("Y-m-d H:i:s");
        //insert tansaction data into the database
        $dataDB = array(
         'physical_payment_name' => $name,
         'physical_payment_email' => $email,
         'physical_payment_card_num' => substr($card_num, 12),
         'physical_payment_card_cvc' => sha1($card_cvc),
         'physical_payment_card_exp_month' => $card_exp_month,
         'physical_payment_card_exp_year' => $card_exp_year,
         'physical_payment_item_name' => $itemName,
         'physical_payment_item_number' => $itemNumber,
         'physical_payment_item_price' => floatval($itemPrice / 100),
         'physical_payment_item_price_currency' => $currency,
         'physical_payment_paid_amount' => $amount,
         'uploaded_month' => date('m'),
         'physical_payment_paid_amount_currency' => $currency,
         'physical_payment_txn_id' => $balance_transaction,
         'physical_payment_status' => $status,
         'physical_payment_created' => $date,
         'physical_payment_modified' => $date
       );
        if ($this->db->insert('physical_payment', $dataDB)) {
          if($this->db->insert_id() && $status == 'succeeded'){
            $rand = strtoupper(substr(uniqid(sha1(time())),0,5));
            $unique = $rand;
            $orders_no = $unique;

            $projectdetails = $this->home_m->get_list_single('client_inquiry',array('client_inquiry_id'=>$project_id));

            $totalpaid = $projectdetails->inquiry_paid + $price;
            $totalbalance = $projectdetails->inquiry_balance - $price;

            $data4 = array(
              'inquiry_paid' => $totalpaid,
              'inquiry_balance' => $totalbalance
            );

            $this->home_m->update_data('client_inquiry',$data4,array('client_id' => $this->session->userdata('client_id'),'client_inquiry_id' =>$project_id));

            

            if($this->session->userdata('client_id')){
              $data['client_id'] = $this->session->userdata('client_id');   
            }       
            $data['total_amount'] = $_POST['total_amount'];

            $data2['client_id'] = $this->session->userdata('client_id');
            $data2['payment_no'] = $orders_no;
            $data2['inquiry_id'] = $project_id;
            $data2['client_payments_amount'] = $_POST['total_amount'];
            $data2['uploaded_month'] = date('m');
            $data2['year'] = date("Y");
            $data2['client_payments_pay_status'] = 'Paid';

            $this->home_m->add_data('client_payments',$data2); 

            $invocieid = $data['insertID'] = $this->db->insert_id();
            
            //--------------------------------------------- EMAIL ON STRIPE SUCCESS  START --------------------------------------------------------------------------------------------
            
            		$section['body'] = '<table>';
					$section['body'] .='<tr><td>Stripe payment success.<br><br> You have received a sum of '.$data2['client_payments_amount'].' in your stripe account<td></tr>';
					$section['body'] .='<tr><td>Kindly login into your dashboard to view invoice<br>'.base_url("admin").'<br><br></td></tr>';
					
					$section['body'] .='<tr><td><br><b>DETAILS<b></td></tr>';
					
					$section['body'] .='<tr><td>Client Name: '.get_value_by_id("client",$data2['client_id'],'client_email').'<br><td></tr>';
					$section['body'] .='<tr><td>Total Amount: '.$data2['client_payments_amount'].'<br><td></tr>';
					$section['body'] .='<tr><td>Payment Number: '.$data2['payment_no'].'<br><td></tr>';
					$section['body'] .='<tr><td>Inquiry Name: '.get_value_by_id("client_inquiry",$data2['inquiry_id'],'inquiry_name').'<br><td></tr>';
					$section['body'] .='<tr><td>Pay Status: '.$data2['client_payments_pay_status'].'<br><td></tr>';
					
					$section['body'] .='<tr><td><br>This is a computer generated email invoice and does not require a reply.</td></tr>';
					$section['body'].= '</table>';
					$section['subject'] = 'User paid from stripe account';
					$body = $this->load->view('email/template',$section, TRUE);
					$result = send_email('muhammad.minhaj@technado.co','Stripe successful payment for NY Landlords',$body);
					
					
			//--------------------------------------------- EMAIL ON STRIPE SUCCESS  END --------------------------------------------------------------------------------------------

            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Transaction Completed.');

            redirect('client-view-update/client_payments/'.$invocieid);
          }else{
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'Transaction has been failed');
          }
        }
        else
        {
          $this->session->set_flashdata('msg', '2');
          $this->session->set_flashdata('alert_data', 'not inserted. Transaction has been failed');
        }
      }
      else
      {
        echo "Invalid Token";
        $statusMsg = "";
      }
    }
  }
}

