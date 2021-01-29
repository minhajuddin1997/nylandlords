<?php if (!empty($records)): foreach ($records as $record): ?>
    <div class="content">
        <div class="container-fluid">
            <div>
                <h1 style="display:inline-block;">
                    Development Status
                </h1>
                <h3 class="box-title" style="display:inline-block;">Edit</h3>
            </div>
            <div class="col-md-6">
                <form role="form" action="<?php echo site_url('update_data/development_status/' . $record->development_status_id . ''); ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="form-group">
                            <label>Select Designation</label>
                            <select name="designation_id" id="designation_id" class="form-control">
                                <option value="">Select Designation</option>
                                <?php if (!empty($designations)): foreach ($designations as $dev_status): ?>
                                    <option value="<?php echo $dev_status->designation_id ?>" <?php echo (($dev_status->designation_id == $record->designation_id)?'selected':'') ?>><?php echo $dev_status->designation_name ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Development Status name</label>
                            <input type="text" class="form-control" id="development_status_name" value="<?php echo !empty($record->development_status_name) ? $record->development_status_name : '' ?>" name="development_status_name" required/>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; endif; ?>