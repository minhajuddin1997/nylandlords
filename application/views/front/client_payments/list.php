
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Payments
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <hr style="border-top: 1px solid #504444;">

    <div class="col-md-12">  
      <div class="box-body"> 
        <table id="table_id" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Inquiry Name</th>
              <th>client Name</th>
              <th>Payment Number</th>
              <th>Amount</th>
              <th>Pay Status</th>
              <th>Payment Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($records)):
              $x = 1;
              foreach($records as $record):
                ?>
                <tr>
                  <td><?php echo $x++;?></td> 
                  <td><?php echo get_single_field('client_inquiry',array("client_inquiry_id"=>$record->inquiry_id),'inquiry_name');?></td>
                  <td><?php echo get_name_by_id("client",$record->client_id);?></td>
                  <td><?php echo $record->payment_no;?></td>
                  <td><?php echo $record->client_payments_amount;?></td>
                  <td><?php echo $record->client_payments_pay_status;?></td>
                  <td><?php echo $record->client_payments_date;?></td>
                  <td>
                    <a href="<?php echo site_url('client-view-update/client_payments/'.$record->client_payments_id.'');?>"><span class="view_icon"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                  </td>
                </tr> 
              <?php endforeach; endif;?>  
            </tbody>
          </table>
        </div>
        <div class="box-footer">
        </div>    
      </div>
    </div>
  </div>