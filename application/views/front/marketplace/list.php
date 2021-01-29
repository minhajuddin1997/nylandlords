<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Market Place
      </h1>
    </div>
    <hr style="border-top: 1px solid #504444;">

    <div class="col-md-12">  

    <div class="row">
        <!--<div class="col-md-4">-->
        <!--    <div class="card p-3" style="padding:1rem;">-->
        <!--        <div class="d-flex flex-row mb-3">-->
        <!--            <div class="row">-->
        <!--                 <div class="col-1 col-md-2 col-xs-4">-->
        <!--                     <img src="https://i.imgur.com/ccMhxvC.png" width="70">-->
        <!--                 </div>-->
        <!--                 <div class="col-1 col-lg-4 col-xs-5">-->
        <!--                    <div class="d-flex flex-column ml-2"><span>Stripe</span><span class="text-black-50">Payment Services</span><span class="ratings">-->
        <!--                         <br>-->
        <!--                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span></div>-->
        <!--                 </div>-->
        <!--            </div>-->
        <!--           </div>-->
        <!--        <h6>Get more context on your users with stripe data inside our platform.</h6>-->
        <!--        <div class="d-flex justify-content-between install mt-3"><span>Installed 172 times</span><span class="text-primary">View&nbsp;<i class="fa fa-angle-right"></i></span></div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="flex-container">
        <?php $i=0; foreach($records as $row): $i++; if($i <= 3): ?>
          <div style="width:100%;"> 
            <center>
                <img src="<?php echo base_url('uploads/support_images/'); ?><?php echo $row->icon_url; ?>" width="110"></center>
                        <h4 style="line-height:18px;font-size:18px;"><?php echo $row->name; ?></h4>
            <br>
            <?php if($row->id == 2): ?>
            <a href='<?php echo base_url('MarketPlace/backgroundCheck'); ?>' class="btn btn-info">Start</a>
            <?php else: ?>
            <a href='<?php echo base_url('MarketPlace/add_data/'); ?><?php echo $row->id; ?>' class="btn btn-info">Start</a>
            <?php endif; ?>

          </div>
        <?php endif; endforeach; ?>
        </div>
        
        <div class="flex-container">
        <?php for($i=3; $i<6; $i++){ ?>
          <div style="width:100%;"> 
                 <center><img src="<?php echo base_url('uploads/support_images/'); ?><?php echo $records[$i]->icon_url; ?>" width="110"></center>
                        <h4 style="line-height:18px;font-size:18px;"><?php echo $records[$i]->name; ?></h4>
                                    <br>

            <a href='<?php echo base_url('MarketPlace/add_data/'); ?><?php echo $records[$i]->id; ?>' class="btn btn-info">Start</a>
          </div>
        <?php } ?>
        </div>
        
    </div>
        <!--<div class="box-footer">-->
        <!--  <a href="<?php echo base_url('admin')?>" class="btn btn-danger">Dashboard</a>-->
        <!--</div>    -->
      </div>
    </div>
  </div>
