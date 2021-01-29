<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Role
            </h1>
            <h3 class="box-title" style="display:inline-block;">Add</h3>
        </div>
        <div class="col-md-12">
            <form role="form" action="<?php echo base_url('role/add_data') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label>Role Name (Required)</label>
                        <input type="text" class="form-control" id="role_name"  name="role_name" value="<?php echo set_value('role_name'); ?>" required>
                        <?php echo form_error('role_name', '<div class="text-danger">', '</div>'); ?>
                    </div>
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
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewUser"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteUser"></td>
                                    </tr>
                                    <tr>
                                        <td>Roles</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewRole"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteRole"></td>
                                    </tr>
                                    <tr>
                                        <td>Client</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewClient"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteClient"></td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewDepartment"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteDepartment"></td>
                                    </tr>
                                    <tr>
                                        <td>Designation</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewDesignation"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteDesignation"></td>
                                    </tr>
                                    <tr>
                                        <td>Service Status</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewDevelopmentStatus"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteDevelopmentStatus"></td>
                                    </tr>
                                    <tr>
                                        <td>Client Inquiries</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createClientInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateClientInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewClientInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteClientInquiries"></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Inquiries</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createAssignInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateAssignInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewAssignInquiries"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteAssignInquiries"></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Resources</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewAssignResources"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteAssignResources"></td>
                                    </tr>
                                    <tr>
                                        <td>KPI</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewKpi"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteKpi"></td>
                                    </tr>
                                    <tr>
                                        <td>Domain</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewDomain"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteDomain"></td>
                                    </tr>
                                    <tr>
                                        <td>Domain Targets</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewDomainTarget"></td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteDomainTarget"></td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <td>Payment</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createPayment"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewPayment"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Refund</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createRefund"></td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Support</td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewSupport"></td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteSupport"></td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Appointment</td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td> - </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewApp"></td>-->
                                    <!--    <td>-</td>-->
                                    <!--</tr>-->

                                    <!--<tr>-->
                                    <!--    <td>KanBan Board</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createBoard"></td>-->
                                    <!--    <td> <input type="checkbox" name="role_permission[]" id="role_permission" value="createBoard"> </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewBoard"></td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteSupport"></td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>Email Template</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="createTemplate"></td>-->
                                    <!--    <td> <input type="checkbox" name="role_permission[]" id="role_permission" value="createTemplate"> </td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewTemplate"></td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteTemplate"></td>-->
                                    <!--</tr>-->

                                    <!--<tr>-->
                                    <!--    <td>Client Files</td>-->
                                    <!--    <td>-</td>-->
                                    <!--    <td>-</td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewClientFile"></td>-->
                                    <!--    <td><input type="checkbox" name="role_permission[]" id="role_permission" value="deleteClientFile"></td>-->
                                    <!--</tr>-->

                                    <tr>
                                        <td>Developer</td>
                                        <td> - </td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateDeveloper"></td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Setting</td>
                                        <td>-</td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateSetting"></td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Profile</td>
                                        <td> - </td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="updateProfile"></td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td>Analytics</td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td><input type="checkbox" name="role_permission[]" id="role_permission" value="viewAnalytics"></td>
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