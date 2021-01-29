<div class="content">
    <div class="container-fluid">
        <div>
            <h2 style="display:inline-block;">
                Assign Projects
            </h2>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>
        <?php if(in_array('createAssignProjects',$this->permissions) || $this->session->userdata('user_type') == 'admin'): ?>
        <a class="btn btn-info" href="<?php echo site_url('assign_project/add'); ?>">Assign New</a>
        <?php endif; ?>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body new-box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="table_id">
                        <thead>
                        <tr>
                            <th>Project No</th>
                            <th>Project Name</th>
                            <th>Lead</th>
                            <th>Team Members</th>
                            <th>Development Status</th>
                            <th>Delivery Status</th>
                            <th>Priority</th>
                            <th>Percentage</th>
                            <th>Delivery Date</th>
                            <th>Create Date</th>
                            <th>Discussion</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($records)):
                            foreach ($records as $record):
                                ?>
                                <tr>
                                    <td><?php echo $record['assign_project_id']; ?></td>
                                    <td><?php echo $record['project_name']; ?></td>
                                    <td><?php echo $record['user_name']; ?></td>
                                    <td>
                                        <?php if (!empty($record['assign_project_user'])) {
                                            echo '<ul class="list-inline new-img-list">';
                                            foreach ($record['assign_project_user'] as $users) {
                                                echo '<li class="list-inline-item">
                                                          <img title="' . $users['user_name'] . '" alt="' . $users['user_name'] . '" class="table-avatar" src="' . base_url('uploads/user/' . $users['user_image']) . '">
                                                      </li>';
                                            }
                                            echo '</ul>';
                                        } ?>
                                    </td>
                                    <td>
                                        <select name="development_status_id" data-id="<?php echo $record['assign_project_id']; ?>" class="development_status_id form-control" style="width: 100%">
                                            <option value="" >Select Development Status</option>
                                            <?php if (!empty($development_status)): foreach ($development_status as $status): ?>
                                            <option value="<?php echo $status->development_status_id; ?>" <?php echo ($record['development_status_id'] == $status->development_status_id)? 'selected' :'' ?>><?php echo $status->development_status_name; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </td>
                                    <td><?php echo $record['delivery_status'] ?></td>
                                    <td><?php echo $record['assign_project_priority']; ?></td>
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar"
                                                 aria-volumenow="<?php echo (int)$record['assign_project_percentage']; ?>"
                                                 aria-volumemin="0" aria-volumemax="100"
                                                 style="width: <?php echo (int)$record['assign_project_percentage']; ?>%">
                                            </div>
                                        </div>
                                        <small>
                                            <?php echo (int)$record['assign_project_percentage']; ?>% Complete
                                        </small>
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata('role_id') == '9'):
                                        echo date('d-m-Y', strtotime($record['assign_project_delivery_date']));
                                        else: ?>
                                        <input type="date" data-id="<?php echo $record['assign_project_id']; ?>" name="assign_project_delivery_date" class="assign_project_delivery_date form-control" value="<?php echo $record['assign_project_delivery_date']; ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($record['assign_project_date'])); ?></td>
                                    <td>
                                        <a href="<?php echo site_url('assign_project/project_details/' . $record['assign_project_id'] . '/'.$record['client_projects_id']); ?>">
                                            <span class="edit_icon" style="border-radius:15px;">Details</span>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if(in_array('updateAssignProjects',$this->permissions)): ?>
                                        <a href="<?php echo site_url('assign_project/edit/'.$record['assign_project_id'].'');?>"><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit" aria-hidden="true"></i></span></a>
                                        <?php endif; if(in_array('deleteAssignProjects',$this->permissions)): ?>
                                        <a href="<?php echo site_url('assign_project/delete/'.$record['assign_project_id'].'');?>"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>


                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(document).on('change','.development_status_id',function() {
            let assign_project_id = $(this).data('id');
            let development_status_id = $(this).val();

            if (development_status_id) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('assign_project/development_status?id=') ?>"+assign_project_id+"&status="+development_status_id,
                    dataType: "JSON",
                    success: function (data) {
                        toastr.success(data);
                    }
                })
            } else {
                return false;
            }
        })

        $(document).on('change','.assign_project_delivery_date',function() {
            let assign_project_id = $(this).data('id');
            let assign_project_delivery_date = $(this).val();
            if (assign_project_delivery_date) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('assign_project/delivery_date') ?>",
                    data: {assign_project_id: assign_project_id, assign_project_delivery_date:assign_project_delivery_date},
                    dataType: "JSON",
                    success: function (data) {
                        toastr.success(data);
                    }
                })
            } else {
                return false;
            }
        })

    })
</script>