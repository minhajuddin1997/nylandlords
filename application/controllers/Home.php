<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->oip_email = "info@nylandlords.com";
        $this->second = "info@nylandlords.com";

    }
    //-------------------------------------------------------------------------------------------------------------
    //--------------------------------------- PAGE LOAD AND DATA ALLOCATION SECTION -------------------------------
    //-------------------------------------------------------------------------------------------------------------
    public function index()
    {
        if ($this->session->userdata('client_id')) {
            // $data['chartdatastatuswise'] = $this->home_m->get_chart_data_pie();
            // $data['uploadedservicewise'] = $this->home_m->get_chart_uploaded_service_wise();
            // $data['uploadedpaymentwise'] = $this->home_m->get_chart_payment_month_wise();
            // $data['uploadedmonthwise'] = $this->home_m->get_chart_uploaded_month_wise();
            // $data['paidcompareunpaid'] = $this->home_m->get_chart_compare();
            $data['main_content'] = 'front/user/list';		
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }
    

    public function registration(){
        if(!empty($_POST)):
            $table = 'client';
            $_POST['client_password'] = $this->encryption->encrypt($_POST['client_password']);
            $data = $_POST;
            
            // basic email field with email validation
            $this->form_validation->set_rules('client_email', 'Client email already exists or', 'required|is_unique[client.client_email]');
            if ($this->form_validation->run()) {
                $id = $this->admin_m->add_data($table, $data);
                if($id){
                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'User Registration Successfull');
                    redirect('client-login');
                }
            } else{
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Invalid Form Inputs');
                redirect('registration');
            }
        else:
            $this->load->view('front/register');
        endif;
    }
    
    
    public function view($table)
    {
        if ($this->session->userdata('client_id')) {
            $id = $this->uri->segment(3);
            $table_id = $table . '_id   ';
            $data['records'] = $this->home_m->get_list($table, array($table_id => $id));
            $data['main_content'] = 'front/' . $table . '/view';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }


    public function general()
    {
        $data['site_title'] = $this->home_m->get_single_field('settings', '', 'site_title');
        $data['header_logo'] = $this->home_m->get_single_field('settings', '', 'header_logo');
        $data['footer_logo'] = $this->home_m->get_single_field('settings', '', 'footer_logo');
        $data['fav_icon'] = $this->home_m->get_single_field('settings', '', 'fav_icon');
        $data['phone_no'] = $this->home_m->get_single_field('settings', '', 'phone_no');
        $data['address'] = $this->home_m->get_single_field('settings', '', 'address');
        $data['footer_tagline'] = $this->home_m->get_single_field('settings', '', 'footer_tagline');
        $data['email_add'] = $this->admin_m->get_single_field('settings', '', 'email_add');

        return $data;
    }

    public function add($table)
    {
        if ($this->session->userdata('client_id')) {
            $data['main_content'] = 'front/' . $table . '/add';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function remove_notification($id)
    {
        $data = array(
            'pass_change_notification' => '',
        );

        $this->home_m->update_data('client', $data, array('client_id' => $id));

        $this->session->set_flashdata('msg', '1');
        $this->session->set_flashdata('alert_data', 'Successfull');
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function login()
    {
        if (!empty($_POST)) {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $result = $this->admin_m->get_list('client', array('client_email' => $email));

            if ($result) {
                foreach ($result as $row) {

                    $id = $row->client_id;
                    $pass = $row->client_password;
                    $email = $row->client_email;
                    $image = $row->client_image;
                    $name = $row->client_name;
                    $phone = $row->client_phone_number;
                    $client_login_detail = $row->client_login_detail;
                }


                if ($this->encryption->decrypt($pass) == $password && $client_login_detail == 'enable') {
                    $session_data = array(
                        'client_id' => $id,
                        'client_email' => $email,
                        'client_name' => $name,
                        'client_image' => $image,
                        'client_active' => 'yes',
                    );
                    $this->session->set_userdata($session_data);

                    $section['body'] = '<table>';
                    $section['body'] .= '<tr><td>User Profile Service.<br><br> you have been logged on with the your profile for the system, if its not you, contact your administrator.<td></tr>';
                    $section['body'] .= '<tr><td><br>Client Name:' . $name . '</td></tr>';
                    $section['body'] .= '<tr><td><br>' . base_url("") . '<br><br></td></tr>';
                    $section['body'] .= '<tr><td><br>This is a computer generated email and does not require a reply.</td></tr>';
                    $section['body'] .= '</table>';
                    $section['subject'] = 'User logged in into NYLandlord Dashboard';
                    $body = $this->load->view('email/template', $section, TRUE);
                    //send_email($this->second,'User logged in into Pluto Projects Dashboard',$body);
                    $result = send_email($this->oip_email, 'User logged in into NYLandlord Dashboard', $body);


                    $data3 = array('online_status' => 'online', 'last_login' => date('Y-m-d H:i:s'));
                    $this->home_m->update_data('client', $data3, array('client_id' => $id));

                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'Login Successfull.');

                    redirect('client-list/client_inquiry');
                } else {
                    $this->session->set_flashdata('msg', '2');
                    $this->session->set_flashdata('alert_data', 'Invalid Email Or Password.');
                    redirect('client-login');
                }
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Invalid Email Or Password.');
                redirect('client-login');
            }

        } else {
            $this->load->view('front/login');
        }
    }

    public function edit($table)
    {
        $data2 = array(
            'client_id' => $this->session->userdata('client_id'),
            'name' => $this->session->userdata('client_name'),
            'email' => $this->session->userdata('client_email'),
            'view_page' => 'Profile View',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'os' => php_uname(),
            'browser' => $this->agent->browser(),

        );
        $this->home_m->add_data('logs', $data2);
        if ($this->session->userdata('client_id')) {
            $id = $this->uri->segment(3);
            $table_id = $table . '_id   ';
            $data['records'] = $this->admin_m->get_list($table, array($table_id => $id));
            $data['main_content'] = 'front/' . $table . '/edit';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('client-login');
        }
    }

    public function lists($table)
    {
        if ($this->session->userdata('client_id')) {
            $data['records'] = $this->admin_m->get_list($table, array('client_id' => $this->session->userdata('client_id')));
            $data['main_content'] = 'front/' . $table . '/list';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function add_data($table)
    {
        if ($this->session->userdata('client_id')) {
            foreach ($_POST as $key => $val) {
                if (strpos($key, 'slug') !== false) {
                    $result = check_slug($table, $this->input->post($key));
                    $data[$key] = $result;
                } else {
                    $data[$key] = $this->input->post($key);
                }
            }

            if (!empty($_FILES['summary_file']['name'])) {
                $data['summary_file'] = single_image_upload($_FILES['summary_file'], "./uploads/" . "client_inquiry");
            }


            if (!empty($this->input->post('client_email'))) {
                $this->form_validation->set_rules('client_email', 'Client email already exists or', 'required|is_unique[client.client_email]');

                if ($this->form_validation->run()) {

                    $this->session->set_flashdata('msg', '1');
                    $this->session->set_flashdata('alert_data', 'User Registration Successfull');
                    $id = $this->admin_m->add_data($table, $data);
                    redirect('list/' . $table, 'refresh');
                }
            } else {
                $id = $this->admin_m->add_data($table, $data);
                //redirect('list/'.$table,'refresh');
                if ($table == "client_inquiry") {

                    $section['body'] = '<table>';
                    $section['body'] .= '<tr><td>Client Name: <b>' . get_name_by_id("client", $_POST['client_id']) . '</b><br><td></tr>';
                    $section['body'] .= '<tr><td>Inquiry Name: <b>' . $_POST['inquiry_name'] . '</b><br><td></tr>';
                    $section['body'] .= '<tr><td>Inquiry Type: <b>' . get_name_by_id("department", $_POST['inquiry_type']) . '</b><br><td></tr>';
                    $section['body'] .= '<tr><td>Inquiry Summary: ' . $_POST['inquiry_summary'] . '<br><td></tr>';
                    $section['body'] .= '<tr><td><br>' . base_url("") . '<br></td></tr>';
                    $section['body'] .= '<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                    $section['body'] .= '</table>';
                    $section['subject'] = 'New Inquiry added by ' . get_name_by_id("client", $_POST['client_id']);
                    $body = $this->load->view('email/template', $section, TRUE);
                    $result = send_email($this->oip_email, 'New Inquiry added', $body);
                    //send_email($this->second,'New project added',$body);
                    $result = send_email(get_value_by_id("client", $_POST['client_id'], 'client_email'), 'New Inquiry added', $body);
                }

            }

            if (!empty($id)) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Client Registration Success.');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Failed To Add');
            }
            if ($this->uri->segment(2) != "client") {
                redirect('client-list/' . $table, 'refresh');
            }

        } else {
            redirect('login');
        }

    }

    public function update_data($table)
    {

        if ($this->session->userdata('client_id')) {
            $id = $this->uri->segment(3);
            foreach ($_POST as $key => $val) {
                if (strpos($key, 'slug') !== false) {
                    $result = check_slug_edit($table, $this->input->post($key), $id);
                    $data[$key] = $result;
                } elseif (strpos($key, 'product_info') !== false) {
                    $data['product_info'] = serialize(array_combine($this->input->post('product_info_key'), $this->input->post('product_info_value')));
                } else {
                    if (strpos($key, 'product_img_image') !== false) {
                        $data2['product_img_status'] = '1';
                        $this->admin_m->update_data('product_img', $data2, 'product_id =' . $id . '');
                        $cpt = count($this->input->post($key));
                        for ($i = 0; $i < $cpt; $i++) {
                            $data1[$key] = $_POST[$key][$i];
                            $data1['product_id'] = $id;
                            $this->admin_m->add_data('product_img', $data1);
                        }
                    } else {
                        $data[$key] = $this->input->post($key);
                    }
                }
            }
            foreach ($_FILES as $key => $val) {
                if ($_FILES[$key]['name']) {

                    if (strpos($key, 'product_img_image') !== false) {
                        $this->upload_muntiimage('product_img', $key, $id);
                    } else {
                        $data[$key] = $this->upload_image($table, $key);
                    }
                }
            }

            $table_id = $table . '_id   ';
            $result = $this->admin_m->update_data($table, $data, array($table_id => $id));
            if ($result) {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Updated Successfully');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Update Failed');
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('client-login');
        }
    }

    public function front_update_password()
    {

        $this->form_validation->set_rules('new_password', 'New Password', 'trim|min_length[3]|max_length[25]');
        $this->form_validation->set_rules('cnf_password', 'Confirm Password', 'trim|matches[new_password]');
        if (!$this->form_validation->run() == FALSE) {

            $data = array(
                'client_password' => $this->encryption->encrypt($this->input->post('new_password')),
            );
            $this->home_m->update_data('client', $data, array('client_id' => $this->session->userdata('client_id')));

            $this->session->set_flashdata('msg', '1');
            $this->session->set_flashdata('alert_data', 'Password Updated');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'Password Update Failed');
            redirect($_SERVER['HTTP_REFERER']);
        }


    }

    public function logout()
    {
        $data3 = array('online_status' => 'offline');
        $this->home_m->update_data('client', $data3, array('client_id' => $this->session->userdata('client_id')));

        $this->session->unset_userdata('client_id');
        redirect('home');
    }

    public function payment_details()
    {

        if ($this->session->userdata('client_id')) {
            $paymentsamount = $this->input->post('paypal_payment');
            $clientid = $this->session->userdata('client_id');

            $today = date("Ymd");
            $rand = strtoupper(substr(uniqid(sha1(time())), 0, 12));
            $unique = $today . $rand;
            $orders_no = $unique;

            $data = array(
                'payment_no' => $orders_no,
                'client_id' => $clientid,
                'client_payments_amount' => $paymentsamount,
                'client_payments_pay_status' => 'Unpaid'
            );
            $payment_id = $this->home_m->add_data('client_payments', $data);
            $this->paypal($payment_id);

        } else {
            $this->session->set_flashdata('msg', '2');
            $this->session->set_flashdata('alert_data', 'User not found');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function read_status_view($table)
    {
        if ($this->session->userdata('client_id')) {
            $id = $this->uri->segment(3);
            $table_id = $table . '_id   ';
            $data['records'] = $this->admin_m->get_list($table, array($table_id => $id));
            $data['main_content'] = 'front/' . $table . '/view';
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function inquiry_details($id)
    {
        if ($this->session->userdata('client_id')) {
            $toupdatedata = array(
                "comments_read_client" => "read"
            );

            $this->home_m->update_data('comments', $toupdatedata, array('inquiry_id' => $id));
            $data['comments'] = $this->home_m->get_list('comments', array('inquiry_id' => $id), '', 'comments_id', 'DESC');
            $data['records'] = $this->home_m->get_list('client_inquiry', array('client_inquiry_id' => $id));
            $data['main_content'] = 'front/client_inquiry/details';
            $general = $data + $this->general();

            $data2 = array(
                'client_id' => $this->session->userdata('client_id'),
                'name' => $this->session->userdata('client_name'),
                'email' => $this->session->userdata('client_email'),
                'view_page' => 'Inquiry Detail',
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'os' => php_uname(),
                'browser' => $this->agent->browser(),

            );
            $this->home_m->add_data('logs', $data2);

            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function reply_comment()
    {

        if ($this->session->userdata('client_id')) {
            $data = array(
                'inquiry_id' => $this->input->post('inquiry_id'),
                'sender_id' => $this->input->post('sender_id'),
                'comments_text' => $this->input->post('comments_text'),
            );
            if(!empty($data['comments_text'])){
                $return_id = $this->home_m->add_data('comments', $data);
            }

            if (isset($return_id)) {
                $section['body'] = '<table>';
                $section['body'] .= '<tr><td>New comment on inquiry.<br><br> A new comment has been added with following details.<br><td></tr>';
                $section['body'] .= '<tr><td>Client Name: <b>' . get_name_by_id("client", $this->input->post('sender_id')) . '</b><br><td></tr>';
                $section['body'] .= '<tr><td>Inquiry Name: <b>' . get_value_by_id("client_inquiry", $_POST['inquiry_id'], 'inquiry_name') . '</b><br><td></tr>';
                $section['body'] .= '<tr><td>Comment on inquiry: ' . $_POST['comments_text'] . '<br><td></tr>';
                $section['body'] .= '<tr><td><br>' . base_url("admin") . '<br><br></td></tr>';
                $section['body'] .= '<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'] .= '</table>';
                $section['subject'] = 'New comment added by ' . get_name_by_id("client", $_POST['sender_id']);
                $body = $this->load->view('email/template', $section, TRUE);
                //send_email$this->second,'New comment on project',$body);
                $result = send_email($this->oip_email, 'New comment on inquiry', $body);


                if (!empty($_FILES)) {
                    foreach ($_FILES as $key => $val) {
                        if (!empty($val['name'])) {
                            $this->upload_muntiimage('comments_images', $key, $return_id);
                        }

                    }
                }

                if (!empty($_FILES)) {
                    foreach ($_FILES as $key => $val) {
                        $this->upload_multifile('comments_files', $key, $return_id);
                    }
                }
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Comment Successfull');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Comment Failed');
                redirect($_SERVER['HTTP_REFERER']);
            }

        } else {
            redirect('login');
        }
    }

    public function reply_support()
    {

        if ($this->session->userdata('client_id')) {
            $data = array(
                'user_id' => $this->input->post('user_admin_id'),
                'sender_id' => $this->input->post('sender_id'),
                'inquiry_id' => $this->session->userdata('client_id'),
                'support_text' => $this->input->post('support_text'),
            );
            if(empty($data['support_text'])){
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Comment Failed');
                redirect($_SERVER['HTTP_REFERER']);
                exit;
            }
            $return_id = $this->home_m->add_data('support', $data);

            if ($return_id) {
                $section['body'] = '<table>';
                $section['body'] .= '<tr><td>New comment from client support.<br><br> A new comment has been added with following details.<br><td></tr>';
                $section['body'] .= '<tr><td>User Name: <b>' . get_name_by_id("user", $this->input->post('user_admin_id')) . '</b><br><td></tr>';
                $section['body'] .= '<tr><td>Client Name: <b>' . get_name_by_id("client", $this->input->post('sender_id')) . '</b><br><td></tr>';
                $section['body'] .= '<tr><td>Comment on inquiry: ' . $_POST['support_text'] . '<br><td></tr>';
                $section['body'] .= '<tr><td><br>' . base_url("admin") . '<br><br></td></tr>';
                $section['body'] .= '<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'] .= '</table>';
                $section['subject'] = 'New comment from support by ' . get_name_by_id("client", $_POST['sender_id']);
                $body = $this->load->view('email/template', $section, TRUE);
                $result = send_email($this->oip_email, 'New comment from client support', $body);
                //send_email($this->second,'New comment from client support',$body);


                if (!empty($_FILES)) {
                    foreach ($_FILES as $key => $val) {
                        if (!empty($val['name'])) {
                            $this->upload_supp_multi_image('support_images', $key, $return_id);
                        }

                    }
                }

                if (!empty($_FILES)) {
                    foreach ($_FILES as $key => $val) {
                        $this->upload_supp_multi_file('support_files', $key, $return_id);
                    }
                }
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Comment Successfull');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Comment Failed');
                redirect($_SERVER['HTTP_REFERER']);
            }

        } else {
            redirect('login');
        }
    }

    public function push_notification()
    {
        $notifications = count($this->home_m->get_list('comments'));
        print_r($notifications);
    }

    public function files_upload_editor()
    {

        $multi_image = $_FILES['files']['name'];

        for ($j = 0; $j < count(array($_FILES['files']['tmp_name'])); $j++) {
            if ($_FILES['files']['size'][$j] > 0) {
                $image = multi_image_upload($_FILES['files'], $j, './uploads/editor');
                if (is_array($image)) {
                    $this->session->set_flashdata('error', $image);
                } else {
                    exit(json_encode(base_url('uploads/editor/') . $image));
                }
            }
        }

    }

    public function upload_supp_multi_file($table, $field, $id)
    {
        $config['upload_path'] = './uploads/' . $table . '';
        $config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $files = $_FILES;
        if (empty($_FILES[$field]['name'][0])) {
            return false;
        }

        $cpt = count(array($_FILES[$field]['name']));


        $cpt;
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['f']['name'] = $files[$field]['name'][$i];
            $_FILES['f']['type'] = $files[$field]['type'][$i];
            $_FILES['f']['tmp_name'] = $files[$field]['tmp_name'][$i];
            $_FILES['f']['error'] = $files[$field]['error'][$i];
            $_FILES['f']['size'] = $files[$field]['size'][$i];
            if ($this->upload->do_upload('f')) {

                $file_detail = $this->upload->data();
                $data1['support_files_file'] = $file_detail['file_name'];
                $data1['extension'] = $file_detail['file_ext'];
                $data1['support_id'] = $id;
                $result = $this->admin_m->add_data('support_files', $data1);

            } else {
                if (strpos($this->upload->display_errors(), 'did not select') !== false) {
                    return 1;
                } else {

                    return 1;
                }
            }
        }
        return 1;
    }

    public function upload_supp_multi_image($table, $field, $id)
    {
        $config['upload_path'] = './uploads/' . $table . '';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $files = $_FILES;
        if (empty($_FILES[$field]['name'][0])) {
            return false;
        }

        $cpt = count(array($_FILES[$field]['name']));
        $cpt;
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['f']['name'] = $files[$field]['name'][$i];
            $_FILES['f']['type'] = $files[$field]['type'][$i];
            $_FILES['f']['tmp_name'] = $files[$field]['tmp_name'][$i];
            $_FILES['f']['error'] = $files[$field]['error'][$i];
            $_FILES['f']['size'] = $files[$field]['size'][$i];
            if ($this->upload->do_upload('f')) {

                $file_detail = $this->upload->data();
                $data1['support_images_img'] = $file_detail['file_name'];
                $data1['support_id'] = $id;
                $result = $this->admin_m->add_data($table, $data1);

            } else {
                if (strpos($this->upload->display_errors(), 'did not select') !== false) {
                    return 1;
                } else {
                    //  $_SESSION["msg_detail"] = $this->upload->display_errors() ;
                    //  $this->session->set_flashdata('msg', '2');
                    //  $this->session->set_flashdata('alert_data', 'Failed');
                    //  echo $this->upload->display_errors();
                    return 1;
                }
            }
        }
        return 1;
    }

    public function upload_muntiimage($table, $field, $id)
    {
        $config['upload_path'] = './uploads/' . $table . '';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $files = $_FILES;
        if (empty($_FILES[$field]['name'][0])) {
            return false;
        }

        $cpt = count(array($_FILES[$field]['name']));
        $cpt;
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['f']['name'] = $files[$field]['name'][$i];
            $_FILES['f']['type'] = $files[$field]['type'][$i];
            $_FILES['f']['tmp_name'] = $files[$field]['tmp_name'][$i];
            $_FILES['f']['error'] = $files[$field]['error'][$i];
            $_FILES['f']['size'] = $files[$field]['size'][$i];
            if ($this->upload->do_upload('f')) {

                $file_detail = $this->upload->data();
                $data1['comments_images_img'] = $file_detail['file_name'];
                $data1['comments_id'] = $id;
                $result = $this->admin_m->add_data($table, $data1);

            } else {
                if (strpos($this->upload->display_errors(), 'did not select') !== false) {
                    return 1;
                } else {
                    //  $_SESSION["msg_detail"] = $this->upload->display_errors() ;
                    //  $this->session->set_flashdata('msg', '2');
                    //  $this->session->set_flashdata('alert_data', 'Failed');
                    //  echo $this->upload->display_errors();
                    return 1;
                }
            }
        }
        return 1;
    }

    public function upload_multifile($table, $field, $id)
    {
        $config['upload_path'] = './uploads/' . $table . '';
        $config['allowed_types'] = 'pdf|docx|pptx|txt|xlsx|rar|zip';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $files = $_FILES;
        if (empty($_FILES[$field]['name'][0])) {
            return false;
        }

        $cpt = count(array($_FILES[$field]['name']));


        $cpt;
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['f']['name'] = $files[$field]['name'][$i];
            $_FILES['f']['type'] = $files[$field]['type'][$i];
            $_FILES['f']['tmp_name'] = $files[$field]['tmp_name'][$i];
            $_FILES['f']['error'] = $files[$field]['error'][$i];
            $_FILES['f']['size'] = $files[$field]['size'][$i];
            if ($this->upload->do_upload('f')) {

                $file_detail = $this->upload->data();
                $data1['comments_files_file'] = $file_detail['file_name'];
                $data1['extension'] = $file_detail['file_ext'];
                $data1['comments_id'] = $id;
                $result = $this->admin_m->add_data('comments_files', $data1);

            } else {
                if (strpos($this->upload->display_errors(), 'did not select') !== false) {
                    return 1;
                } else {

                    return 1;
                }
            }
        }
        return 1;
    }

    //test client support
    public function get_client_support_user($id, $admin_id = '')
    {
        $data2 = array(
            'client_id' => $this->session->userdata('client_id'),
            'name' => $this->session->userdata('client_name'),
            'email' => $this->session->userdata('client_email'),
            'view_page' => 'Client Support',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'os' => php_uname(),
            'browser' => $this->agent->browser(),

        );
        $this->home_m->add_data('logs', $data2);


        if ($this->session->userdata('client_id')) {
            $data['comments'] = $this->home_m->get_list('support', array('inquiry_id' => $this->session->userdata('client_id'), 'user_id' => $admin_id), '', 'support_id', 'DESC');
            $data['records'] = $this->home_m->get_list('client_inquiry', array('client_inquiry_id' => $id));
            $data['main_content'] = 'front/support/edit';
            $data['user_admin_id'] = $admin_id;


            $data['admin_available'] = $this->db->select('*')->from('default_available')
                ->where('user_id', $this->uri->segment(4))->get()->row();
            $data['appointments']=$this->db->select('app_depart,appointment_type_id')->from('appointment_type')
                ->where('user_id',$admin_id)->get()->result();

            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function get_client_support($id)
    {
        $data2 = array(
            'client_id' => $this->session->userdata('client_id'),
            'name' => $this->session->userdata('client_name'),
            'email' => $this->session->userdata('client_email'),
            'view_page' => 'Client Support',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'os' => php_uname(),
            'browser' => $this->agent->browser(),

        );
        $this->home_m->add_data('logs', $data2);


        if ($this->session->userdata('client_id')) {
            $data['comments'] = $this->home_m->get_list('support', array('inquiry_id' => $this->session->userdata('client_id')), '', 'support_id', 'DESC');
            $data['records'] = $this->home_m->get_list('client_inquiry', array('client_inquiry_id' => $id));
            $data['main_content'] = 'front/support/edit';

            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function forget_form()
    {
        $this->load->view('front/forget-form');
    }

    public function get_support_chat_list()
    {

        $data2 = array(
            'client_id' => $this->session->userdata('client_id'),
            'name' => $this->session->userdata('client_name'),
            'email' => $this->session->userdata('client_email'),
            'view_page' => 'Client Support list',
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'os' => php_uname(),
            'browser' => $this->agent->browser(),

        );
        $this->home_m->add_data('logs', $data2);
        if ($this->session->userdata('client_id')) {
            $data['comments'] = $this->home_m->get_list('support', array('inquiry_id' => $this->session->userdata('client_id')), '', 'support_id', 'DESC');
            //  $data['records'] = $this->home_m->get_list('client_projects',array('client_projects_id' => $id));
            $data['main_content'] = 'front/support/list';
            $data['records'] = $this->db->select('*')->get('user')->result();
            $general = $data + $this->general();
            $this->load->view('front/inc/view', $general);
        } else {
            redirect('login');
        }
    }

    public function password_recovery_email()
    {

        if (!empty($_POST)) {
            $email = $this->input->post('user_email', TRUE);
            $result = $this->home_m->get_list('client', array('client_email' => $email));
            if ($result) {
                $today = date("Ymd");
                $rand = strtoupper(substr(uniqid(sha1(time())), 0, 120));
                $unique = $today . $rand;
                $forgot_password_token = $unique;
                $data['forgot_password_token'] = $forgot_password_token;
                $this->admin_m->update_data('client', $data, array('client_email' => $email));
                $this->resset_pass_email($email, $forgot_password_token);
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Reset link send successfull');
                redirect('home/login');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Resset link send failed');
                redirect('admin/login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function resset_pass_email($email, $forgot_password_token)
    {
        $section['subject'] = 'Password Reset Link';
        $section['body'] = '<strong>Reset Link :</strong> <a href="' . base_url('Home/front_resset_password/') . $forgot_password_token . '">Click here and you will be redirected to the website.</a>';
        $body = $this->load->view('email/template', $section, TRUE);
        $result = send_email($email, 'Password Reset Link', $body);
        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    public function front_resset_password($id)
    {

        if ($_POST) {

            $data = array(
                'client_password' => $this->encryption->encrypt($this->input->post('new_password')),
            );

            $update = $this->home_m->update_data('client', $data, array('forgot_password_token' => $id));
            if ($update > 0) {

                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'Password Change Successfully');
                redirect('home/login');
            } else {
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Some Thing Wrong');
                redirect('home/login');
            }

        } else {

            $this->load->view("front/reset-password");
        }

    }

    public function photo_delete()
    {
        if (!unlink($_POST['photolink'])) {
            echo 2;
        } else {
            echo 1;
        }

    }
    
    public function register()
    {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('client_email', 'Client email already exists or', 'required|is_unique[client.client_email]');
            if ($this->form_validation->run()) {
                $id = $this->admin_m->add_data('client', $_POST);
                $section['body'] = '<table>';
                $section['body'] .= '<tr><td>Thank you for registration! NYLandlord welcomes you on the board.<br><td></tr>';
                $section['body'] .= '<tr><td>Here is your login credentials.<br><td></tr>';
                $section['body'] .= '<tr><td>Email: </td><td>'.$_POST['client_email'].'<br>';
                $section['body'] .= '<tr><td>Password: </td><td>'.$_POST['client_password'].'<br>';
                $section['body'] .= '<tr><td><br>This is a computer generated email and does not require a reply</td></tr>';
                $section['body'] .= '</table>';
                $section['subject'] = 'Registration at NYLandlord';
                $body = $this->load->view('email/template', $section, TRUE);
                $result = send_email('muhammad.minhaj@technado.co', 'Client Registration', $body);
                //send_email($this->second,'New project added',$body);
                $this->session->set_flashdata('msg', '1');
                $this->session->set_flashdata('alert_data', 'User Registration Successfull');
                redirect('pay');
            } else{
                $this->session->set_flashdata('msg', '2');
                $this->session->set_flashdata('alert_data', 'Error occurred.');
                redirect('home/register');
            }
        } else {
            $this->load->view("front/register");
        }
    }
    

//End of Program Write All Funtions Above this line ----------------------------------------------------    
}
