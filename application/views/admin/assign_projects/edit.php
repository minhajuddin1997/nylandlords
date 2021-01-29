  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Project
        </h1>
        <h3 class="box-title" style="display:inline-block;"><?php echo get_single_field('client_projects', ['client_projects_id' => $record->client_projects_id], 'project_name') ?> Edit</h3>
      </div>     
      <div class="col-md-6">
        <form role="form" action="<?php echo site_url('assign_project/update_data/'.$record->assign_project_id.'');?>" method="post" enctype="multipart/form-data">
            <div class="box-body">

                <div class="form-group">
                    <label>Select Project Lead</label>
                    <select name="assign_project_lead" id="assign_project_lead" class="form-control select2" required style="width: 100%">
                        <option value="" >Select Project Lead</option>
                        <?php if (!empty($users)): foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id ?>" <?php echo ($user->user_id == $record->assign_project_lead) ? 'selected': ''?>><?php echo $user->user_name ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Project Members</label>
                    <select name="user_id[]" id="user_id" class="form-control select2" multiple="multiple" required style="width: 100%">
                        <option value="" >Select Project Members</option>
                        <?php if (!empty($users)): foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id ?>"
                                <?php if(!empty($members)): foreach ($members as $member):
                                    echo ($user->user_id == $member->user_id) ? 'selected' : '';
                                endforeach; endif; ?>
                            ><?php echo $user->user_name ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Current Status</label>
                    <select class="form-control" id="delivery_status" name="delivery_status" required>
                        <option value="">Select Current Status</option>
                        <option value="Brief" <?php echo ($record->delivery_status == 'Brief') ? 'selected' : ''; ?>>Brief</option>
                        <option value="Proposal" <?php echo ($record->delivery_status == 'Proposal') ? 'selected' : ''; ?>>Proposal</option>
                        <option value="Setup Stage" <?php echo ($record->delivery_status == 'Setup Stage') ? 'selected' : ''; ?>>Setup Stage</option>
                        <option value="In-Progress" <?php echo ($record->delivery_status == 'In-Progress') ? 'selected' : ''; ?>>In-Progress</option>
                        <option value="Initial Delivery" <?php echo ($record->delivery_status == 'Initial Delivery') ? 'selected' : ''; ?>>Initial Delivery</option>
                        <option value="Testing" <?php echo ($record->delivery_status == 'Testing') ? 'selected' : ''; ?>>Testing</option>
                        <option value="Final Delivery" <?php echo ($record->delivery_status == 'Final Delivery') ? 'selected' : ''; ?>>Final Delivery</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Development Status</label>
                    <select name="development_status_id" id="development_status_id" class="form-control" required style="width: 100%">
                        <option value="" >Select Development Status</option>
                        <?php if (!empty($development_status)): foreach ($development_status as $status): ?>
                        <option value="<?php echo $status->development_status_id; ?>" <?php echo ($status->development_status_id == $record->development_status_id) ? 'selected' : '' ?>><?php echo $status->development_status_name; ?></option>
                        <?php endforeach;endif;?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Project Priority</label>
                    <select name="assign_project_priority" id="assign_project_priority" class="form-control" required style="width: 100%">
                        <option value="" >Select Project Priority</option>
                        <option value="critical" <?php echo ($record->assign_project_priority == 'critical') ? 'selected' : ''; ?>>Critical</option>
                        <option value="low" <?php echo ($record->assign_project_priority == 'low') ? 'selected' : ''; ?>>low</option>
                        <option value="medium" <?php echo ($record->assign_project_priority == 'medium') ? 'selected' : ''; ?>>medium</option>
                        <option value="high" <?php echo ($record->assign_project_priority == 'high') ? 'selected' : ''; ?>>high</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Work Status</label>
                    <select name="kanban_status" id="kanban_status" class="form-control" required style="width: 100%">
                        <option value="" >Select Work Status</option>
                        <option <?php echo ($record->kanban_status == 'todo') ? 'selected' : ''; ?> value="todo" >To Do</option>
                        <option <?php echo ($record->kanban_status == 'doing') ? 'selected' : ''; ?> value="doing" >Doing</option>
                        <option <?php echo ($record->kanban_status == 'done') ? 'selected' : ''; ?> value="done" >Done</option>
                    </select>
                </div>
                
                <?php if ($this->session->userdata('role_id') != '9'): ?>

                <div class="form-group">
                    <label>Project Delivery Date</label>
                    <input type="date" class="form-control" id="assign_project_delivery_date" required value="<?php echo !empty($record->assign_project_delivery_date)?$record->assign_project_delivery_date:''; ?>" name="assign_project_delivery_date">
                   <input type="hidden" name="client_projects_id" value="<?php echo $record->client_projects_id;?>">
                </div>
                
                <?php endif; ?>

            </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>    
        </form>  
      </div>
    </div>
  </div> 
