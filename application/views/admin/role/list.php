<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Role
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('role/add');?>">Add New</a>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
       <table id="table_id" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Role Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($records)):
            $x = 1;
            foreach($records as $record):
              ?>
              <tr data-id='<?php echo $record->role_id;?>'>
                <td><?php echo $x++;?></td> 
                <td><?php echo $record->role_name;?></td>
                <td>
                  <a href="<?php echo site_url('role/edit/'.$record->role_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i  class="fa fa-edit" aria-hidden="true"></i></span></a>
                  <a href="<?php echo site_url('role/delete/'.$record->role_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>
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


