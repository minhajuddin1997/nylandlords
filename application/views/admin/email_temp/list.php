<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Email Template
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <a class="btn btn-info" href="<?php echo site_url('EmailTemplate/add_template');?>">Add New</a>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>subject</th>
                        <th>body</th>

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
                                <td><?php echo $record->title;?></td>
                                <td><?php echo $record->subject;?></td>
                                <td><?php echo $record->message;?></td>
                                <td>
                                    <a href="<?php echo base_url('EmailTemplate/edit_email_template/'.$record->email_template_id .'');?>" ><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit"></i></span></a>
                                    <a href="<?php echo base_url('EmailTemplate/delete_email_template/'.$record->email_template_id .'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>

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
