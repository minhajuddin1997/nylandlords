<style>
li.custommail a {
    padding: 0 !important;
    margin: 0 !important;
    background: none !important;
    border-radius: 0px !important;
    font-size: 38px;
    position: absolute !important;
    right: 24px;
    top: 10px;
    color: #fff;
}
.supsup
{
    position: absolute;
    top: -4px;
    right: -10px;
    background: red;
    padding: 11px;
    border-radius: 20px;
    font-size: 15px;
    font-weight: 800;
}
.font-small
{
    font-size:14px;
}
.crosster
{
    background:#ede8f1;
    padding:10px;
    margin:0px 5px 5px 0px;
    border:1px solid #24bfec;
}

nav.navbar.navbar-default.navbar-fixed {
    background: linear-gradient(to bottom, <?php echo $this->admin_m->get_single_field('developer','','front_nav_color');?> 0%, <?php echo $this->admin_m->get_single_field('developer','','front_nav_gradient');?> 133%) !important;
}
        
</style>
<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $commentNotification = $this->admin_m->get_list('comments',array('comments_read_admin' => 'unread')); ?>
        <div class="row">
            
            <?php if(!empty($commentNotification)): foreach($commentNotification as $com): ?>
                <div class="col-sm-12 crosster">
                    <h6>Comment by <span style="color:#1DC7EA"><?php echo get_name_by_id('client',$com->sender_id); ?></span> at <?php echo $com->comments_date; ?></h6>
                    <p class="font-small"><?php echo $com->comments_text; ?></p>
                    <a href="<?php echo base_url('admin/inquiry_details/'.$com->inquiry_id.'');?>">View Details</a>
                </div>
            <?php endforeach; else: ?>
                <div class="col-sm-12">
                    <h6>Every thing is up to date</h6>
                </div>
            <?php endif; ?>
        
        </div>
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:">Dashboard</a>
                <?php if(!empty($this->uri->segment(3)) && $this->uri->segment(2) == "client_payments"):?>
                <button style="margin: 9px 3px;font-size: 14px;" class="btn btn-primary" onclick="printContent('print_view');" >Print or save pdf</button>
                <?php else: ?>
                <?php endif; ?>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="custommail">
                        <a href="javascript:;" data-toggle="modal" data-target="#exampleModals"><i class="pe-7s-mail">
                            <?php $countOfUnread = count($this->admin_m->get_list('comments',array('comments_read_admin' => 'unread'))); ?>
                        </i>
                        <?php if($countOfUnread == 0 ):?>
                        
                        <?php else: ?>
                            <sup class="supsup"><?php echo $countOfUnread; ?></sup>
                        <?php endif; ?>
                        
                        
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/logout');?>">
                            <p>Log out</p>
                        </a>
                    </li>
                    <li class="separator hidden-lg"></li>
                </ul>
            </div>
        </div>
    </nav>