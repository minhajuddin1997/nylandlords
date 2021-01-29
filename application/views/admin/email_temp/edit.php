<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Email Template
            </h1>
            <h3 class="box-title" style="display:inline-block;">add</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('EmailTemplate/edit_email_template/'.$record->email_template_id )?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo !empty($record->title)?$record->title:'';?>" required />
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" required  value="<?php echo !empty($record->subject)?$record->subject:'';?>"/>
                    </div>

                    <div class="form-group">
                        <label>body</label>
                        <textarea  class="form-control editor"  id="message" required name="message"  ><?php  echo !empty($record->message)?$record->message:'';?></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>