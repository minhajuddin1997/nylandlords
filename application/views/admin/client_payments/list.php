<script>
  $(document).ready(function (){
    $("#sel1").on("change",function() {   
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/get_dropdown_clients');?>",  
        data: {
          get_from: 'client_projects',
          get_where: 'client',
          id: $(this).val()
        },      
        dataType: "html",     
        success: function(data){
          $('#project').html(data);  
        },
        error: function(data) {
          console.log(data);
        }
      });   
    });
  });
</script>
<div class="modal fade" id="PayModelPayPal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php $clients = get_list('client');?>
      <div class="modal-body">
        <form action="<?php echo base_url('admin/manual_pay');?>" method="post">

          <div class="form-group">
            <label for="sel1">Select Client:</label>
            <select name="client_id" class="form-control" required id="sel1">
              <option value="">Please Select</option>
              <?php if(!empty($clients)): foreach($clients as $cli):?>
                <option value="<?php echo $cli->client_id ?>"><?php echo $cli->client_name ?></option>
              <?php endforeach; endif; ?>

            </select>
          </div>

          <div class="form-group">
            <label>Project Name: </label>
            <select required class="form-control" id="project" name="project_id" >
              <option value="null">Please Select</option>
            </select>         
          </div> 

          <div class="form-group">
            <label>Amount</label>
            <input type="number" id="manual_payment" name="manual_payment" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add payment</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Payments
      </h1>

      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" data-toggle="modal" data-target="#PayModelPayPal">Add manual payments</a>
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
                  <td><?php echo get_single_field('client_inquiry',array("client_inquiry_id"=>$record->project_id),'inquiry_name');?></td>
                  <td><?php echo get_name_by_id("client",$record->client_id);?></td>
                  <td><?php echo $record->payment_no;?></td>
                  <td><?php echo $record->client_payments_amount;?></td>
                  <td><?php echo $record->client_payments_pay_status;?></td>
                  <td><?php echo $record->client_payments_date;?></td>
                  <td>
                    <a href="<?php echo site_url('view-update/client_payments/'.$record->client_payments_id.'');?>"><span class="view_icon"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
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
