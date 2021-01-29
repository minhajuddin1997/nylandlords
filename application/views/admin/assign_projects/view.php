<?php if(!empty($records)): foreach($records as $record): ?>
  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Project
        </h1>
        <h3 class="box-title" style="display:inline-block;">Details</h3>
      </div>   
      <div class="col-md-12">
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th style="width: 300px;">Attributes</th>
                <th>Values</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>Client Name</td>
                <td><?php echo get_name_by_id('client',$record->client_id);?></td>
              </tr>

              <tr>
                <td>Project Name</td>
                <td><?php echo $record->project_name;?></td>
              </tr>

              <tr>
                <td>Project Type</td>
                <td><?php echo get_name_by_id('department',$record->project_type);?></td>
              </tr>

               <tr>
                <td>Project Cost</td>
                <td><?php echo $record->project_price;?></td>
              </tr> 

              <tr>
                <td>Project Summary</td>
                <td><?php echo $record->project_summary;?></td>
              </tr>  

              <tr>
                <td>Project Create Date</td>
                <td><?php echo $record->client_projects_date;?></td>
              </tr>  

              

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; endif;?> 
