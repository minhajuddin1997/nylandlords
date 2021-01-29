<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Client Files
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <!--        <a class="btn btn-info" href="-->
        <?php //echo site_url('file_upload/file_view');?><!--">Add New</a>-->
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Client Name</th>
                        <th>File Name</th>

                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($records)):
                        $x = 1;
                        foreach ($records as $record):
                            ?>
                            <tr>
                                <td><?php echo $x++; ?></td>
                                <td><?php echo $record->client_name; ?></td>
                                <td><?php echo $record->file_name; ?></td>

                                <td>
                                    <a href="<?php echo base_url('uploads/test/' . $record->file_name); ?>" download=""><span
                                                style="border-radius:5px;" class="download_icon"><i
                                                    class="fa fa-download"></i></span></a>
                                    <a href="<?php echo site_url('admin/delete_client_file/' . $record->client_only_files_id . ''); ?>"><span
                                                style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash"
                                                                                                  aria-hidden="true"></i></span></a>
                                    <a href="#"><span style="border-radius:5px;" class="edit_icon" data-toggle="modal"
                                                      data-target="#file_upload_modal"
                                                      onclick='return edit_file_name(<?php echo $record->client_only_files_id; ?>);'><i
                                                    class="fa fa-edit"></i></span></a>

                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
            </div>

            <div class="modal fade" id="file_upload_modal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">File Upload</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST"
                                  action="<?php echo site_url(); ?>File_Upload/update_upload_file_name/<?php echo $record->client_only_files_id; ?>">
                                <div class="form-group">
                                    <label for="file_name">File Name</label>
                                    <input type="text" class="form-control" name="file_name" id="file_name"
                                           placeholder="Enter File Name" required="required">
                                    <input type="hidden" class="form-control" name="hidden_ext" id="hidden_ext"
                                           placeholder="Enter File Name">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
