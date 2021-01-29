<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Email Message
            </h1>
            <h3 class="box-title" style="display:inline-block;">add</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('Appointment/add_email_msg')?>" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="department_id" id="department_id"  >
                            <?php if(!empty($record)):foreach($record as $val):?>
                               <option value="<?php echo $val->department_id; ?>"> <?php echo $val->department_name;?></option>
                            <?php endforeach; endif;?>

                        </select>
                        <span style="color:red"><?php echo form_error('department_id');?></span>

                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea  class="form-control"  id="message" required name="message" ></textarea>
                    </div>




                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>