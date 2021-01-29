
<style>



     h1{text-align: center;
    color: #094a42;
    font-size: 34px;
    font-weight: 400;
}

  .alert-danger {color: #a94442;background-color: #f2dede;border-color: #ebccd1; margin-top: 88px;}
  .sbmt2 {
    
    background-color: transparent;
    font-weight: 400;
    /*! opacity: 0.8; */
    filter: alpha(opacity=80);
    padding: 8px 16px;
    border-color: #888888;
    color: #fff;
    background: #12caa7;
    background: -moz-linear-gradient(left, #12caa7 0%, #22c0e6 100%);
    background: -webkit-linear-gradient(left, #12caa7 0%, #22c0e6 100%);
    background: linear-gradient(to right, #12caa7 0%, #22c0e6 100%)
    border-radius:50px;
    border-radius: 50px;
}
input#payBtn:hover {color: #fff !important; background: #8dc63f !important;}
.price-show{color: #25a9e1 !important;}
input.field1 {float: left; width: 100%;background: #efefef;color: #000;border: 1px solid #e2e2e2;border-radius: 2px;
    padding: 0px 10px;height: 45px;margin: 0 0 10px 0; box-shadow:0px 3px 4px #dfdfdf inset;}
    .pay-form {border: 4px solid #8dc63f;border-radius: 7px;padding: 22px 15px;}
    .pay-form h3{margin-bottom:15px;}
    .pay-form p { text-align: center;font-size: 18px;margin: 10px 0 22px;}
    .pay-form h2 { text-align: center;background: #8dc63f;color: #fff;font-size: 24px;padding: 8px 18px;margin: 0 auto ; display: table;
    }
    .pay-form label{float: left;font-weight: normal; font-size: 13px;}
    
    
     .pay-form h2{    background: #094a42;}
    .pay-form{border:4px solid #094a42}
    
    
    input.sbmt2{padding:10px;} .f-left{ float:left; text-align:left;} .f-right{ float:right;text-align:right;}
    @media (min-width: 320px) and (max-width: 480px) { .pay-form h2 {font-size: 20px; }
    .pay-form p{font-size: 13px;}
    .billing{ font-size: 22px;}
    @media only screen and (max-width: 500px){.sbmt2 {width: 100% !important;} }
    
   
    
</style>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>    
<script>
    Stripe.setPublishableKey('pk_test_bbpGR0QxhGaiNwq94HzFyQbT');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#payBtn').removeAttr("disabled");
            $('#payment-errors').addClass('alert alert-danger');
            $("#payment-errors").html(response.error.message);
        } else {
            var form$ = $("#paymentFrm");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
    $(document).ready(function() {
        $("#paymentFrm").submit(function(event) {
            $('#payBtn').attr("disabled", "disabled");
            Stripe.createToken({
                number: $('#card_num').val(),
                cvc: $('#card-cvc').val(),
                exp_month: $('#card-expiry-month').val(),
                exp_year: $('#card-expiry-year').val()
            }, stripeResponseHandler);
            return false;
        });
    });
</script>

<div class="inner-banner">
    <h1>PAYMENT INFO</h1>
</div>

<div class="container">

    <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 pay-form">
        <form method="post" id="paymentFrm" enctype="multipart/form-data" action="<?php echo base_url('checkout/check'); ?>">

            <h2>Payment Information</h2>
            <p>Enter Your Payment Information Below.</p>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 amount">
               <label>Amount you want to pay:</label>
               <input type="number" name="total_amount" class="field1" value="<?php echo !empty($records[0]->inquiry_balance) ? $records[0]->inquiry_balance : $inquiry_balance; ?>" placeholder="Amount you want to pay" required>
           </div>

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label>Card Number :</label>
               <input type="text" id="card_num" name="card_num" class="field1" placeholder="Enter Card Number" required="" data-inputmask="'mask': '9999999999999999'">
           </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label>Expiry Month :</label>
               <input type="text" id="card-expiry-month" name="exp_month" class="field1" placeholder="Enter Expiry Month" required="" data-inputmask="'mask': '99'">
           </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label>Expiry Year :</label>
               <input type="text" id="card-expiry-year" name="exp_year" class="field1" placeholder="Enter Expiry Year" required="" data-inputmask="'mask': '9999'">
           </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <label>Card Code :</label>
               <input type="text" id="card-cvc" name="cvc" class="field1" placeholder="Enter Card Code" required="" data-inputmask="'mask': '999'">
           </div>
           <input type="hidden" name="inquiry_id" value="<?php echo !empty($records[0]->client_inquiry_id) ? $records[0]->client_inquiry_id : $client_inquiry_id; ?>">

           <div class="clearfix"><br></div>
           <div class=" col-md-6 col-xs-12 no-margin no-padding">

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " style="margin:0; padding:0">
                <input type="submit" id="payBtn" class="sbmt2 btn" value="Submit Payment">
            </div>

            <div class="payment-erros-cont">
                <div id="payment-errors"></div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#card_num').on('keyup',function(e){
            card_val = $(this).val();
            if(card_val < 0){
                $(this).val('');
            }
            if(card_val.length !== 16)
            {
                $('#card_num').css({"border":"1px solid red"});
            }
            else
            {
                $('#card_num').css({"border":"0px"});
            }
            if(card_val.length > 16)
            {
                card_val = card_val.slice(0,1);
            }
        });
    });
</script>





