<?php if(!empty($records)): foreach($records as $record): ?>
  <div class="content">
    <div class="container-fluid">
      <div>
        <h1 style="display:inline-block;">
          Home Page
        </h1>
        <h3 class="box-title" style="display:inline-block;">Edit Data</h3>
      </div>
      <div class="col-md-6">
        <form role="form" action="<?php echo site_url('update_data/home_page/'.$record->home_page_id.'');?>" method="post" enctype="multipart/form-data">           
          <div class="box-body"> 

            <div class="form-group">
              <label>Home Page Banner</label>
              <div class="input-group-btn">
                <div class="image-upload">                      
                  <img class="imgpath" src="<?php echo !empty($record->banner_image)?base_url('uploads/home_page/').$record->banner_image:base_url('assets/img/placeholder.png')?>">
                  <div class="file-btn">
                    <input type="text" class="imageselect btn" value="<?php echo $record->banner_image;?>" id="banner_image" data-toggle="modal" data-target="#exampleModal" name="banner_image" value="" readonly>
                    <label for="banner_image" class="btn btn-info">Upload</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Home Page Banner Overlay Image</label>
              <div class="input-group-btn">
                <div class="image-upload">                      
                  <img class="imgpath" src="<?php echo !empty($record->banner_overlay_image)?base_url('uploads/home_page/').$record->banner_overlay_image:base_url('assets/img/placeholder.png')?>">
                  <div class="file-btn">
                    <input type="text" class="imageselect btn" value="<?php echo $record->banner_overlay_image;?>" id="banner_overlay_image" data-toggle="modal" data-target="#exampleModal" name="banner_overlay_image" value="" readonly>
                    <label for="banner_overlay_image" class="btn btn-info">Upload</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Home Page Sup Heading</label>
              <input type="name" class="form-control" id="section_two_sup_heading" name="section_two_sup_heading" value="<?php echo $record->section_two_sup_heading?>" required>
            </div>


            <div class="form-group">
              <label>Section two heading</label>
              <input type="name" class="form-control" id="section_two_heading" name="section_two_heading" value="<?php echo $record->section_two_heading?>" required>
            </div>

            <div class="form-group">
              <label>Section two text</span> </label>
              <textarea class="editor form-control" rows="3" id="section_two_text" name="section_two_text" required><?php echo !empty($record->section_two_text)?$record->section_two_text:''?></textarea>
            </div>

            <div class="form-group">
              <label>Section two Video Link</label>
              <input type="name" class="form-control" id="section_two_video" name="section_two_video" value="<?php echo $record->section_two_video?>" required>
            </div>

            <div class="form-group">
              <label>Section three heading</label>
              <input type="name" class="form-control" id="section_three_heading" name="section_three_heading" value="<?php echo $record->section_three_heading?>" required>
            </div>

            <div class="form-group">
              <label>Section three Text</label>
              <input type="name" class="form-control" id="section_three_text" name="section_three_text" value="<?php echo $record->section_three_text?>" required>
            </div>

            <div class="form-group">
              <label>Section three right heading</label>
              <input type="name" class="form-control" id="section_three_right_heading" name="section_three_right_heading" value="<?php echo $record->section_three_right_heading?>" required>
            </div>

            <div class="form-group">
              <label>Section Three right image</label>
              <div class="input-group-btn">
                <div class="image-upload">                      
                  <img class="imgpath" src="<?php echo !empty($record->section_three_right_image)?base_url('uploads/home_page/').$record->section_three_right_image:base_url('assets/img/placeholder.png')?>">
                  <div class="file-btn">
                    <input type="text" class="imageselect btn" value="<?php echo $record->section_three_right_image;?>" id="section_three_right_image" data-toggle="modal" data-target="#exampleModal" name="section_three_right_image" value="" readonly>
                    <label for="section_three_right_image" class="btn btn-info">Upload</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Form Instruction Line One</label>
              <input type="name" class="form-control" id="form_instruction_line_one" name="form_instruction_line_one" value="<?php echo $record->form_instruction_line_one?>" required>
            </div>

             <div class="form-group">
              <label>Form Instruction Line Two</label>
              <input type="name" class="form-control" id="form_instruction_line_two" name="form_instruction_line_two" value="<?php echo $record->form_instruction_line_two?>" required>
            </div>

            <div class="form-group">
              <label>Form Button Text </label>
              <input type="name" class="form-control" id="form_button_text" name="form_button_text" value="<?php echo $record->form_button_text?>" required>
            </div>


          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?php echo base_url('admin')?>" class="btn btn-danger">Dashboard</a>
          </div>    
        </form>  
      </div>
    </div>
  </div>
  <?php endforeach; endif;?> 