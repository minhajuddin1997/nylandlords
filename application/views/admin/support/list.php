<div class="content">
  <div class="container-fluid">
    <div>
      <h2 style="display:inline-block;">
        Support
      </h2>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
        <div class="table-responsive">
         <table class="table table-bordered table-striped" id="table_id">
          <thead>
            <tr>
              <th width="10%">S.No</th>
              <th>Customer Name</th>
              <th width="30%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($records)): $x = 1; foreach($records as $record):?>
                <?php if($record->user_id==$this->session->userdata('user_id')):?>
              <tr>
                <td><?php echo $x++;?></td> 
                <td><?php echo $record->client_name ;?></td>
       
                    <td>
                      <a href="<?php echo site_url('admin-support/'.$record->sender_id.'');?>"><span style="border-radius:5px;" class="edit_icon">View client query</span></a>
                      <a href="<?php echo site_url('admin/delete_support_chat/support/'.$record->sender_id.'');?>"><span style="border-radius:5px;" class="delete_icon">Delete client query</span></a>
                    </td>
                  </tr> 
                <?php endif; endforeach; endif;?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer">
        </div>    
      </div>
    </div>
  </div>
