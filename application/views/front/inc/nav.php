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
<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:">Client Dashboard</a>
                <?php if(!empty($this->uri->segment(3)) && $this->uri->segment(2) == "client_payments"):?>
                <button style="margin: 9px 3px;font-size: 14px;" class="btn btn-primary" onclick="printContent('print_view');" >Print or save pdf</button>
                <?php else: ?>
                
                <?php endif; ?>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="btn btn-info" target="_blank" href="https://nylandlords.workplace.com">
                            <p>Private Community</p>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-info" href="<?php echo base_url('home/logout');?>">
                            <p>Log out</p>
                        </a>
                    </li>
                    <li class="separator hidden-lg"></li>
                </ul>
            </div>
        </div>
    </nav>