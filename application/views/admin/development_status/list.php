<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
       Development Status
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('add/development_status');?>">Add New</a>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
       <table id="table_id" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>S.No</th>
              <th>Designation</th>
              <th>Development Status Name</th>
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
                  <td><?php echo get_name_by_id('designation',$record->designation_id);?></td>
                  <td><?php echo $record->development_status_name;?></td>
                <td>
                 <a href="<?php echo site_url('edit/development_status/'.$record->development_status_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i class="fas fa-pencil-alt"></i></span></a>
                  <a href="<?php echo site_url('delete/development_status/'.$record->development_status_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
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
