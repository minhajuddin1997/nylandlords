<div class="content">
  <div class="container-fluid">
    <div>
      <h2 style="display:inline-block;">
        My Inquiries
      </h2>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('client-add/client_inquiry');?>">Create New</a>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
        <div class="table-responsive">
         <table class="table table-bordered table-striped" id="table_id">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Inquiry Owner</th>
              <th>Inquiry Name</th>
              <th>Appointment Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Total Cost</th>
              <th>Amount Paid</th>
              <th>Total Balance</th>
              <th>Create Date</th>
              <th width="10%">Status</th>
              <th width="10%">Discussion</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($records)):
              $x = 1;
              foreach($records as $record):
                ?>

                <?php 
                $comments_read = get_list('comments',array('inquiry_id' =>$record->client_inquiry_id,"comments_read_client"=>"unread"));

                (!empty($comments_read))? ($comments_read_count = count($comments_read)):($comments_read_count = 0);
                ?>
                <tr>
                  <td><?php echo $x++;?></td> 
                  <td><?php echo get_name_by_id('client',$record->client_id);?></td>
                  <td><?php echo $record->inquiry_name;?></td>
                  <td><b><?php echo $record->appointment_date;?></b></td>
                  <td><b><?php echo $record->appointment_start_time;?></b></td>
                  <td><b><?php echo $record->appointment_end_time;?></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <?php if(!empty($record->website_url)):?>
                  <?php else: ?>
                    <td>Pending</td>
                  <?php endif; ?>
                  
                  <td><?php echo $record->client_inquiry_date;?></td>
                  <td><?php echo $record->delivery_status; ?></td>
                  <!--<td>-->
                    <!-- <a href=" echo// base_url('checkout/').$record->client_inquiry_id;?>"><span style="background:#4d8e4d;border-radius:15px" class="view_icon">Pay Now</span></a> -->
                  <!--   //if(($record->inquiry_price > 0) && ($record->inquiry_balance <= 0)): -->
                  <!--  <p><b>Paid</b></p>-->
                  <!--  <?php //elseif($record->inquiry_price == 0):?>-->
                  <!--      <p><b>Pending</b></p>-->
                  <!--     //else: ?>-->
                  <!--      <a href=" echo// base_url('checkout/pay/').$record->client_inquiry_id;?>"><span style="background:#4d8e4d;border-radius:15px" class="view_icon">Pay Now</span></a>-->
                  <!--    // endif; ?>-->

                  <!--  </td>-->
                    <td>
                      <a href="<?php echo site_url('home/inquiry_details/'.$record->client_inquiry_id.'');?>">
                        <span class="edit_icon" style="border-radius:15px;">Details</span>
                      </a>
                      <?php if($comments_read_count > 0): ?>
                        <a href="<?php echo site_url('home/inquiry_details/'.$record->client_inquiry_id.'');?>"><span style="background:#4d8e4d;border-radius:15px" class="view_icon">
                          <b><?php echo (!empty($comments_read_count))? $comments_read_count:0; ?></b>&nbsp;Comment</a>
                          <?php else: ?>
                          <?php endif; ?>
                        </td>
                      </tr> 
                    <?php endforeach; endif;?>  
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer">
            </div>    
          </div>
        </div>
      </div>
