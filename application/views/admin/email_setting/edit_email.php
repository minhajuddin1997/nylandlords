<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Email Message
            </h1>
            <h3 class="box-title" style="display:inline-block;">edit</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('Appointment/edit_email_msg/'.$record->email_setting_id);?>" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="department_id" id="department_id"  >
                            <?php if(!empty($departs)):foreach($departs as $val):?>

                                <option <?php echo !empty($record->department_id) && $record->department_id==$val->department_id?'selected':'';?> value="<?php echo $val->department_id; ?>"> <?php echo $val->department_name;?></option>

                            <?php endforeach; endif;?>
                        </select>
                        <span style="color:red"><?php echo form_error('department_id');?></span>

                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea  class="form-control"  id="message" required name="message">  <?php echo !empty($record->message)?$record->message:'';?></textarea>
                    </div>




                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>