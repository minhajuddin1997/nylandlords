<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Role
            </h1>
            <h3 class="box-title" style="display:inline-block;">Edit</h3>
        </div>
        <div class="col-md-12">
            <form role="form" action="<?php echo site_url('role/update_data/' . $record->role_id . ''); ?>"
                  method="post" enctype="multipart/form-data">
                <div class="box-body">


                    <div class="form-group">
                        <label>Role Name (Required)</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo !empty($record->role_name)?$record->role_name:'' ?>" required>
                        <?php echo form_error('role_name', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <?php
                        $permissions = json_decode($record->role_permission);
                    ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Permissions</h4>
                                <?php echo form_error('role_permission[]', '<div class="text-danger">', '</div>'); ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>Modules</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Users</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createUser',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateUser',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewUser',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteUser',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteUser"></td>
                                    </tr>
                                    <tr>
                                        <td>Roles</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createRole',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateRole',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewRole',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteRole',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteRole"></td>
                                    </tr>
                                    <tr>
                                        <td>Client</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createClient',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateClient',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewClient',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteClient',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteClient"></td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createDepartment',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDepartment',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewDepartment',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteDepartment',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteDepartment"></td>
                                    </tr>
                                    <tr>
                                        <td>Designation</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createDesignation',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDesignation',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewDesignation',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteDesignation',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteDesignation"></td>
                                    </tr>
                                    <tr>
                                        <td>Development Status</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createDevelopmentStatus',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDevelopmentStatus',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewDevelopmentStatus',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteDevelopmentStatus',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteDevelopmentStatus"></td>
                                    </tr>
                                    <tr>
                                        <td>Client Inquiries</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createClientInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createClientProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateClientInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateClientProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewClientInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewClientProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteClientInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteClientProjects"></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Inquiries</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createAssignInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createAssignProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateAssignInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateAssignProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewAssignInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewAssignProjects"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteAssignInquiries',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteAssignProjects"></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Resources</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createAssignResources',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateAssignResources',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewAssignResources',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteAssignResources',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteAssignResources"></td>
                                    </tr>
                                    <tr>
                                        <td>KPI</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createKpi',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateKpi',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewKpi',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteKpi',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteKpi"></td>
                                    </tr>
                                    <tr>
                                        <td>Domain</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createDomain',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDomain',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewDomain',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteDomain',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteDomain"></td>
                                    </tr>
                                    <tr>
                                        <td>Domain Targets</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('createDomainTarget',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="createDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDomainTarget',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewDomainTarget',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteDomainTarget',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteDomainTarget"></td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <td>Payment</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" <?php //echo (in_array('createPayment',$permissions) ? 'checked' : '') ?> id="role_permission"-->
                                    <!--               value="createPayment"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" <?php //echo (in_array('viewPayment',$permissions) ? 'checked' : '') ?> id="role_permission"-->
                                    <!--               value="viewPayment"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Refund</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" <?php //echo (in_array('createRefund',$permissions) ? 'checked' : '') ?> id="role_permission"-->
                                    <!--               value="createRefund"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--</tr>-->
                                    <tr>
                                        <td>Support</td>
                                        <td> -</td>
                                        <td> -</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('viewSupport',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="viewSupport"></td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('deleteSupport',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="deleteSupport"></td>
                                    </tr>

                                    <!--<tr>-->
                                    <!--    <td>Appointment</td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td><input type="checkbox" <?php// echo (in_array('viewApp',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="viewApp"></td>-->
                                    <!--    <td>-</td>-->
                                    <!--</tr>-->

                                    <!--<tr>-->
                                    <!--    <td>KanBan Board</td>-->
                                    <!--    <td><input type="checkbox"  <?php// echo (in_array('createBoard',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="createBoard"></td>-->
                                    <!--    <td> <input type="checkbox" <?php// echo (in_array('createBoard',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="createBoard"> </td>-->
                                    <!--    <td><input type="checkbox"  <?php //echo (in_array('viewBoard',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="viewBoard"></td>-->
                                    <!--    <td><input type="checkbox"  <?php //echo (in_array('deleteBoard',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="deleteBoard"></td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Email Template</td>-->
                                    <!--    <td><input type="checkbox" <?php// echo (in_array('createTemplate',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="createTemplate"></td>-->
                                    <!--    <td> <input type="checkbox" <?php// echo (in_array('createTemplate',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="createTemplate"> </td>-->
                                    <!--    <td><input type="checkbox" <?php //echo (in_array('viewTemplate',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="viewTemplate"></td>-->
                                    <!--    <td><input type="checkbox" <?php// echo (in_array('deleteTemplate',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="deleteTemplate"></td>-->
                                    <!--</tr>-->

                                    <!--<tr>-->
                                    <!--    <td>Client Files</td>-->
                                    <!--    <td>-</td>-->
                                    <!--    <td>-</td>-->
                                    <!--    <td><input type="checkbox"  <?php //echo (in_array('viewClientFile',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="viewClientFile"></td>-->
                                    <!--    <td><input type="checkbox" <?php //echo (in_array('deleteClientFile',$permissions) ? 'checked' : '') ?> name="role_permission[]" id="role_permission" value="deleteClientFile"></td>-->
                                    <!--</tr>-->

                                    <tr>
                                        <td>Developer</td>
                                        <td> - </td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateDeveloper',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateDeveloper"></td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Setting</td>
                                        <td>-</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateSetting',$permissions) ? 'checked' : '') ?> id="role_permission"
                                                   value="updateSetting"></td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                    <tr>
                                        <td>Profile</td>
                                        <td> -</td>
                                        <td><input type="checkbox" name="role_permission[]" <?php echo (in_array('updateProfile',$permissions) ? 'checked' : '') ?>
                                           id="role_permission"
                                                   value="updateProfile"></td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                    <tr>
                                        <td>Analytics</td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" <?php echo (in_array('viewAnalytics',$permissions) ? 'checked' : '') ?> value="viewAnalytics"></td>
                                        <td> - </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
