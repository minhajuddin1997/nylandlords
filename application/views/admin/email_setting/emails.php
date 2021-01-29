<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Email Messages
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
                <a class="btn btn-info" href="<?php echo site_url('Appointment/add_email_msg');?>">Add New</a>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Department</th>
                        <th>Email Message</th>

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
                                <td><?php echo $this->admin_m->get_single_field('department',array('department_id '=>$record->department_id),'department_name');?></td>
                                <td><?php echo $record->message;?></td>
                                <td>
                                    <a href="<?php echo base_url('Appointment/edit_email_msg/'.$record->email_setting_id.'');?>" ><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit"></i></span></a>
                                    <a href="<?php echo base_url('Appointment/delete_email_msg/'.$record->email_setting_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>

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
