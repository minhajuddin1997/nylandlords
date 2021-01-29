<div class="content">
	<div class="container-fluid">
		<div>
			<h1 style="display:inline-block;">
				Admin
			</h1>
			<h3 class="box-title" style="display:inline-block;">Add</h3>
		</div>    
		<div class="col-md-6">
			<form role="form" action="<?php echo base_url('administrator/add_data')?>" method="post" enctype="multipart/form-data">       
				<div class="box-body">
                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Select Role</option>
                            <?php if (!empty($roles)): foreach ($roles as $role): ?>
                                <option value="<?php echo $role->role_id ?>"><?php echo $role->role_name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Designation</label>
                        <select name="designation_id[]" id="designation_id" class="form-control select2" multiple="multiple" style="width: 100%" required>
                            <option value="">Select Designation</option>
                            <?php if (!empty($designations)): foreach ($designations as $dev_status): ?>
                                <option value="<?php echo $dev_status->designation_id ?>"><?php echo $dev_status->designation_name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>


                    <div class="form-group">
						<label>Admin Name</label>
						<input type="text" class="form-control" id="user_name" required name="user_name" >
					</div>

					<div class="form-group">
						<label>Admin Email</label>
						<input type="email" class="form-control" id="user_email" required name="user_email" >
						<?php echo form_error('client_email', '<div style="color:red" class="error">', '</div>'); ?>
					</div>

					<div class="form-group">
						<label>Admin Password</label>
						<input type="text" class="form-control" id="user_pass" required name="user_pass" >
					</div>

					<div class="form-group">
						<label>Admin Phone</label>
						<input type="number" class="form-control" id="user_phone" required name="user_phone" >
					</div>
					

					<div class="form-group">
						<label>Admin Image</label>
						<?php echo form_error('user_image'); ?>
						<div class="input-group-btn">
							<div class="image-upload">                      
								<img src="<?php echo base_url('assets/img/placeholder.png')?>">
								<div class="file-btn">
									<input type="file" id="user_image" name="user_image" required>
									<label class="btn btn-info">Upload</label>
								</div>
							</div>
						</div>
					</div> 


				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>    
			</form>  
		</div>
	</div>
</div> 