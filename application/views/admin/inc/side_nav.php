<div class="sidebar" data-color="purple" data-image="<?php echo base_url('uploads/developer/') . $this->admin_m->get_single_field('developer', '', 'developer_nav_image'); ?>">
    <style>
        .sidebar:after {
            background: linear-gradient(to bottom, <?php echo $this->admin_m->get_single_field('developer','','developer_nav_color');?> 0%, <?php echo $this->admin_m->get_single_field('developer','','developer_nav_gradient');?> 133%) !important;
        }
    </style>
    <div class="sidebar-wrapper">
        <div class="logo"><a href="#" class="simple-text"><img style="max-width:200px;" class="img-responsive" src="<?php echo base_url('uploads/settings/') . $this->admin_m->get_single_field('settings', '', 'footer_logo'); ?>"></a></div>
        <ul class="nav">
            <li class="<?php echo ($this->uri->segment(2) == 'user') ? 'active' : '' ?>"><a href="<?php echo base_url('edit/user/') . $this->session->userdata('user_id'); ?>"><i class="pe-7s-user"></i>
                    <p>Profile Setting</p></a></li>
            <?php if ($this->session->userdata('user_id') == 5): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'settings') ? 'active' : '' ?>"><a href="<?php echo base_url('edit/settings/1'); ?>"><i class="pe-7s-config"></i>
                        <p>Site Settings</p></a></li>
            <?php endif; ?>
            <?php if ($this->session->userdata('user_id') == 5): ?>
                <li class="<?php echo ($this->uri->segment(1) == 'administrator') ? 'active' : '' ?>"><a href="<?php echo base_url('administrator'); ?>"><i class="pe-7s-add-user"></i>
                        <p>Sub Admin Settings</p></a></li>
            <?php endif; ?>

                    <?php if($this->session->userdata('user_id') == 5): ?>
                        <li class="<?php echo ($this->uri->segment(2) == 'department')? 'active':''?>"><a href="<?php echo base_url('list/department');?>"><i class="pe-7s-keypad"></i><p>Department Setting</p></a></li>
                    <?php endif; ?>


            <?php if (in_array('createClient', $this->permissions)): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'client') ? 'active' : '' ?>"><a href="<?php echo base_url('list/client'); ?>"><i class="pe-7s-user"></i>
                        <p>Client Setting</p></a></li>
            <?php endif; ?>

            <!--<li class="<?php// echo ($this->uri->segment(2) == 'all_client_details') ? 'active' : '' ?>"><a href="<?php //echo base_url('admin/all_client_details'); ?>"><i class="pe-7s-users"></i>-->
            <!--        <p>Client Details</p></a></li>-->

        


            <?php if ($this->session->userdata('user_id') == 5): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'list_inquiry') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/list_inquiry'); ?>"><i class="pe-7s-note2"></i>
                        <p>All Inquiries</p></a></li>
            <?php endif; ?>
            <!--             --><?php //if($this->session->userdata('user_id') == 5): ?>
            <!--            <li class="--><?php //echo ($this->uri->segment(2) == 'list_inquiry')? 'active':''?><!--"><a href="--><?php //echo base_url('admin/list_inquiry');?><!--"><i class="pe-7s-note2"></i><p>All inquiry</p></a></li>-->
            <!--            --><?php //endif; ?>
            <li class="<?php echo ($this->uri->segment(2) == 'all_inquiry') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/all_inquiry'); ?>"><i class="pe-7s-graph3"></i>
                    <p>Inquiries Settings</p></a></li>

            <li class="<?php echo ($this->uri->segment(2) == 'completed_inquiry') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/completed_inquiry'); ?>"><i class="pe-7s-edit"></i>
                    <p>Completed Inquiries</p></a></li>
            <!-- li><a href="<?php echo base_url('admin/events'); ?>"><i class="pe-7s-news-paper"></i><p>Event News</p></a></li -->
            <?php if (in_array('createPayment', $this->permissions)): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'client_payments') ? 'active' : '' ?>"><a href="<?php echo base_url('list/client_payments'); ?>"><i class="pe-7s-news-paper"></i>
                        <p>All Payments</p></a></li>
            <?php endif; ?>
            <?php if (in_array('viewSupport', $this->permissions)): ?>
                <li class="<?php echo ($this->uri->segment(1) == 'list-support') ? 'active' : '' ?>"><a href="<?php echo base_url('list-support'); ?>"><i class="pe-7s-graph1"></i>
                        <p>Client Support</p></a></li>
            <?php endif ?>

            <?php if (in_array('createClientinquiry', $this->permissions)): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'client_inquiry') ? 'active' : '' ?>"><a href="<?php echo base_url('add/client_inquiry'); ?>"><i class="pe-7s-note2"></i>
                        <p>Create Client inquiry</p></a></li>
            <?php endif; ?>

            <?php if (in_array('viewRole', $this->permissions)) { ?>
                <li class="<?php echo ($this->uri->segment(1) == 'role') ? 'active' : '' ?>"><a href="<?php echo base_url('role'); ?>"><i class="pe-7s-door-lock"></i>
                        <p>User Roles</p></a></li>
            <?php } ?>


            <?php if ($this->session->userdata("user_id") == 5): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'developer') ? 'active' : '' ?>" ><a href="<?php echo base_url('edit/developer/1'); ?>"><i class="pe-7s-science"></i>
                        <p>Developer Settings</p></a></li>
            <?php endif; ?>


        </ul>
    </div>
</div>

<style type="text/css">
    .dropdown-menu li a {
        color: #000 !important;
    }

    .bcktrans {
        background: rgba(255, 255, 255, 0.14);
    }

    .collapse li a {
        font-size: 16px;
    }
</style>