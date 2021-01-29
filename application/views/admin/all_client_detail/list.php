<div class="content">
  <div class="container-fluid">
    <div>
      <h3 style="display:inline-block;">
        Client
      </h3>
      <h5 class="box-title" style="display:inline-block;">List</h5>
    </div>
    <hr style="border-top: 1px solid #504444;">
    <div class="col-md-12">  
      <div class="box-body"> 
        
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">S.NO</th>
              <th scope="col">Online</th>
              <th scope="col">Last Login</th>
              <th scope="col">Name</th>
              <th scope="col">Company</th>
              <th scope="col">Total Projects</th>
              <th scope="col">Paid Projects</th>
              <th scope="col">Unpaid Projects</th>
              <th scope="col">Appointment Date</th>
              <th scope="col">Appointment Start Time</th>
              <th scope="col">Appointment End Time</th>
                <th scope="col">Logs</th>
            </tr>
          </thead>
          <tbody>
              <?php $i=1; if(!empty($records)): foreach($records as $record):?>
            <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td><?php echo ($record->online_status == "online")?'<i style="color:green" class="fas fa-dot-circle"></i>':'<i style="color:red" class="fas fa-dot-circle"></i>' ; ?></td>
              <td width="15%"><?php echo $record->last_login; ?></td>
              <td><?php echo $record->client_name; ?></td>
              <td><?php echo $record->client_company; ?></td>
              <td><?php echo $record->total_projects; ?></td>
              <td><?php echo $this->admin_m->get_paid_total($record->client_id); ?></td>
              <td><?php echo ($record->total_projects)-($this->admin_m->get_paid_total($record->client_id)); ?></td>
              <td><b><?php echo $record->appointment_date; ?></b></td>
              <td style="color:green"><b><?php echo $record->appointment_start_time; ?></b></td>
              <td style="color:red"><b><?php echo $record->appointment_end_time; ?></b></td>
                <td><a href="<?php echo base_url('logs/index/'.$record->client_id);?>" class="btn btn-primary"> Logs</a></td>
            </tr>
            <?php $i++; endforeach; endif;?>
          </tbody>
        </table>
       
     </div>
     <div class="box-footer">
    </div>    
  </div>
</div>
</div>
