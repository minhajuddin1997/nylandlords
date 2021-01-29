<div class="sidebar" data-color="purple" data-image="<?php echo base_url('uploads/developer/').$this->admin_m->get_single_field('developer','','front_nav_image');?>">
    <style>
        .sidebar:after {background: linear-gradient(to bottom, <?php echo $this->admin_m->get_single_field('developer','','front_nav_color');?> 0%, <?php echo $this->admin_m->get_single_field('developer','','front_nav_gradient');?> 133%) !important;}
    </style>
    <div class="sidebar-wrapper">
        <div class="logo"><a href="#" class="simple-text"><img style="max-width:200px;" class="img-responsive" src="<?php echo base_url('uploads/settings/').$this->admin_m->get_single_field('settings','','footer_logo');?>"></a></div>
        <ul class="nav">
            <li><a href="<?php echo base_url('Survey/cost')?>"><i class="fa fa-certificate"></i><p>Advisory</p></a></li>
            <li class="<?php echo ($this->uri->segment(2) == "client_inquiry")?'active':''; ?>"><a href="<?php echo base_url('client-list/client_inquiry');?>"><i class="pe-7s-albums"></i><p>My inquiry</p></a></li>
            <?php
            $count = !empty(get_list('client_inquiry',array('client_id'=>$this->session->userdata('client_id')))) ? get_list('client_inquiry',array('client_id'=>$this->session->userdata('client_id'))) : [];
            $showdash = count($count);
            ?>
            <?php if($showdash): ?>
            <!--<li class="<?php //echo ($this->uri->segment(1) == "home" && $this->uri->segment(2) == "")?'active':''; ?>"><a href="<?php //echo base_url('home');?>"><i class="pe-7s-graph"></i><p>Dashboard</p></a></li>-->
            <?php else: ?>
            <?php endif; ?>
            <!--<li class="<?php //echo ($this->uri->segment(2) == "client_payments")?'active':''; ?>"><a href="<?php //echo base_url('client-list/client_payments');?>"><i class="pe-7s-news-paper"></i><p>Payments</p></a></li>-->
            <li class="<?php echo ($this->uri->segment(2) == "get_support_chat_list")?'active':''; ?>"><a href="<?php echo base_url('home/get_support_chat_list/');?>"><i class="pe-7s-ribbon"></i><p>Member Support</p></a></li>
            <li class="<?php echo ($this->uri->segment(2) == "client")?'active':''; ?>"><a href="<?php echo base_url('client-edit/client/').$this->session->userdata('client_id');?>"><i class="pe-7s-user"></i><p>Profile Settings</p></a></li>

            <!--<li class="<?php //echo ($this->uri->segment(1) == "File_Upload")?'active':''; ?>"><a href="<?php //echo base_url('File_Upload')?>"><i class="pe-7s-file"></i><p>File Uploads</p></a></li>-->
            <!--<li class="<?php //echo ($this->uri->segment(1) == "ClientAppointment")?'active':''; ?>"><a href="<?php //echo base_url('ClientAppointment/index')?>"><i class="pe-7s-id"></i><p>Appointments </p></a></li>-->
            <li class="<?php echo ($this->uri->segment(1) == "MarketPlace")?'active':''; ?>"><a href="<?php echo base_url('MarketPlace/index')?>"><i class="fas fa-bullhorn"></i><p>Market Place </p></a></li>
            <!--<li class="<?php //echo ($this->uri->segment(1) == "Survey")?'active':''; ?>"><a href="<?php //echo base_url('Survey/index')?>"><i class="fas fa-check-square"></i><p>Survey </p></a></li>-->

        </ul>
</div>
</div>


<style type="text/css">
.dropdown-menu li a
{
    color:#000 !important;
}
.bcktrans
{
    background: rgba(255, 255, 255, 0.14);
}
.collapse li a
{
    font-size: 16px;
}
</style>