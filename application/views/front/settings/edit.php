<?php if(!empty($records)): foreach($records as $record): ?>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Settings
      </h1>
      <h3 class="box-title" style="display:inline-block;">Edit Data</h3>
    </div>
    <div class="col-md-6">
      <form role="form" action="<?php echo site_url('update_data/settings/'.$record->settings_id.'');?>" method="post" enctype="multipart/form-data">           
        <div class="box-body"> 

          <div class="form-group">
            <label>Site Title</label>
            <input type="text" class="form-control" id="site_title" name="site_title" value="<?php echo !empty($record->site_title)?$record->site_title:''?>" required>
            <?php echo form_error('site_title'); ?>
          </div>

          <div class="form-group">
            <label>Brick Price</label>
            <input type="number" class="form-control" id="brick_price" name="brick_price" value="<?php echo !empty($record->brick_price)?$record->brick_price:''?>" required>
            <?php echo form_error('brick_price'); ?>
          </div>

          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" id="email_add" name="email_add" value="<?php echo !empty($record->email_add)?$record->email_add:''?>" required>
            <?php echo form_error('email_add'); ?>
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo !empty($record->phone_no)?$record->phone_no:''?>" required>
            <?php echo form_error('phone_no'); ?>
          </div>

          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo !empty($record->address)?$record->address:''?>" required>
            <?php echo form_error('address'); ?>
          </div>

          <div class="form-group">
            <label>Footer Copyright Text</label>
            <input type="text" class="form-control" id="footer_tagline" name="footer_tagline" value="<?php echo !empty($record->footer_tagline)?$record->footer_tagline:''?>" required>
            <?php echo form_error('footer_tagline'); ?>
          </div>

          
          <div class="form-group">
            <label>Header Logo</label>
            <div class="input-group-btn">
              <div class="image-upload">                      
                <img class="imgpath" src="<?php echo !empty($record->header_logo)?base_url('uploads/settings/').$record->header_logo:base_url('assets/img/placeholder.png')?>">
                <div class="file-btn">
                  <input type="text" class="imageselect btn" value="<?php echo $record->header_logo;?>" id="header_logo" data-toggle="modal" data-target="#exampleModal" name="header_logo" value="<?php echo $record->header_logo;?>" readonly>
                  <label for="header_logo" class="btn btn-info">Upload</label>
                </div>
              </div>
            </div>
            <?php echo form_error("header_logo"); ?>
          </div>

          <div class="form-group">
            <label>Footer Logo</label>
            <div class="input-group-btn">
              <div class="image-upload">                      
                <img class="imgpath" src="<?php echo !empty($record->footer_logo)?base_url('uploads/settings/').$record->footer_logo:base_url('assets/img/placeholder.png')?>">
                <div class="file-btn">
                  <input type="text" class="imageselect btn" value="<?php echo $record->footer_logo;?>" id="footer_logo" data-toggle="modal" data-target="#exampleModal" name="footer_logo" value="<?php echo $record->footer_logo;?>" readonly>
                  <label for="footer_logo" class="btn btn-info">Upload</label>
                </div>
              </div>
            </div>
            <?php echo form_error("footer_logo"); ?>
          </div>

          <div class="form-group">
            <label>Fav Icon</label>
            <div class="input-group-btn">
              <div class="image-upload">                      
                <img class="imgpath" src="<?php echo !empty($record->fav_icon)?base_url('uploads/settings/').$record->fav_icon:base_url('assets/img/placeholder.png')?>">
                <div class="file-btn">
                  <input type="text" class="imageselect btn" value="<?php echo $record->fav_icon;?>" id="fav_icon" data-toggle="modal" data-target="#exampleModal" name="fav_icon" value="" readonly>
                  <label for="fav_icon" class="btn btn-info">Upload</label>
                </div>
              </div>
            </div>
            <?php echo form_error("fav_icon"); ?>
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