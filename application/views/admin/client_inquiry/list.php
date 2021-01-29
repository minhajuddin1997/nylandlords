<style>
    .toggle.btn.btn-primary {
        max-height:20px;
    }
   .toggle.btn.btn-default.off {
               max-height:20px;

    }
</style>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content">
  <div class="container-fluid">
    <div>
      <h2 style="display:inline-block;">
        My Inquiries
      </h2>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
     <a class="btn btn-info" href="<?php echo site_url('add/client_inquiry');?>">Create New</a> 
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
              <th>Inquiry Type</th>
              <th>Appointment Date</th>
              <th>Appointment Start Time</th>
              <th>Appointment End Time</th>
              <th>Total Cost</th>
              <th>Amount Paid</th>
              <th>Total Balance</th>
              <th>Create Date</th>
              <th>Status</th>
              <th width="10%">Discussion</th>
              <th width="20%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($records)):
              $x = 1;
              foreach($records as $record):
                ?>

                <?php 
                $comments_read = get_list('comments',array('inquiry_id' =>$record->client_inquiry_id,"comments_read_admin"=>"unread"));
                (!empty($comments_read))? ($comments_read_count = count($comments_read)):($comments_read_count = 0);
                ?>

                <tr>
                  <td><?php echo $x++;?></td> 
                  <td><?php echo get_name_by_id('client',$record->client_id);?></td>
                  <td><?php echo $record->inquiry_name;?></td>
                  <td><?php echo get_name_by_id('department',$record->inquiry_type);?></td>
                  <td><b><?php echo $record->appointment_date;?></b></td>
                  <td><b><?php echo $record->appointment_start_time;?></b></td>
                  <td><b><?php echo $record->appointment_end_time;?></b></td>
                  <td><b style="color:#333;"><?php echo $record->total_cost;?></b></td>
                  <td><b style="color:green;"><?php echo $record->amount_paid;?></b></td>
                  <td><b style="color:red;"><?php echo $record->total_balance;?></b></td>
                  <td><?php echo date("d-m-Y",strtotime($record->client_inquiry_date));?></td>

                  <td><?php echo $record->delivery_status;?></td>

                  
                  <td>
                    <a href="<?php echo site_url('admin/inquiry_details/'.$record->client_inquiry_id.'');?>">
                      <span class="edit_icon" style="border-radius:15px;">Details</span>
                    </a>
                    <?php if($comments_read_count > 0): ?>
                      <a href="<?php echo site_url('admin/inquiry_details/'.$record->client_inquiry_id.'');?>"><span style="background:#4d8e4d;border-radius:15px" class="view_icon">
                        <b><?php echo (!empty($comments_read_count))? $comments_read_count:0; ?></b>&nbsp;Comment</a>
                        <?php else: ?>
                        <?php endif; ?>
                      </td>

                      <td>

                        <?php if($record->complete_status == "completed"): ?>
                          <!--<a href="<?php //echo site_url('admin/project_pending/'.$record->client_inquiry_id.'');?>"><span style="background:#d4784e;border-radius:5px;" class="view_icon">-->
                          <!--  <i class="fa fa-check"></i>Pending</span></a>-->
                            <?php else: ?>
                              <!--<a href="<?php //echo site_url('admin/project_completed/'.$record->client_inquiry_id.'');?>"><span style="background:#4d8e4d;border-radius:5px;" class="view_icon">-->
                              <!--  <i class="fa fa-check"></i>Completed</span></a>-->
                              <?php endif; ?>


                              <a href="<?php echo site_url('edit/client_inquiry/'.$record->client_inquiry_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit" aria-hidden="true"></i></span></a>
                              <a href="<?php echo site_url('delete/client_inquiry/'.$record->client_inquiry_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
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
<script type="text/javascript">
    $(document).on('change', '.payment_due', function () {
        let payment_due;
        let client_inquiry_id = $(this).data('id');
        if ($(this).is(':checked')) {
            payment_due = 'Yes';
        } else {
            payment_due = 'No';
        }
        if (payment_due) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('admin/client_payment_due?id=') ?>" + client_inquiry_id + "&status=" + payment_due,
                dataType: "JSON",
                success: function (data) {
                    toastr.success(data);
                }
            })
        } else {
            return false;
        }
    })
</script>

