<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Appointment Type
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <!--        <a class="btn btn-info" href="--><?php //echo site_url('file_upload/file_view');?><!--">Add New</a>-->
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Department</th>
                        <th>Appointment Type</th>
                        <th>Description</th>
                        <th>Time</th>

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
                                <td><?php echo $this->admin_m->get_single_field('department',array('department_id '=>$record->app_depart),'department_name');?></td>
                                <td><?php echo $record->app_type;?></td>
                                <td><?php echo $record->app_description;?></td>
                                <td><?php echo $record->app_time;?></td>

                                <td>
                                    <a href="<?php echo base_url('Appointment/index/'.'edit_form/'.$record->appointment_type_id );?>" ><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit"></i></span></a>
                                    <a href="<?php echo site_url('Appointment/view_list_delete/'.$record->appointment_type_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i  class="fa fa-trash" aria-hidden="true"></i></span></a>

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
