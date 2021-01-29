<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Client
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('add/client');?>">Add New</a>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
       <table id="table_id" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Client Image</th>
            <th>Client Name</th>
            <th>Client Email</th>
            <th>Phone</th>
            <th>State</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($records)):
            $x = 1;
            foreach($records as $record):
              ?>
              <tr data-id='<?php echo $record->client_id;?>'>
                <td><?php echo $x++;?></td> 
                <td><img style="max-width:150px; max-height:150px;" src="<?php echo ($record->client_image ? ''.base_url().'uploads/client/'.$record->client_image.'':'')?>" class="img-responsive"></td>
                <td><?php echo $record->client_name;?></td>
                <td><?php echo $record->client_email;?></td>
                <td><?php echo $record->client_phone_number;?></td>
                <td><?php echo $record->client_state;?></td>
                  <td>  <input type="checkbox" <?php echo  $record->client_login_detail == 'enable'?"checked":'';?>  data-toggle="toggle" class="client_status" data-on="Enable" data-off="Disable" value="<?php echo $record->client_login_detail;?>"></td>
                <td>
                  <a href="<?php echo site_url('edit/client/'.$record->client_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i  class="fa fa-edit" aria-hidden="true"></i></span></a>
                  <a href="<?php echo site_url('view/client/'.$record->client_id.'');?>"><span style="border-radius:5px;" class="view_icon"><i  class="fa fa-eye" aria-hidden="true"></i></span></a>
                  <a href="<?php echo site_url('delete/client/'.$record->client_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>

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
<script>
    $(document).ready(function(){
        $('body').on("change",".client_status",function(){
        let client_id= $(this).closest('tr').data("id");
         
           if($(this).is(':checked')){
               
               var client_type="enable";
           }
           else{
               var client_type="disable";
           }
           if(client_type=="enable" ||client_type=="disable"){
                $.ajax({
                url:"<?php echo base_url('admin/client_login_status');?>",
                method:"POST",
                data:{client_type:client_type,client_id:client_id},
                success:function(res){
                    if(res=='success'){
                        toastr.success('Client Status Changed')
                    }
                    else{
                        toastr.error('Some Thing Wrong')
                    }
                }
            })
            
           }
           
            
        })
    })
</script>

