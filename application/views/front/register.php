<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo get_single_field('settings','','site_title');?></title>
  <link rel="icon" href="<?php echo base_url('uploads/settings/').$this->admin_m->get_single_field('settings','','fav_icon');?>" type="image/gif" sizes="16x16">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url('assets/admin/');?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <style>
 
    .vl {border-left: 3px solid green;height:100px;}
  .white{padding: 36px;border-radius: 10px;}
  
  .btn{border-radius: 50px;background: #12caa7;
    background: -moz-linear-gradient(left, #12caa7 0%, #22c0e6 100%);
    background: -webkit-linear-gradient(left, #12caa7 0%, #22c0e6 100%);
    /*background: linear-gradient(to right, #ee4592 0%, #22c0e6 100%);*/
    background: linear-gradient(to right, #029af0 0%, #22c0e6 100%);
      
      border: transparent;

padding: 9px;
      
  }
  .center{text-align: center;}
  .gap{padding-top:40px;}.form-control {

    border-radius: 50px !important;
    border: 1px solid #675e5e;
    height: auto;
    padding: 11px;
        padding-right: 11px;
    border: 1px solid #d3d1d1;

}

.form-control-feedback {

    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    height: 34px;
    line-height: 43px;
    text-align: center;
    pointer-events: none;
    color: #029af0;

}

</style>
</head>
<body class="hold-transition login-page" style="background-image: url('<?php echo base_url("uploads/developer/").$this->admin_m->get_single_field('developer','','developer_login_background');?>');background-repeat:no-repeat;background-size: cover;background-position: center;height: 100vh;">
   <?php if($this->session->flashdata('msg') == 1):?>
      <script>toastr.success('<?php echo $this->session->flashdata('alert_data')?>');</script>
      <?php elseif($this->session->flashdata('msg') == 2):?>
        <script>toastr.error('<?php echo $this->session->flashdata('alert_data')?>');</script>
    <?php endif;?>
  <div class="container gap">
    <div class="col-md-offset-4 col-sm-offset-4  col-sm-4 col-md-4 white" style="margin-top:-25px;">

      <div align="center" data-tilt>

        <img style="width: 300px;" src="<?php echo base_url("uploads/settings/").$this->admin_m->get_single_field('settings','','header_logo');?>" alt="IMG">
      </div>
      <h2 class="center"><b style="color:#333;     font-size: 21px;">Registration</b></h2>
      <p class="login-box-msg center"><b style="color: #333">Fill the form to get access to Dashboard</b></p>
      <form action="<?php echo base_url('registration') ;?>" method="post">
        <div class="form-group has-feedback">
          <input type="client_name" class="form-control" name="client_name" placeholder="Client Name" value="<?php echo $this->input->cookie('client_name');?>">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="client_email" placeholder="Email" value="<?php echo $this->input->cookie('client_email');?>">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <label style="color:#fff; font-size:10px;">Password length must be atleast 8</label>
          <input pattern=".{8,}" type="password" class="form-control" name="client_password" placeholder="Password" value="<?php echo $this->input->cookie('client_password');?>">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_address" placeholder="Home Address" value="<?php echo $this->input->cookie('client_address');?>">
          <span class="glyphicon glyphicon-home form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_phone_number" placeholder="Phone" value="<?php echo $this->input->cookie('client_phone_number');?>">
          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>
         <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_company" placeholder="Company" value="<?php echo $this->input->cookie('client_company');?>">
          <span class="glyphicon glyphicon-object-align-right form-control-feedback"></span>
        </div>
         <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_city" placeholder="City" value="<?php echo $this->input->cookie('client_city');?>">
          <span class="glyphicon glyphicon-globe form-control-feedback"></span>
        </div>
         <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_state" placeholder="State" value="<?php echo $this->input->cookie('client_state');?>">
          <span class="glyphicon glyphicon-globe form-control-feedback"></span>
        </div>
         <div class="form-group has-feedback">
          <input type="text" class="form-control" name="client_country" placeholder="Country" value="<?php echo $this->input->cookie('client_country');?>">
          <span class="glyphicon glyphicon-globe form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
<script src="<?php echo base_url('assets/admin/');?>assets/js/tilt.jquery.min.js"></script>
</html>