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
        <!--<div>-->
        <!--	<h2 style="display:inline-block;">-->
        <!--		Details-->
        <!--	</h2>-->
        <!--	<h4 class="box-title" style="display:inline-block;">All</h4>-->
        <!--</div>    -->
        <div class="col-md-12 p_m">

            <?php if (!empty($records)): foreach ($records

            as $record): ?>
            <div class="content">
                <div class="container-fluid p_m">
                    <div>
                        <h1 style="display:inline-block;">
                            Inquiry
                        </h1>
                        <h3 class="box-title" style="display:inline-block;">Details</h3>
                    </div>
                    <div class="col-md-8 p_m">
                        <div class="box-body">
                            <table class="table">
                                <thead>

                                </thead>
                                <tbody>

                                <tr>
                                    <td width="30%"><b>Client Name</b></td>
                                    <td><?php echo get_name_by_id('client', $record->client_id); ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Name</b></td>
                                    <td><?php echo $record->inquiry_name; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Type</b></td>
                                    <td><?php echo get_name_by_id('department', $record->inquiry_type); ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Appointment Date</b></td>
                                    <td><?php echo $record->appointment_date; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Summary</b></td>
                                    <td><?php echo $record->inquiry_summary; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Create Date</b></td>
                                    <td><?php echo $record->client_inquiry_date; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Inquiry Brief Document</b></td>
                                    <td>
                                        <a href="<?php echo base_url('uploads/client_projects/') . $record->summary_file; ?>" download><?php echo $record->summary_file; ?></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($this->session->userdata('user_id') == 5): ?>
            <div>
                <h2 style="display:inline-block;">
                    Discussions
                </h2>
            </div>

            <div class="col-md-8 p_m">
                <form method="post" action="<?php echo base_url('home/reply_comment') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Reply to this thread</label>
                        <textarea class="form-control editor" rows="3" id="comments_text" name="comments_text"></textarea>
                    </div>

                    <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('client_id'); ?>">
                    <input type="hidden" name="inquiry_id" value="<?php echo $record->client_inquiry_id; ?>">


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
                <?php endif;?>

                <?php endforeach;
                endif; ?>
                <script>
                    $('document').ready(function () {
                        $(document).on('click', '#showimgupload', function () {
                            var linkvar = "<?php echo base_url('assets/img/placeholder.png')?>";
                            $(".showcommentimage").append('<div class="form-group"><label>Upload Images</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="comments_images_img" name="comments_images_img[]"><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showimgupload').remove();
                        });

                        $(document).on('click', '#showfileupload', function () {
                            var linkvar = "<?php echo base_url('assets/img/file.png')?>";
                           $(".notvisiblefile").append('<span id="file_name"></span><div class="form-group"><label>Upload Files ( NOTE: TO UPLOAD MULTIPLE FILES PRESS CTRL AND CLICK ON FILES )</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="comments_files_file" name="comments_files_file[]" multiple><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showfileupload').remove();
                        });
                    });
                </script>


                <?php if (!empty($comments)): foreach ($comments as $com): ?>
                    <div class="row" style="border:1px solid #cbcfcd;background-color: <?php echo ($com->sender_id != $this->session->userdata('user_id')) ? '#20e88421' : '#9143431a' ?>">
                        <div class="col-md-1">
                            <div class="dis-img-admin">

                                <?php $check = get_single_field('user', array('user_id' => $com->sender_id, 'user_type' => 'admin'), 'user_type'); ?>

                                <?php if ($check): ?>
                                    <img src="<?php echo base_url('uploads/user/') . get_single_field('user', array('user_id' => $com->sender_id), 'user_image'); ?>" alt="dis-img" class="img-responsive"/>
                                <?php else: ?>
                                    <img src="<?php echo base_url('uploads/client/') . get_single_field('client', array('client_id' => $com->sender_id), 'client_image'); ?>" alt="dis-img" class="img-responsive"/>
                                <?php endif; ?>


                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="dis-box">
                                <div>
                                    <?php if (!$check): ?>
                                        <h3><?php echo get_single_field('client', array('client_id' => $com->sender_id), 'client_name') ?></h3>
                                    <?php else: ?>
                                        <h3><?php echo get_single_field('user', array('user_id' => $com->sender_id), 'user_name') ?></h3>
                                    <?php endif; ?>
                                    <span><?php echo date('d-M-Y H:i:s', strtotime($com->comments_date)); ?></span>
                                </div>
                                <div class="">
                                    <p><?php echo $com->comments_text; ?></p>
                                    <?php $dataimages = get_list('comments_images', array('comments_id' => $com->comments_id)); ?>
                                    <div class="row">
                                        <?php $i = 1;
                                        if (!empty($dataimages)): foreach ($dataimages as $img): ?>

                                            <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                <a href="<?php echo base_url('uploads/comments_images/') . $img->comments_images_img; ?>" download>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid black" class="img-responsive" src="<?php echo base_url('uploads/comments_images/') . $img->comments_images_img; ?>">

                                                </a>
                                                <?php echo $img->comments_images_img; ?>
                                            </div>
                                            <?php if ($i == 4): ?>
                                                <?php $i = 0; ?>
                                                <div class="row"></div>
                                            <?php else: ?>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; endif; ?>
                                    </div>

                                    <?php $datafiles = get_list('comments_files', array('comments_id' => $com->comments_id)); ?>
                                    <div class="row">
                                        <?php $i = 1;
                                        if (!empty($datafiles)): foreach ($datafiles as $file): ?>

                                            <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                                <a href="<?php echo base_url('uploads/comments_files/') . $file->comments_files_file; ?>" download>
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
                                                <span><?php echo $file->comments_files_file; ?></span>
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
                    </div>
                    <br>
                <?php endforeach; endif; ?>

            </div>
        </div>
    </div>
</div>