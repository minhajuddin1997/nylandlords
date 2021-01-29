<script>
	$(document).ready(function (){
		$("form").on("change","#product_name",function() {   
			var str = $(this).val();
			str = str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
			$('#product_slug').val(str);
		});
	});
</script>
<div class="content">
	<div class="container-fluid">
		<div>
			<h1 style="display:inline-block;">
				Product
			</h1>
			<h3 class="box-title" style="display:inline-block;">Add</h3>
		</div>    
		<div class="col-md-6">
			<form role="form" action="<?php echo base_url('add_data/').$table?>" method="post" enctype="multipart/form-data">       
				<div class="box-body">

					<?php if(!empty($coloums)): foreach($coloums as $fields):?>

						<?php if($fields->type == "varchar" && strpos(str_replace("_"," ", $fields->name),"image") !== FALSE):?>
							<div class="form-group">
								<label><?php echo str_replace("_"," ", $fields->name); ?></label>
								<div class="input-group-btn">
									<div class="image-upload">                      
										<img class="imgpath" src="<?php echo base_url('assets/img/placeholder.png')?>">
										<div class="file-btn">
											<input type="text" class="imageselect btn" id="<?php echo $fields->name; ?>"  data-toggle="modal" data-target="#exampleModal" name="<?php echo $fields->name; ?>" readonly>
											<label for="<?php echo $fields->name; ?>" class="btn btn-info">Upload</label>
										</div>
									</div>
								</div>
							</div>

							<?php elseif($fields->type == "varchar"):?>
								<div class="form-group">
									<label><?php echo str_replace("_"," ", $fields->name); ?></label>
									<input type="name" class="form-control" id="<?php echo $fields->name; ?>" name="<?php echo $fields->name; ?>" >
								</div> 
								<?php elseif($fields->type == "text"):?>
									<div class="form-group">
										<label><?php echo str_replace("_"," ", $fields->name); ?></label>
										<textarea class="editor form-control" rows="3" id="<?php echo $fields->name; ?>" name="<?php echo $fields->name; ?>" required></textarea>
									</div>
								<?php endif; ?>
							<?php endforeach; endif;  ?>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url('admin')?>" class="btn btn-danger">Dashboard</a>
						</div>    
					</form>  
				</div>
			</div>
		</div> 