<?php
	$this->load->view('front/inc/header');
	$this->load->view('front/inc/side_nav');
	$this->load->view('front/inc/nav');
	isset($main_content)?$this->load->view(''.$main_content.''):'';
	$this->load->view('front/inc/footer');	
?>