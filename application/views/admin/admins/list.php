<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Admin
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('administrator/add');?>">Add New</a>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
       <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Admin Image</th>
            <th>Admin Name</th>
            <th>Admin Email</th>
            <th>Admin Password</th>
            <th>Phone</th>
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
                  <td><img style="max-width:100px; max-height:100px;" src="<?php echo ($record->user_image ? ''.base_url().'uploads/user/'.$record->user_image.'':'')?>" class="img-responsive"></td>

                  <td><?php echo $record->user_name;?></td>
                  <td><?php echo $record->user_email;?></td>
                  <td><?php echo $this->encryption->decrypt($record->user_pass);?></td>
                  <td><?php echo $record->user_phone;?></td>
                  <td>
                    <a href="<?php echo site_url('administrator/edit/'.$record->user_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i  class="fa fa-edit" aria-hidden="true"></i></span></a>
                    <a href="<?php echo site_url('administrator/view/'.$record->user_id.'');?>"><span style="border-radius:5px;" class="view_icon"><i  class="fa fa-eye" aria-hidden="true"></i></span></a>

                    <?php if($record->user_id == 5): ?>
                      <?php else: ?>
                        <a href="<?php echo site_url('administrator/delete/'.$record->user_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>
                      <?php endif; ?>

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
