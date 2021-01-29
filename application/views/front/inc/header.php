<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url('uploads/settings/').$fav_icon;?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo ucwords(str_replace(str_split('-_'),'&nbsp;', $this->uri->segment(2)? $this->uri->segment(2):$this->uri->segment(1)));; ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="<?php echo base_url('assets/admin/');?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/admin/');?>assets/css/animate.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin/');?>assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin/');?>assets/css/demo.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url('assets/admin/');?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css">
    <script src="<?php echo base_url('assets/admin/');?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/');?>assets/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/admin/');?>assets/js/jquery.dataTables.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .flex-container {
          display: flex;
          background-color: #fff;
        }
        
        .flex-container > div {
          background-color: #fff;
          margin: 10px;
          padding: 20px;
          font-size: 30px;
          text-align:center;
          border-radius: 5px;
          box-shadow: 2px 4px 8px 2px rgba(0, 100, 181, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }
        .flex-container h4 {
          font-weight:999;
        }
        @media (max-width: 800px) {
          .flex-container {
            flex-direction: column;
          }
        }
        
        .demo-wrap {
          display: flex;
          align-items: center;
          flex-flow: column;
          justify-content: center;
          padding-top: 2em;
          width: 100%;
        }
        
        .demo-header {
          padding-right: 1em;
          padding-left: 1em;
          text-align: center;
          h1,
          p {
            margin-bottom: 0;
          }
          p {
            font-size: 1.5rem;
          }
        }
        
        @media (min-width: 62em) {
          .demo-wrap {
            padding-top: 0;
            height: 100vh;
          }
        }
        
        
        /* --- Pricing Plans --- */
        
        .pricing-plans {
          width: 100%;
        }
        
        .pricing-tables {
          display: flex;
          flex-flow: column;
        }
        
        .pricing-plan {
          background-color: #f6f6f6;
          border: 2px solid #DDD;
          border-bottom: 2px solid #DDD;
          display: block;
          padding: 1em 0;
          text-align: center;
          width: 100%;
        }
        
        .pricing-plan:first-child, .pricing-plan:last-child {
          background-color: #EEE;
        }
        
        .pricing-plan:first-child {
          border-bottom: 0;
        }
        
        .pricing-plan:last-child {
          border-top: 0;
        }
        
        .pricing-plan:nth-child(2) {
          border-bottom: 0;
        }
        
        .no-flexbox .pricing-plan {
          float: left;
        }
        
        .plan-title {
          font-size: 1em;
          letter-spacing: -0.05em;
          margin: 0;
          padding: 0.75em 1em 1.25em;
          text-transform: uppercase;
        }
        
        .plan-cost {
          background-color: white;
          color: #77b9dd;
          font-size: 1.25em;
          font-weight: 700;
          padding: 1.25em 1em;
          text-transform: uppercase;
        }
        
        .plan-cost span {
          display: none;
        }
        
        .plan-price {
          font-size: 3em;
          letter-spacing: -0.05em;
          line-height: 1;
          margin-bottom: 0;
        }
        
        .plan-type {
          border: 0.313em solid #DDD;
          color: #999;
          display: inline-block;
          font-size: 0.75em;
          margin: 0.75em 0 0 0.75em;
          padding: 0.3em 0.4em 0.25em;
          width: auto;
        }
        
        .plan-features {
          margin: 0;
          padding: 2em 1em 1em;
        }
        
        .plan-features li {
          list-style-type: none;
          border-bottom: 1px solid #DDD;
          margin-bottom: 0.5em;
          padding-bottom: 0.75em;
          color: #555;
          display: block;
          font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
          font-size: .8em;
          font-weight: normal;
          line-height: 1.3;
        //   &:before {
        //     content: "✔";
        //     margin-right: 7px;
            
        //   }
          span {
            color: #BBB;
          }
        }
        
        .plan-features li:last-child {
          border-bottom: none;
          margin-bottom: 0;
          padding-bottom: 0;
        }
        
        .plan-features h3 {
          
        }
        
        .plan-features i {
          font-size: 1.5em;
        }
        
        .plan-features i.icon-ok-squared {
          color: #3aa14d;
        }
        
        .plan-features i.icon-cancel-circled {
          color: darkRed;
        }
        
        .btn-plan {
          background-color: #1B8DC8;
          color: white;
          max-width: 12em;
        }
        
        .cta {
          background-color: #6cb507;
        }
        
        .featured-plan {
          background-color: #eef7fc;
          border-top: 5px solid #8cd0f5;
          border-right: 0 solid transparent;
          border-bottom: 5px solid #8cd0f5;
          border-left: 0 solid transparent;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
          overflow: hidden;
          //order: -1;
          position: relative;
          transition: transform 400ms ease;
        }
        
        .featured-plan {
          .plan-title {
            color: #1B8DC8;
          }
        }
        
        .featured-ribbon {
          width: 200px;
          background: #1B8DC8;
          position: absolute;
          top: 15px;
          left: -60px;
          text-align: center;
          line-height: 35px;
          letter-spacing: 0.01em;
          font-size: 0.65em;
          font-weight: 700;
          color: white;
          text-transform: uppercase;
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
          /* Custom styles */
          /* Different positions */
        }
        
        .featured-ribbon.sticky {
          position: fixed;
        }
        
        .featured-ribbon.shadow {
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
        }
        
        .featured-ribbon.top-left {
          top: 25px;
          left: -50px;
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
        }
        
        .featured-ribbon.top-right {
          top: 25px;
          right: -50px;
          left: auto;
          transform: rotate(45deg);
          -webkit-transform: rotate(45deg);
        }
        
        .featured-ribbon.bottom-left {
          top: auto;
          bottom: 25px;
          left: -50px;
          transform: rotate(45deg);
          -webkit-transform: rotate(45deg);
        }
        
        .featured-ribbon.bottom-right {
          top: auto;
          right: -50px;
          bottom: 25px;
          left: auto;
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
        }
        
        @media (min-width: 400px) {
          .pricing-plans {    
            padding-right: 2em;
            padding-left: 2em;
            width: 100%;
          }
        
          .featured-plan {
            transform: scale(1.05);
          }
        }
        
        @media (min-width: 33.75em) {
          .pricing-plans .module-title {
            margin-bottom: 1em;
          }
        
          .pricing-tables {
            flex-flow: row wrap;
          }
        
          .pricing-plan {
            flex-grow: 1;
            width: 50%;
          }
        
          .pricing-plan:first-child {
            border-right: 0;
            border-bottom: 0;
          }
          
          .featured-plan {
            margin-top: 0.6em;
            order: 0;
          }
          
          .pricing-plan:nth-child(3) {
        
          }
        
          .pricing-plan:last-child {
            border-top: 2px solid #DDD;
            border-left: 0;
          }
          
          .no-flexbox .pricing-plan {
            width: 48%;
          }
        
          .plan-title {
            font-size: 0.875em;
          }
        }
        
        @media (min-width: 48em) {
          .no-flexbox .pricing-plan {
            width: 24%;
          }
        
          .plan-type {
            font-size: 0.7em;
            margin: 0.5em 0 0 1em;
            padding-bottom: 0.2em;
          }
        
          .featured-ribbon {
            font-size: 0.65em;
          }
        }
        
        @media (min-width: 62em) {
          .pricing-tables {
            padding-top: 3em;
          }
        
          .pricing-plan {
            flex-grow: 1;
            width: 25%;
          }
          
          .featured-plan {
            margin-top: 0;
            order: 0;
          }
        
          .pricing-plan:first-child, .pricing-plan:nth-child(2n) {
            border-bottom: 2px solid #DDD;
          }
        
          .pricing-plan .plan-features span {
            display: block !important;
          }
        
          .plan-cost {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            justify-content: center;
            font-size: 1em;
          }
        
          .plan-cost span {
            color: #BBB;
            font-size: 1.5em;
            font-weight: 400;
            padding-right: 0.15em;
            padding-left: 0.15em;
          }
        
          .plan-price {
            font-size: 3.25em;
          }
        
          .btn-plan {
            font-size: 0.875em;
          }
        
          .featured-ribbon {
            font-size: 0.45em;
            left: -68px;
            line-height: 25px;
          }
        }
        
        @media (min-width: 75em) {
          .plan-cost {
            font-size: 1em;
          }
        }
        
        @media (min-width: 100em) {
          .pricing-tables {
            margin: 0 auto;
            max-width: 75.00em;
          }
        }
</style>
</head>

<body id="print_view" style="background-image: url('<?php echo base_url('uploads/developer/').$this->admin_m->get_single_field('developer','','front_content_image');?>');background-size:cover;">
    <?php if($this->session->flashdata('msg') == 1):?>
      <script>toastr.success('<?php echo $this->session->flashdata('alert_data')?>');</script>
      <?php elseif($this->session->flashdata('msg') == 2):?>
        <script>toastr.error('<?php echo $this->session->flashdata('alert_data')?>');</script>
    <?php endif;?>
    <?php $map="";if(!empty($this->uri->segment(2))){
        $dir = "uploads"."/".str_replace("-","_",$this->uri->segment(2)); 
        $map = scan_images_by_date($dir); } ?>
        <style>
        .setting{padding: 5px;}.imgsetting{border: 4px solid #dedede;width: 200px;height:100px;}
        .asd{background-color:#e4e4e4;padding: 3px;}.myCustomButton{color: #fff;background-color: #dc3545;border-color: #dc3545;}
        .myCustomButton:hover{color: #fff;background-color: #dc3545;border-color: #dc3545;}
    </style>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div style="background:url('<?php echo base_url('assets/img/modelhead.jpg');?>');" class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add a new media or select current</h5>
            <hr>
            <div class="form-group">
                <label>Import To Media Library</label>
                <div class="input-group-btn">
                 <div class="image-upload">                      
                  <img  src="<?php echo base_url('assets/img/placeholder.png')?>">
                  <div class="file-btn">
                    <form id="imageupload" action="<?php echo base_url("admin/photo_upload");?>">
                        <input type="file" id="selectedimage" name="selectedimage" required>
                        <label class="btn btn-info changeabletext">Upload</label>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    <div class="row uploaded_images_main">
        <?php if(!empty($map)): foreach($map as $k):?>
            <div class="col-sm-2 setting">
                <div class="asd">
                    <button class="selectimage cbselect" data-path="<?php echo base_url().'uploads'.'/'.str_replace('-','_',$this->uri->segment(2)).'/'.$k ;?>" data-image="<?php echo $k ;?>" type="button">Select</button>
                    <button class="deletephoto cbs" data-id="<?php echo 'uploads'.'/'.str_replace('-','_',$this->uri->segment(2)).'/'.$k ;?>" type="button"><b><i class="fa fa-trash" aria-hidden="true"></i></b></button>
                    <img for="asd" src="<?php echo base_url($dir).'/'.$k;?>" class="img-responsive imgsetting" />
                </div>
            </div>
        <?php  endforeach; else: ?>
        <h3>Image Folder Not Exists</h3>
    <?php endif;?>
</div>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
    <div class="wrapper">