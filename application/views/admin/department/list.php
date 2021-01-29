<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Department
            </h1>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <?php if(in_array('createDepartment',$this->permissions)): ?>
            <a class="btn btn-info" href="<?php echo site_url('add/department');?>">Add New</a>
        <?php endif; ?>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <table id="table_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Department Name</th>
                        <th>Actions</th>
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
                                <td><?php echo $record->department_name;?></td>
                                <td>
                                    <?php if(in_array('updateDepartment',$this->permissions)): ?>
                                        <a href="<?php echo site_url('department/edit/'.$record->department_id.'');?>"><span style="border-radius:5px;" class="edit_icon"><i class="fas fa-pencil-alt"></i></span></a>
                                    <?php endif; if(in_array('deleteDepartment',$this->permissions)): ?>
                                        <a href="<?php echo site_url('delete/department/'.$record->department_id.'');?>"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                    <?php endif; ?>
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
