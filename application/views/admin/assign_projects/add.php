<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Assign Project
            </h1>
            <h3 class="box-title" style="display:inline-block;">Add</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('assign_project/add_data') ?>" method="post"
                enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Select Project</label>
                        <select name="client_projects_id" id="client_projects_id" class="form-control select2" required style="width: 100%">
                            <option value="" >Select Project</option>
                            <?php if (!empty($client_projects)): foreach ($client_projects as $client_project): ?>
                            <option value="<?php echo $client_project->client_projects_id ?>"><?php echo $client_project->project_name ?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Project Lead</label>
                        <select name="assign_project_lead" id="assign_project_lead" class="form-control select2" required style="width: 100%">
                            <option value="" >Select Project Lead</option>
                            <?php if (!empty($users)): foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id ?>"><?php echo $user->user_name ?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Project Members</label>
                        <select name="user_id[]" id="user_id" class="form-control select2" multiple="multiple" required style="width: 100%">
                            <option value="" >Select Project Members</option>
                            <?php if (!empty($users)): foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id ?>"><?php echo $user->user_name ?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Current Status</label>
                        <select class="form-control" id="delivery_status" name="delivery_status" required>
                            <option value="">Select Current Status</option>
                            <option value="Brief">Brief</option>
                            <option value="Proposal">Proposal</option>
                            <option value="Setup Stage">Setup Stage</option>
                            <option value="In-Progress">In-Progress</option>
                            <option value="Initial Delivery">Initial Delivery</option>
                            <option value="Testing">Testing</option>
                            <option value="Final Delivery">Final Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Development Status</label>
                        <select name="development_status_id" id="development_status_id" class="form-control" required style="width: 100%">
                            <option value="" >Select Development Status</option>
                            <?php if (!empty($development_status)): foreach ($development_status as $status): ?>
                            <option value="<?php echo $status->development_status_id; ?>" ><?php echo $status->development_status_name; ?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Project Priority</label>
                        <select name="assign_project_priority" id="assign_project_priority" class="form-control" required style="width: 100%">
                            <option value="" >Select Project Priority</option>
                            <option value="low" >low</option>
                            <option value="medium" >medium</option>
                            <option value="high" >high</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Work Status</label>
                        <select name="kanban_status" id="kanban_status" class="form-control" required style="width: 100%">
                            <option value="" >Select Work Status</option>
                            <option value="todo" >To Do</option>
                            <option value="doing" >Doing</option>
                            <option value="done" >Done</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Project Delivery Date</label>
                        <input type="date" class="form-control" id="assign_project_delivery_date" required name="assign_project_delivery_date">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>