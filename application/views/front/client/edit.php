<?php if(!empty($records)): foreach($records as $record): ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Update Password</h4>
        </div>
        <div class="content">
            <form role="form" action="<?php echo base_url('home/front_update_password');?>" method="post" enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" name="cnf_password" class="form-control" placeholder="Confirm New Password" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-fill">Update Password</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Edit Profile</h4>
                        </div>
                        <div class="content">
                            <form role="form" action="<?php echo base_url('client-update-data/client/').$this->session->userdata('client_id');?>" method="post" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="client_company" class="form-control" placeholder="Company" value="<?php echo !empty($record->client_company)?$record->client_company:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>client name</label>
                                            <input type="text" name="client_name" class="form-control" placeholder="client Name" value="<?php echo !empty($record->client_name)?$record->client_name:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="client_email" class="form-control" placeholder="Email" value="<?php echo !empty($record->client_email)?$record->client_email:''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Client Website</label>
                                            <input type="text" name="client_website" class="form-control" placeholder="Website" value="<?php echo !empty($record->client_website)?$record->client_website:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>client Phone</label>
                                            <input type="number" name="client_phone_number" class="form-control" placeholder="client Name" value="<?php echo !empty($record->client_phone_number)?$record->client_phone_number:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Client Create Date</label>
                                            <input type="text" disabled class="form-control" placeholder="Email" value="<?php echo !empty($record->client_date)?$record->client_date:''?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Client City</label>
                                            <input type="text" name="client_city" class="form-control" placeholder="Website" value="<?php echo !empty($record->client_city)?$record->client_city:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>client State</label>
                                            <input type="text" name="client_state" class="form-control" placeholder="client Name" value="<?php echo !empty($record->client_state)?$record->client_state:''?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <input type="text" name="client_country" class="form-control" placeholder="Email" value="<?php echo !empty($record->client_country)?$record->client_country:''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="client_address" class="form-control" placeholder="Home Address" value="<?php echo !empty($record->client_address)?$record->client_address:''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                        <label>Profile Picture<br/> (<span class="text-danger">Use Good Quality Images</span>)</label>
                                        <div class="input-group-btn">
                                          <div class="image-upload">                      
                                            <img class="imgpath" src="<?php echo !empty($record->client_image)?base_url('uploads/client/').$record->client_image:base_url('assets/img/placeholder.png')?>">
                                            <div class="file-btn">
                                              <input type="text" class="imageselect btn" id="client_image" data-toggle="modal" data-target="#exampleModal" name="client_image" value="<?php echo $record->client_image;?>" readonly>
                                              <label for="client_image" class="btn btn-info">Upload</label>
                                          </div>
                                      </div>
                                  </div>
                                  <?php echo form_error("client_image"); ?>
                              </div>
                          </div>  
                      </div>
                      <button type="submit" class="btn btn-info btn-fill">Update Profile</button>
                      <div class="clearfix"></div>
                  </form>
              </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400" alt="...">
            </div>
            <div class="content">
                <div class="author">
                 <a href="#">
                    <img class="avatar border-gray" src="<?php echo (!empty($record->client_image))? base_url('uploads/client/').$record->client_image :base_url('assets/img/unisex.png');?>" alt="...">

                    <h4 class="title"><?php echo $record->client_name;?><br>
                    </h4>
                </a>
            </div>
            <p class="description text-center"><?php echo $record->client_email;?><br>
                <br>


            </p>
            <?php if(!empty($record->pass_change_notification)):?>
            <p style="background:#ffb7b7;border-radius:5px;" class="description text-center">
                <a style="color:red" href="<?php echo base_url('home/remove_notification/').$this->session->userdata('client_id');?>"><i class="fas fa-window-close"></i></a>
                <b>
                    Note: <?php echo $record->pass_change_notification;?>

                </b>
            </p>
        <?php endif; ?>

        </div>
        <hr>
        <div class="text-center">
        </div>
    </div>
</div>



</div>
</div>
</div>
<?php endforeach; endif; ?>