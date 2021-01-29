<?php if(!empty($records)): foreach($records as $record): ?>

  <div class="content">
    <div class="container-fluid">
      <div>
        <h2 style="display:inline-block;">
          Project
        </h2>
        <h4 class="box-title" style="display:inline-block;">Edit</h4>
      </div>     
      <div class="col-md-6">
        <form role="form" action="<?php echo site_url('client-update-data/client_inquiry/'.$record->client_inquiry_id.'');?>" method="post" enctype="multipart/form-data">       
          <div class="box-body"> 

            <div class="form-group">
              <label>Inquiry name</label>
              <input type="text" class="form-control" id="inquiry_name" name="inquiry_name" value="<?php echo $record->inquiry_name?>" required>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?php echo base_url('')?>" class="btn btn-danger">Dashboard</a>
          </div>    
        </form>  
      </div>
    </div>
  </div> 
<?php endforeach; endif;?> 
