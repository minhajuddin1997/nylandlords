<?php if(!empty($records)): foreach($records as $record): ?>
  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Inquiry
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
                <td>Inquiry Name</td>
                <td><?php echo $record->inquiry_name;?></td>
              </tr>

              <tr>
                <td>Inquiry Type</td>
                <td><?php echo get_name_by_id('department',$record->inquiry_type);?></td>
              </tr>

               <tr>
                <td>Inquiry Cost</td>
                <td><?php echo $record->inquiry_price;?></td>
              </tr> 

              <tr>
                <td>Inquiry Summary</td>
                <td><?php echo $record->inquiry_summary;?></td>
              </tr>  

              <tr>
                <td>Inquiry Create Date</td>
                <td><?php echo $record->client_inquiry_date;?></td>
              </tr>  

              

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; endif;?> 
