<?php if(!empty($records)): foreach($records as $record): ?>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Admin
      </h1>
      <h3 class="box-title" style="display:inline-block;">Details</h3>
    </div>   
    <div class="col-md-12">
      <div class="box-body">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 300px;">Attributes</th>
              <th>Values</th>
            </tr>
          </thead>
          <tbody>

            <tr>
            <td>Admin Image</td>
            <td><img style="max-width:300px" src="<?php echo !empty($record->user_image)?base_url('uploads/user/').$record->user_image:base_url('assets/img/placeholder.png')?>"></td>
          </tr>

          <tr>
            <td>Admin Name</td>
            <td><?php echo $record->user_name;?></td>
          </tr>

          <tr>
            <td>Admin Email</td>
            <td><?php echo $record->user_email;?></td>
          </tr>

          <tr>
            <td>Admin Password</td>
            <td><?php echo $this->encryption->decrypt($record->user_pass);?></td>
          </tr>

          <tr>
            <td>Admin Phone</td>
            <td><?php echo $record->user_phone;?></td>
          </tr>
  
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<?php endforeach; endif;?> 
