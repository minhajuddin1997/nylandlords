<link rel="stylesheet" href="<?php echo base_url('assets/invoice/')?>css/styles.css" media="all" />
<?php if(!empty($records)): foreach($records as $record): ?>
  <div class="content">
    <div class="container-fluid">
      <div id="main-div">
        <header class="clearfix">
          <div class="hr2"></div>
          <div id="inv-div">
            <h3>Invoice</h3>
            <span class="f-left">#<?php echo $record->payment_no;?> </span> <span class="f-right"><?php echo date("d/m/Y",strtotime($record->client_payments_date)); ?></span>
            <div class="clearfix"></div>
            <hr>
            <ul>
              <li>Total: <span>$<?php echo $record->client_payments_amount;?></span></li>
              <li>Payment Date <span><?php echo date("d/m/Y",strtotime($record->client_payments_date)); ?></span></li>
              <li class="last">Payment Status <span><?php echo $record->client_payments_pay_status;?></span></li>
            </ul>
          </div>
          <div  id="company">
            <h2 class="name" id="logo"><img src="<?php echo base_url('uploads/settings/').$header_logo?>" width="280" height="65"></h2>
            <p style="font-size:14px"><?php echo $site_title;?><br>
            <?php echo $address;?></p>
            <p style="font-size:14px"><?php echo $phone_no;?></p>
            <p style="font-size:14px"><a href="mailto:<?php echo $email_add;?>"><?php echo $email_add;?></a></p>
          </div>

        </header>
        <main>
          <div id="details" class="clearfix">
            <div id="client">
              <div class="to">Terms & Notes</div>
              <p style="font-size:12px;">1- This is a computer generated invoice and does not require signature.</br>
                  2- Complete project terms are mentioned in approved proposal document.</p>
            </div>
            <div id="invoice">
              <h1>PAYMENT ID# <?php echo $record->client_payments_id;?></h1>
              <h2><?php echo get_name_by_id("client",$record->client_id);?></h2>
              <h2>Phone: <?php echo get_single_field('client',array('client_id'=>$record->client_id),'client_phone_number');?></h2>
              <div class="addr"><?php echo get_single_field('client',array('client_id'=>$record->client_id),'client_address');?></div>
              <div class="addr"><?php echo get_single_field('client',array('client_id'=>$record->client_id),'client_email');?></div>
            </div>
          </div>
          <?php $projectdata = $this->admin_m->get_list_single('client_projects',array('client_projects_id'=>$record->project_id));
          ?>
          <table border="0" cellspacing="0" cellpadding="0">
             <thead>
              <tr>
                <th class="no">#</th>
                <th class="desc">Package Deatils</th>
                
                <th class="qty"></th>
                <th class="total">Project Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="">01</td>
                <td class="det"><h3><?php echo $projectdata->project_name; ?></h3>
                  <label>- Project Type: <?php echo get_name_by_id("department",$projectdata->project_type)?></label>
                  <label>- Project Summary: <?php echo $projectdata->project_summary; ?></label>
                  <label>- Delivery Status: <?php echo $projectdata->delivery_status; ?></label>
                  
                  
                  
                  <td class="cen"></td>
                  <td class="cen">$<?php echo $projectdata->project_price;?></td>
                </tr>
                </tbody>
                <tfoot>
                  
                  <tr>
                    <th class="tp"></th>
                    
                    <th class="tp"></th>
                    <th class="tp">Amount Paid</th>
                    <th class="tp">$<?php echo $record->client_payments_amount;?></th>
                  </tr>
                  <tr style="border-bottom:1px solid #e4e3e3 !important">
                    <th class="sub "></th>
                    
                    <th class="sub "></th>
                    <th class="sub ">Remaining </th>
                    <th class="sub ">$<?php echo $projectdata->project_balance; ?></th>
                  </tr>
                  <tr>
                    <th class="tp"></th>
                    
                    <th class="tp"></th>
                    <th class="tp"></th>
                    <th class="tp"></th>
                  </tr>
                </tfoot>
              </table>
            </main>
          </div>

        </div>
      </div>
      <?php endforeach; endif; ?>