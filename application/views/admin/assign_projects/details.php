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

    <div class="container-fluid p_m">
        <!--<div>-->
        <!--<h2 style="display:inline-block;">-->
        <!--	Details-->
        <!--</h2>-->
        <!--<h4 class="box-title" style="display:inline-block;">All</h4>-->
        <!--</div>    -->
        <div class="col-md-12 p_m">

            <div class="content">
                <div class="container-fluid p_m">
                    <div>
                        <h1 style="display:inline-block;">
                            Project
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
                                    <td><b>Project Name</b></td>
                                    <td><?php echo $record->project_name; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Type</b></td>
                                    <td><?php echo $this->admin_m->get_single_field('department',array('department_id'=>$record->project_type),'department_name'); ?></td>
                                </tr>

                                <tr>
                                    <td><b>Status</b></td>
                                    <td><?php echo $record->delivery_status; ?></td>
                                </tr>


                                <tr>
                                    <td><b>Project Cost</b></td>
                                    <td><?php echo $record->project_price; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Paid</b></td>
                                    <td><?php echo $record->project_paid; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Balance</b></td>
                                    <td><?php echo $record->project_balance; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Status</b></td>
                                    <td><?php echo $record->delivery_status; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Summary</b></td>
                                    <td><?php echo $record->project_summary; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Create Date</b></td>
                                    <td><?php echo $record->client_projects_date; ?></td>
                                </tr>

                                <tr>
                                    <td><b>Project Brief Document</b></td>
                                    <td>
                                        <a href="<?php echo base_url('uploads/client_projects/') . $record->summary_file; ?>"
                                           download>
                                            <?php echo $record->summary_file; ?></a>

                                    </td>
                                </tr>
                                <?php if (!empty($department_answer)): ?>
										<tr>
											<td><b>Project Brief</b></td>
											<td>
											    <a target="_blank" title="View Project Brief" href="<?php echo base_url('assign_project/department_answer/'.$this->uri->segment(4).'/'.$record->project_type) ?>">View Project Brief</a>
											    
											    
											 </td>
										</tr>  
									<?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <h2 style="display:inline-block;">
                    Discussions
                </h2>
            </div>

            <div class="col-md-8 p_m">
                <form method="post" action="<?php echo base_url('assign_project/reply_comment') ?>"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Reply to this thread</label>
                        <textarea class=" form-control editor" rows="3" id="comments_text" name="comments_text"
                                  required></textarea>
                    </div>
                    <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                    <input type="hidden" name="project_id" value="<?php echo $this->uri->segment(3); ?>">

                    <div style="height:60px;">

                        <button type="submit" class="btn btn-primary mb-14">Post Comment</button>

                        <div style="float:right">
                            <button id="showimgupload"
                                    style="border-color: #e39d21;color: #fff;background: #e39d21;font-size: 12px;"
                                    type="button" class="btn btn-primary"><b>Add Images</b></button>
                            <button id="showfileupload"
                                    style="border-color: #09af3b;color: #fff;background: #09af3b;font-size: 12px;"
                                    type="button" class="btn btn-primary "><b>Add Files</b></button>

                        </div>

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
                            $(".showcommentimage").append('<div class="form-group"><label>Upload Images</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="comments_images_img" name="comments_images_img[]"><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showimgupload').remove();
                        });

                        $(document).on('click', '#showfileupload', function () {
                            var linkvar = "<?php echo base_url('assets/img/file.png')?>";
                            $(".notvisiblefile").append('<div class="form-group"><label>Upload Files ( NOTE: TO UPLOAD MULTIPLE FILES PRESS CTRL AND CLICK ON FILES )</label><div class="input-group-btn"><div class="multi-image-upload"><img src="' + linkvar + '"><div class="file-btn"><input type="file" id="comments_files_file" name="comments_files_file[]" multiple><label class="btn btn-info">Upload</label></div></div></div></div>');
                            $('#showfileupload').remove();
                        });
                    });
                </script>


                <?php if (!empty($comments)): foreach ($comments as $com): ?>
                    <div class="row p_m"
                         style="border-radius:4px;border:1px solid #cbcfcd;background-color: <?php echo ($com->user_id != $this->session->userdata('user_id')) ? '#20e88421' : '#9143431a' ?>">
                        <div class="col-md-1">
                            <div class="dis-img-admin">


                                    <img src="<?php echo base_url('uploads/user/') . get_single_field('user', array('user_id' => $com->user_id), 'user_image'); ?>"
                                         alt="dis-img" class="img-responsive"/>


                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="dis-box">
                                <div>


                                        <h3><?php echo get_single_field('user', array('user_id' => $com->user_id), 'user_name') ?></h3>

                                    <span><?php echo date('d-M-Y H:i:s', strtotime($com->assign_project_comment_date)); ?></span>
                                </div>
                                <p><?php echo $com->assign_project_comment_text; ?></p>


                                <?php $dataimages = $this->db->select('assign_project_comment_file_name')->where('assign_project_comment_id', $com->assign_project_comment_id)->where_in('assign_project_comment_file_extension',[".gif",".jpg",".png",".jpeg"])->get('assign_project_comment_file')->result(); ?>
                                <div class="row">
                                    <?php $i = 1;
                                    if (!empty($dataimages)): foreach ($dataimages as $img): ?>

                                        <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                            <a href="<?php echo base_url('uploads/assign_project_comment_file/') . $img->assign_project_comment_file_name; ?>"
                                               download>
                                                <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                     class="img-responsive"
                                                     src="<?php echo base_url('uploads/assign_project_comment_file/') . $img->assign_project_comment_file_name; ?>">
                                            </a>
                                            <?php echo $img->assign_project_comment_file_name; ?>
                                        </div>
                                        <?php if ($i == 6): ?>
                                            <?php $i = 0; ?>
                                            <div class="row"></div>
                                        <?php else: ?>
                                            <?php $i++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; endif; ?>
                                </div>

                                <?php $datafiles = $this->db->select('assign_project_comment_file_name, assign_project_comment_file_extension')->where('assign_project_comment_id', $com->assign_project_comment_id)->where_in('assign_project_comment_file_extension',[".pdf",".docx",".pptx",".txt",".xlsx",".rar",".zip",".xlsm",".xls",".csv",".xlsb",".xlw",".xltx"])->get('assign_project_comment_file')->result(); ?>
                                <div class="row">
                                    <?php $i = 1;
                                    if (!empty($datafiles)): foreach ($datafiles as $file): ?>

                                        <div style="margin-top:11px;margin-bottom:11px;" class="col-sm-2">

                                            <a href="<?php echo base_url('uploads/assign_project_comment_file/') . $file->assign_project_comment_file_name; ?>"
                                               download>

                                                <?php if ($file->assign_project_comment_file_extension == '.txt'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/txt.png') ?>">
                                                <?php elseif ($file->assign_project_comment_file_extension == '.pdf'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/pdf.png') ?>">
                                                <?php elseif ($file->assign_project_comment_file_extension == '.xlsx'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/xlsx.png') ?>">
                                                <?php elseif ($file->assign_project_comment_file_extension == '.docx'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/docx.png') ?>">
                                                <?php elseif ($file->assign_project_comment_file_extension == '.rar'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/rar.png') ?>">
                                                <?php elseif ($file->assign_project_comment_file_extension == '.zip'): ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/zip.png') ?>">
                                                <?php else: ?>
                                                    <img style="padding:5px;border-radius:5px;border:1px solid #c5cbcc"
                                                         class="img-responsive"
                                                         src="<?php echo base_url('assets/img/file.png') ?>">
                                                <?php endif; ?>

                                            </a>
                                            <span><?php echo substr($file->assign_project_comment_file_name, 0, 20); ?></span>
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
                    <br>
                <?php endforeach; endif; ?>

            </div>
        </div>
    </div>
</div>