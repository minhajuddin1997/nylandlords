<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Uploaded Files
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <a class="btn btn-info" href="<?php echo site_url('File_Upload/file_view');?>">Add New</a>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>File Name</th>
                        <th>Created At</th>
                        <th>Action</th>
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
                                <td><?php echo $record->file_name;?></td>
                                <td><?php echo $record->created_at;?></td>
                                <td>
                                    <a href="<?php echo base_url('uploads/test/'.$record->file_name);?>" download=""><span style="border-radius:5px;" class="download_icon"><i class="fa fa-download"></i></span></a>
                                    <a href="<?php echo base_url('File_Upload/delete/'.$record->client_only_files_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
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
