<?php if(!empty($records)): foreach($records as $record): ?>

  <div class="content">
  <div class="container-fluid">
    <div>
      <h1 style="display:inline-block;">
        Payment Details
      </h1>
      <h3 class="box-title" style="display:inline-block;">View</h3>
    </div>   
        <div class="col-12">
          <div class="invoice p-3 mb-3">
            <div class="row">
              <div class="col-12">
                <h4>
                  <b class="float-right">Payment Date : <?php echo $record->customer_payments_date; ?></b>
                </h4>
              </div>
              <hr></hr>
            </div>
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong><?php echo $site_title;?></strong><br>
                  <?php echo $address;?><br>
                  Phone: <?php echo $phone_no;?><br>
                  Email: <?php echo $email_add;?>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong><?php echo get_name_by_id("customer",$record->customer_id);?></strong><br>
                  Phone: <?php echo get_single_field('customer',array('customer_id'=>$record->customer_id),'customer_phone_number');?><br>
                  Email: <?php echo get_single_field('customer',array('customer_id'=>$record->customer_id),'customer_email');?>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                <b>Invoice #<?php echo $record->payment_no;?></b><br>
                <br>
                <b>Payment ID:</b> #00<?php echo $record->customer_payments_id;?><br>
                <b>Payment Status:</b> <?php echo $record->customer_payments_pay_status;?><br>
              </div>
            </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <?php if($record->customer_payments_pay_status == "Paid"):?>
                <h1 style="text-align: center;">PAID AMOUNT</h1>
                  <h1 style="text-align: center;color:green;"><b><?php echo $record->customer_payments_amount;?>$</b></h1>
                 >
                 <?php elseif($record->customer_payments_pay_status == "Unpaid"):?>
                  <h1 style="text-align: center;">UNPAID AMOUNT</h1>
                  <h1 style="text-align: center;color:red;"><b><?php echo $record->customer_payments_amount;?>$</b></h1>
                 >
                 <?php endif; ?>


              </div>
            </div>
            <div class="row">
              <div class="col-6">
    
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  A Terms and Conditions agreement is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website.
                </p>
              </div>
              <div class="col-6">
                <div class="table-responsive">

                  
                </div>
              </div>
            </div>
            <div class="row no-print">
              <div class="col-12">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; endif; ?>
