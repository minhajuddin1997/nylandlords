<div class="content">
    <style>
        .p_m {
            padding: 0;
            margin: 0;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .table > thead > tr > th {
            text-align: left;
            padding: 10px 15px;
            border-right: 1px solid #ddd;
        }

        .table > tbody > tr > td {
            padding: 10px 15px;
            vertical-align: middle;
            text-align: left;
            border-right: 1px solid #ddd;
        }

        form {
            border-bottom: 1px solid #ddd;
            margin-bottom: 26px;
        }

        .dis-box span {
            float: right;
            margin: 7px 10px;
            color: #094941;
            font-weight: 600;
            font-size: 12px;
        }
    </style>

    <div class="container-fluid">
        <div class="col-md-12 p_m">
            <div class="content">
                <div class="container-fluid p_m">
                    <div class="col-md-12 p_m">
                        <div class="box-body">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 style="display:inline-block;">
                    Support
                </h2>
            </div>
            <div class="col-md-8 p_m">
                <form method="post" action="<?php echo base_url('admin/reply_support') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Reply to this thread</label>
                        <span class="pull-right">
                            <label>Email Template</label>
                            <select class="form-control" id="temp_id">
                                <option value="">Select Template</option>
                                <?php if(!empty($template)):foreach ($template as $email_tem):?>
                                <option value="<?php echo !empty($email_tem->email_template_id )?$email_tem->email_template_id :'';?>"><?php echo !empty($email_tem->title)?$email_tem->title:'';?></option>
                                <?php endforeach;endif;?>

                            </select>
                        </span>
                        <textarea class="form-control editor" rows="3" id="support_text" name="support_text" required ></textarea>
                    </div>
                    <input type="hidden" name="project_id" value="<?php echo $this->uri->segment(2); ?>">
                    <div style="height:60px;">
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                        <button id="showimgupload" style="border-color: #e39d21;color: #fff;background: #e39d21;" type="button" class="btn btn-primary"><b>Add Images</b></button>
                        <button id="showfileupload" style="border-color: #09af3b;color: #fff;background: #09af3b;" type="button" class="btn btn-primary "><b>Add Files</b></button>
                    </div>
                    <div class="showcommentimage">
                    </div>
                    <div class="notvisiblefile">
                    </div>
                </form>


                <script>
                    $('document').ready(function () {
                        $(document).on('click', '#showimgupload', function () {
                            var linkvar = "<?php echo base_url('assets/img/placeholder.png')?>";
                            $(".showcommentimage").append('<div class="form-group"><label>Upload Images</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="support_images_img" name="support_images_img[]"><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showimgupload').remove();
                        });

                        $(document).on('click', '#showfileupload', function () {
                            var linkvar = "<?php echo base_url('assets/img/file.png')?>";
                            $(".notvisiblefile").append('<span id="file_name"></span><div class="form-group"><label>Upload Files ( NOTE: TO UPLOAD MULTIPLE FILES PRESS CTRL AND CLICK ON FILES )</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="support_files_file" name="support_files_file[]" multiple><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showfileupload').remove();
                        });
                    });
                </script>
                <?php if (!empty($comments)): foreach ($comments as $com): ?>

                    <!--======================afshal=======================-->

                    <div class="row">
                        <div class=col-lg-3></div>
                        <div class="col-lg-9">
                            <?php $check = get_single_field('user', array('user_id' => $com->sender_id, 'user_type' => 'admin'), 'user_type'); ?>
                            <?php if (!($check)): ?>
                            <div class="form-group">

                                <label for="exampleFormControlTextarea1">


                                    <img style="margin-right: 0;margin-left: auto; width: 3%; border-radius: 50%;"  src="<?php echo base_url('uploads/client/') . get_single_field('client', array('client_id' => $com->sender_id), 'client_image'); ?>" alt="dis-img" class="img-responsive"/></label>
                                <div  style="height: auto; min-height: 100px; width: 100%; border-radius: 10px; border:1px solid #cbcfcd; background-color: #f4f3f0;">
                                    <p><?php echo $com->support_text; ?></p>
                                    <div class="">
                                        <!--                                    <p>--><?php //echo $com->support_text; ?><!--</p>-->
                                        <?php $dataimages = get_list('support_images', array('support_id' => $com->support_id)); ?>
                                        <div class="row">
                                            <?php $i = 1;
                                            if (!empty($dataimages)): foreach ($dataimages as $img): ?>

                                                <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                    <a href="<?php echo base_url('uploads/support_images/') . $img->support_images_img; ?>" download>
                                                        <img style="padding:5px;border-radius:5px;border:1px solid black" class="img-responsive" src="<?php echo base_url('uploads/support_images/') . $img->support_images_img; ?>">

                                                    </a>
                                                    <?php echo $img->support_images_img; ?>
                                                </div>
                                                <?php if ($i == 4): ?>
                                                    <?php $i = 0; ?>
                                                    <div class="row"></div>
                                                <?php else: ?>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; endif; ?>
                                        </div>

                                        <?php $datafiles = get_list('support_files', array('support_id' => $com->support_id)); ?>
                                        <div class="row">
                                            <?php $i = 1;
                                            if (!empty($datafiles)): foreach ($datafiles as $file): ?>

                                                <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                    <a href="<?php echo base_url('uploads/support_files/') . $file->support_files_file; ?>" download>
                                                        <?php if ($file->extension == '.txt'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/txt.png') ?>">
                                                        <?php elseif ($file->extension == '.pdf'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/pdf.png') ?>">
                                                        <?php elseif ($file->extension == '.xlsx'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/xlsx.png') ?>">
                                                        <?php elseif ($file->extension == '.docx'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/docx.png') ?>">
                                                        <?php elseif ($file->extension == '.rar'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/rar.png') ?>">
                                                        <?php elseif ($file->extension == '.zip'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/zip.png') ?>">
                                                        <?php else: ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/file.png') ?>">
                                                        <?php endif; ?>
                                                    </a>
                                                    <span><?php echo $file->support_files_file; ?></span>
                                                </div>
                                                <?php if ($i == 5): ?>
                                                    <?php $i = 0; ?>
                                                    <div class="row"></div>
                                                <?php else: ?>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                </div>
<!--                                <textarea readonly style="resize: none; border-radius: 10px; border:1px solid #cbcfcd; background-color: #f4f3f0;" class="form-control" id="exampleFormControlTextarea1" rows="3">--><?php //echo $com->support_text; ?><!--</textarea>-->

                            </div>
                            <span class="text-muted" style="float:right;"><?php echo date('H:i', strtotime($com->support_date)); ?></span>


                            <?php endif; ?>
                        </div>

                        <div class="col-lg-9">
                            <?php $check = get_single_field('user', array('user_id' => $com->sender_id, 'user_type' => 'admin'), 'user_type'); ?>
                            <?php if ($check): ?>
                            <div class="form-group">

                                <label for="exampleFormControlTextarea1"><img style="width: 3%; border-radius: 50%;" src="<?php echo base_url('uploads/user/') . get_single_field('user', array('user_id' => $com->sender_id), 'user_image'); ?>" alt="dis-img" class="img-responsive"/></label>
                                <div style="height: auto; width: 100%; min-height: 100px; border-radius: 10px; border:1px solid #cbcfcd; background-color: #fff; padding: 10px 15px">
                                    <p><?php echo $com->support_text; ?></p>
                                    <div class="">
                                        <!--                                    <p>--><?php //echo $com->support_text; ?><!--</p>-->
                                        <?php $dataimages = get_list('support_images', array('support_id' => $com->support_id)); ?>
                                        <div class="row">
                                            <?php $i = 1;
                                            if (!empty($dataimages)): foreach ($dataimages as $img): ?>

                                                <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                    <a href="<?php echo base_url('uploads/support_images/') . $img->support_images_img; ?>" download>
                                                        <img style="padding:5px;border-radius:5px;border:1px solid black" class="img-responsive" src="<?php echo base_url('uploads/support_images/') . $img->support_images_img; ?>">

                                                    </a>
                                                    <?php echo $img->support_images_img; ?>
                                                </div>
                                                <?php if ($i == 4): ?>
                                                    <?php $i = 0; ?>
                                                    <div class="row"></div>
                                                <?php else: ?>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; endif; ?>
                                        </div>

                                        <?php $datafiles = get_list('support_files', array('support_id' => $com->support_id)); ?>
                                        <div class="row">
                                            <?php $i = 1;
                                            if (!empty($datafiles)): foreach ($datafiles as $file): ?>

                                                <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                    <a href="<?php echo base_url('uploads/support_files/') . $file->support_files_file; ?>" download>
                                                        <?php if ($file->extension == '.txt'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/txt.png') ?>">
                                                        <?php elseif ($file->extension == '.pdf'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/pdf.png') ?>">
                                                        <?php elseif ($file->extension == '.xlsx'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/xlsx.png') ?>">
                                                        <?php elseif ($file->extension == '.docx'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/docx.png') ?>">
                                                        <?php elseif ($file->extension == '.rar'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/rar.png') ?>">
                                                        <?php elseif ($file->extension == '.zip'): ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/zip.png') ?>">
                                                        <?php else: ?>
                                                            <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc" class="img-responsive" src="<?php echo base_url('assets/img/file.png') ?>">
                                                        <?php endif; ?>
                                                    </a>
                                                    <span><?php echo $file->support_files_file; ?></span>
                                                </div>
                                                <?php if ($i == 5): ?>
                                                    <?php $i = 0; ?>
                                                    <div class="row"></div>
                                                <?php else: ?>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; endif; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <span class="text-muted" style="float:left;"><?php  echo  date('H:i', strtotime($com->support_date)); ?></span>
                            <?php endif;?>
                        </div>
                        <div class=col-lg-3></div>

                    </div>


                    <!--==========================================================-->
                    <br>
                <?php endforeach; endif; ?>


            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#temp_id').on('change',function (){
          let id=$("#temp_id option:selected").val();
        $.ajax({
            url:'<?php echo base_url('Admin/get_template');?>',
            method:'post',
            data:{id:id},
            dataType:'json',
            success:function (data){
                console.log(data.subject);
                CKEDITOR.instances['support_text'].setData(data.subject+data.message);
              // $('#support_text').text(data.subject+data.message);
            }
        })
        })

    })
</script>