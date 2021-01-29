<?php if(!empty($records)): foreach($records as $record): ?>

  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Admin
        </h1>
        <h3 class="box-title" style="display:inline-block;">Edit</h3>
      </div>     
      <div class="col-md-6">
        <form role="form" action="<?php echo site_url('administrator/update/'.$record->user_id.'');?>" method="post" enctype="multipart/form-data">       
          <div class="box-body">

              <div class="form-group">
                  <label>Select Role</label>
                  <select name="role_id" id="role_id" class="form-control" required>
                      <option value="" >Select Role</option>
                      <?php if (!empty($roles)): foreach ($roles as $role): ?>
                          <option value="<?php echo $role->role_id ?>" <?php echo ($role->role_id == $record->role_id) ? 'selected' : '' ?>><?php echo $role->role_name ?></option>
                      <?php endforeach; endif; ?>
                  </select>
              </div>

              <div class="form-group">
                  <label>Select Designation</label>
                  <select name="designation_id[]" id="designation_id" class="form-control select2" multiple="multiple" style="width: 100%" required>
                      <option value="">Select Designation</option>
                      <?php if (!empty($designations)): foreach ($designations as $dev_status): ?>
                          <option value="<?php echo $dev_status->designation_id ?>" <?php if (is_array(json_decode($record->designation_id))) {
                              $designation_id = json_decode($record->designation_id);
                              foreach ($designation_id as $designation_ids) {
                                  echo (($designation_ids == $dev_status->designation_id) ? 'selected': '');
                              }
                          } ?>><?php echo $dev_status->designation_name ?></option>
                      <?php endforeach; endif; ?>
                  </select>
              </div>

            <div class="form-group">
              <label>Admin name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $record->user_name?>" required>
            </div>

            <div class="form-group">
              <label>Admin email</label>
              <input type="text" disabled="" class="form-control" id="user_email" name="user_email" value="<?php echo $record->user_email?>" required>
            </div>

            <div class="form-group">
              <label>Admin password</label>
              <input type="text" class="form-control" id="user_pass" name="user_pass" value="<?php echo $this->encryption->decrypt($record->user_pass); ?>" required>
            </div>

            <div class="form-group">
              <label>Admin phone</label>
              <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo $record->user_phone?>" required>
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
