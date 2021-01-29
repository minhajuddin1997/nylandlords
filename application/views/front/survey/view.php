<style>
    body{
		background-color: #25274d;
	}
	.contact{
		padding: 4%;
		height: 400px;
	}
	.col-md-3{
		background: #ff9b00;
		padding: 4%;
		border-top-left-radius: 0.5rem;
		border-bottom-left-radius: 0.5rem;
	}
	.contact-info{
		margin-top:10%;
	}
	.contact-info img{
		margin-bottom: 15%;
	}
	.contact-info h2{
		margin-bottom: 10%;
	}
	.col-md-9{
		background: #fff;
		padding: 3%;
		border-top-right-radius: 0.5rem;
		border-bottom-right-radius: 0.5rem;
	}
	.contact-form label{
		font-weight:600;
	}
	.contact-form button{
		background: #25274d;
		color: #fff;
		font-weight: 600;
		width: 25%;
	}
	.contact-form button:focus{
		box-shadow:none;
	}
</style>

<style>
	form.contact-input input, textarea {
    width: 100%;
    margin: 15px auto;
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid;
}
.contact-bg{
	
}
.contact-color-bg{
	border-top: 3px solid #2c4e73;
	margin: 70px auto;
	background-size: cover;
	width: 100%;
	background-repeat: no-repeat;
	height: 100%;
}
.select{
	margin: 10px auto
}
.btn-submit{
	background-image: linear-gradient(#266fb3, #2c4e73);
	color: #fff;
	border-radius: 50px;
	padding: 10px 15px;
	border: none;
	font-weight: 600;
}
</style>
<div class="content">
    	<section class="contact-bg">
		<div class="container">
					<div class="card contact-color-bg" style="background-image: url('https://myprojectstaging.com/nyc-dev/uploads/developer/background.jpg');">
					  <div class="card-body"  style="padding:2rem;">
					    <div class="row">
					    	<div class="col-lg-6">
					    		<h3>What is Lorem Ipsum?</h3>
					    		<p>
					    			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
					    		</p>
					    		<p>
					    			It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					    		</p>
					    	</div>
					    	<div class="col-lg-6">
					    		<form action="<?php echo base_url('Survey/submit'); ?>" method="POST" class="contact-input">
					    			<div class="row contact-input">
					    				<div class="col-lg-6 ">
					    					<input type="text" name="first_name" placeholder="First Name" />
					    				</div>
					    				<div class="col-lg-6">
					    					<input type="text" name="last_name" placeholder="Last Name" />
					    				</div>
					    			</div>
					    			<div class="row">
					    				<div class="col-lg-6">
					    					<input type="text" name="phone" placeholder="Your Phone Number"/>
					    				</div>
					    				<div class="col-lg-6">
					    					<input type="text" name="address" placeholder="Address" />
					    				</div>
					    			</div>
					    			<div class="row">
					    				<div class="col-lg-6">
					    					<input type="email" name="email" placeholder="Email" />
					    				</div>
					    				<div class="col-lg-6">
					    					<input type="text" name="city" placeholder="City" />
					    				</div>
					    			</div>
									<div class="row">
										<div class="col-lg-6">
											<input type="text" name="state" placeholder="State" />
										</div>
										<div class="col-lg-6">
											<input type="tel" name="zip" placeholder="Zip"/>
										</div>
									</div>
									<div class="col-lg-12 p-0">
									  <select class="form-control"  id="counties" placeholder="Senator">
									    <option value="">Choose Senator</option>
									  </select>
									</div>
									<div class="col-lg-12 p-0" id="senators_districts" style="display:none;">
									  <select class="form-control select" placeholder="Districts" name="senators_districts" id="senators_districts_list">
										    <option value="">Choose Districts</option>
									  </select>
									</div>
											
                    				<input type="hidden" name="senator_email" id='senator_email' value="">
									<div class="col-lg-12 p-0">
									  <select class="form-control select" name="assembly_counties" id="assembly_counties" placeholder="Assembly Man">
										<option value="">Choose Assembly Man</option>
									  </select>
									</div>
									<div class="col-lg-12 p-0" id="assembly_districts" style="display:none;">
									  <select class="form-control select" name="assembly_districts_list" id="assembly_districts_list">
										    <option value="">Choose Assembly District</option>
										   
									  </select>
									</div>
									
								    <input type="hidden" name="assembly_email" id='assembly_email' value="">
								    
									<button class="btn-send btn-submit" type="submit">Get a Call Back</button>
								</form>
					    	</div>
					    </div>
					  </div>
					</div>
				</div>
		</section>
  </div>
  
  <script>
        $(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('Survey/get_senators'); ?>",
				type: "GET",
				dataType: "JSON",
				success: function(data) {
				    var i=0;
				    console.log(data);
					for(i=0; i<data.length;i++){
					    $('#counties').append($('<option>', {
                            value: data[i].nyc_senators_counties,
                            text: data[i].nyc_senators_counties
                        }));
					}
				}
			})
			
			$.ajax({
				url: "<?php echo base_url('Survey/get_assembly'); ?>",
				type: "GET",
				dataType: "JSON",
				success: function(data) {
				    var j=0;
				    console.log(data);
					for(j=0; j<data.length;j++){
					    $('#assembly_counties').append($('<option>', {
                            value: data[j].nyc_assembly_counties,
                            text: data[j].nyc_assembly_counties
                        }));
					}
				}
			})
		});
		
		$("#counties").on('change', function() {
            var county_val = $(this).val();
            $("#senators_districts_list").empty();
			$.ajax({
				url: "<?php echo base_url('Survey/get_senators_districts?val='); ?>" + county_val,
				type: "GET",
				dataType: "JSON",
				success: function(data) {
				    $("#senators_districts").css('display','block');
				    var i=0;
					for(i=0; i<data.length;i++){
					    $('#senators_districts_list').append($('<option>', {
                            value: data[i].nyc_senators_districts,
                            text: data[i].nyc_senators_districts
                        }));
                        $("#senator_email").val(data[i].nyc_senators_emails);
					}
				}
			})
		});
		
		$("#assembly_counties").on('change', function() {
            var county_val = $(this).val();
            $("#assembly_districts_list").empty();
			$.ajax({
				url: "<?php echo base_url('Survey/get_assembly_districts?val='); ?>" + county_val,
				type: "GET",
				dataType: "JSON",
				success: function(data) {
				    if(data.length > 0) {
    				    $("#assembly_districts").css('display','block');
    				    var i=0;
    					for(i=0; i<data.length;i++){
    					    $('#assembly_districts_list').append($('<option>', {
                                value: data[i].nyc_assembly_districts,
                                text: data[i].nyc_assembly_districts
                            }));
                            console.log(data[i].nyc_assembly_emails);
                            $("#assembly_email").val(data[i].nyc_assembly_emails);
    					}
				    } else {
				        toastr.error('No Coresponding Data Found');
				    }
				}
			})
		});
  </script>
