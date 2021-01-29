<?php if(!empty($records)): foreach($records as $record): ?>
<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Client
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
            <td>Client Image</td>
            <td><img style="max-width:300px" src="<?php echo !empty($record->client_image)?base_url('uploads/client/').$record->client_image:base_url('assets/img/placeholder.png')?>"></td>
          </tr>

          <tr>
            <td>Client Name</td>
            <td><?php echo $record->client_name;?></td>
          </tr>

          <tr>
            <td>Client Email</td>
            <td><?php echo $record->client_email;?></td>
          </tr>

          <!--<tr>-->
          <!--  <td>Client Password</td>-->
          <!--  <td><?php // echo $this->encryption->decrypt($record->client_password);?></td>-->
          <!--</tr>-->
          <tr>
            <td>Client Password</td>
            <td><?php echo "*****" ; ?></td>
          </tr>
          <tr>
            <td>Client Phone</td>
            <td><?php echo $record->client_phone_number;?></td>
          </tr>

           <tr>
            <td>Client Company</td>
            <td><?php echo $record->client_company;?></td>
          </tr>

           <tr>
            <td>Client Website</td>
            <td><?php echo $record->client_website;?></td>
          </tr>

          <tr>
            <td>Client Address</td>
            <td><?php echo $record->client_address;?></td>
          </tr>
          
           <tr>
            <td>Client City</td>
            <td><?php echo $record->client_city;?></td>
          </tr>

           <tr>
            <td>Client State</td>
            <td><?php echo $record->client_state;?></td>
          </tr>

           <tr>
            <td>Client Country</td>
            <td><?php echo $record->client_country;?></td>
          </tr>

          

        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<?php endforeach; endif;?> 
