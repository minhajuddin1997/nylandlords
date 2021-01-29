<?php if(!empty($records)): foreach($records as $record): ?>

  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Inquiry
        </h1>
        <h3 class="box-title" style="display:inline-block;">Edit</h3>
      </div>     
      <div class="col-md-6">
        <form role="form" action="<?php echo site_url('update_data/client_inquiry/'.$record->client_inquiry_id.'');?>" method="post" enctype="multipart/form-data">       
          <div class="box-body"> 

            <div class="form-group">
              <label>Inquiry name</label>
              <input type="text" class="form-control" id="inquiry_name" name="inquiry_name" value="<?php echo $record->inquiry_name?>" required>
            </div>

            <div class="form-group">
              <label>Appointment Date</label>
              <input type="text" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $record->appointment_date?>" required>
            </div>

            <div class="form-group">
              <label>Appointment Start Time</label>
              <input type="text" class="form-control" id="appointment_start_time" name="appointment_start_time" value="<?php echo $record->appointment_start_time?>" required>
            </div>

            <div class="form-group">
              <label>Appointment End Time</label>
              <input type="text" class="form-control" id="appointment_end_time" name="appointment_end_time" value="<?php echo $record->appointment_end_time?>" required>
            </div>
            
            <div class="form-group">
              <label>Website Demo Link</label>
              <input type="text" class="form-control" id="website_url" name="website_url" value="<?php echo $record->website_url?>" >
            </div>

            <div class="form-group">
              <label>Inquiry Type</label>
              <input type="text" class="form-control" disabled value="<?php echo get_name_by_id('department',$record->inquiry_type);?>" required>
            </div>
            
            <div class="form-group">
                <label>Total Cost: </label>
                <input type="text" class="form-control" id="total_cost" required name="total_cost" value="<?php echo $record->total_cost; ?>">
            </div>
        
            <div class="form-group">
                <label>Amount Paid: </label>
                <input type="text" class="form-control" id="amount_paid" required name="amount_paid" value="<?php echo $record->amount_paid; ?>">
              
            </div>
            
            <div class="form-group">
                <label>Total Balance: </label>
                <input type="text" class="form-control" id="total_balance" required name="total_balance" value="<?php echo $record->total_balance; ?>">
            </div>
            
            <div class="form-group">
              <label>Current Status</label>
              <select class="form-control" id="delivery_status" name="delivery_status" required>
                <option value="<?php echo $record->delivery_status;?>"><?php echo $record->delivery_status;?></option>
                <option value="Free Consultation">Free Consultation</option>
                <option value="Appointment Booked">Appointment Booked</option>
                <option value="Retained">Retained</option>
                <option value="Referred Back">Referred Back</option>
                <option value="No Show / Unable to Contact">No Show / Unable to Contact</option>
                <option value="Services Completed">Services Completed</option>
              </select>         
            </div>

            <div class="form-group">
              <label>Inquiry Summary</label>
              <p><?php echo $record->inquiry_summary?></p>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>    
        </form>  
      </div>
    </div>
  </div> 
<?php endforeach; endif;?> 
