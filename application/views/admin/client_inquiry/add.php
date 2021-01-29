<script>
  $(document).ready(function (){
    $("#sel1").on("change",function() {   
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/get_dropdown_clients');?>",  
        data: {
          get_from: 'client_inquiry',
          get_where: 'client',
          id: $(this).val()
        },      
        dataType: "html",     
        success: function(data){
          $('#inquiry').html(data);
        },
        error: function(data) {
          console.log(data);
        }
      });   
    });
  });
</script>
<div class="content">
	<div class="container-fluid">
		<div>
			<h1 style="display:inline-block;">
				Client Inquiry
			</h1>
			<h3 class="box-title" style="display:inline-block;">Add</h3>
		</div>    
		<div class="col-md-6">
			<form role="form" action="<?php echo base_url('add_data/client_inquiry')?>" method="post" enctype="multipart/form-data">       
				<div class="box-body">
				    
				    <?php $clients = get_list('client');?>

					<div class="form-group">
                    <label for="sel1">Select Client:</label>
                    <select name="client_id" class="form-control" required id="sel1">
                      <option value="">Please Select</option>
                      <?php if(!empty($clients)): foreach($clients as $cli):?>
                        <option value="<?php echo $cli->client_id ?>"><?php echo $cli->client_name ?></option>
                      <?php endforeach; endif; ?>
        
                    </select>
                </div>
                
                    <input type="hidden" value="Free Consultation" name="delivery_status">
                    <input type="hidden" value="<?php echo date('m')?>" name="uploaded_month">

					<div class="form-group">
						<label>Inquiry Name</label>
						<input type="text" class="form-control" id="inquiry_name" required name="inquiry_name" >
					</div>
					
					<div class="form-group">
						<label>Appointment Date</label>
						<input type="text" class="form-control" id="appointment_date" required name="appointment_date" >
					</div>
					
					<div class="form-group">
						<label>Appointment start time</label>
						<input type="text" class="form-control" id="appointment_start_time" required name="appointment_start_time" >
					</div>
					
					<div class="form-group">
						<label>Appointment end time</label>
						<input type="text" class="form-control" id="appointment_end_time" required name="appointment_end_time" >
					</div>
					

					<div class="form-group">
						<label>Inquiry Type: </label>
						<select class="form-control" id="inquiry_type" name="inquiry_type" required>
							<?php $departments = get_list('department'); ?>
							<option value="">Please Select</option>
							<?php if(!empty($departments)): foreach($departments as $row):?>
								<option value="<?php echo $row->department_id?>"><?php echo $row->department_name ?></option>
							<?php endforeach; endif; ?>
						</select>         
					</div> 
                    
                    <div class="form-group">
                        <label>Total Cost: </label>
                        <input type="text" class="form-control" id="total_cost" required name="total_cost" >
                    </div>
                
                    <div class="form-group">
                        <label>Amount Paid: </label>
                        <input type="text" class="form-control" id="amount_paid" required name="amount_paid" >
                      
                    </div>
                    
                    <div class="form-group">
                        <label>Total Balance: </label>
                        <input type="text" class="form-control" id="total_balance" required name="total_balance" >
                    </div>
                    
					<div class="form-group">
						<label>Inquiry Summary</label>
						<textarea class="editor form-control" rows="3" id="inquiry_summary" name="inquiry_summary" required><?php echo !empty($record->inquiry_summary)?$record->inquiry_summary:''?></textarea>
					</div>

				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>    
			</form>  
		</div>
	</div>
</div> 