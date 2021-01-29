<div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Orders
      </h1>
      <h3 class="box-title" style="display:inline-block;">List</h3>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('add/orders');?>">Add New</a>
    <hr style="border-top: 1px solid #504444;">

    <div class="col-md-12">  
      <div class="box-body"> 
        <table id="table_id" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Customer Name</th>
              <th>Customer Email</th>
              <th>Customer Phone</th>
              <th>Order Number</th>
              <th>Order Type</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($records)):
              $x = 1;
              foreach($records as $record):
                ?>
                <tr style="background:<?php echo ($record->read_status == "unread")? '#d2f7d2':''?>">
                  <td><?php echo $x++;?></td> 
                  <td><?php echo $record->customer_fname;?>&nbsp;<?php echo $record->customer_lname;?></td>
                  <td><?php echo $record->customer_email;?></td>
                  <td><?php echo $record->customer_phone;?></td>
                  <td><?php echo $record->orders_no;?></td>
                  <td><?php echo $record->orders_type;?></td>
                  <td>
                    <a href="<?php echo site_url('view-update/orders/'.$record->orders_id.'');?>"><span class="view_icon"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
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
