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
                <form method="post" action="<?php echo base_url('home/reply_support') ?>" enctype="multipart/form-data">
                    <!--						<div class="form-group">-->
                    <!--                            <label>Select User</label>-->
                    <!--                            <select class="select2 form-control" name="user_admin_id" id="user_admin_id">-->
                    <!--                                --><?php //if(!empty($users)): foreach($users as $val):?>
                    <!--                                <option value="--><?php //echo $val->user_id;?><!--">-->
                    <!--                                    --><?php //echo $val->user_name;?>
                    <!--                                </option>-->
                    <!--                                --><?php //endforeach; endif;?>
                    <!--                            </select>-->
                    <!--                        </div>-->
                    <input type="hidden" name="user_admin_id" value="<?php echo $user_admin_id; ?>"/>

                    <div class="form-group">
                        <label>Reply to this thread</label>
                        <span class="pull-right">  <button type="button" class="btn" data-toggle="modal" data-target="#myModal">Book A Call</button></span>
                    <br>
                    <br>
                        <textarea class="form-control editor" rows="3" id="support_text" name="support_text"></textarea>
                    </div>
                    <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('client_id'); ?>">
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

                    <!--==============Afshal============-->

                    <div class="row">
                        <div class=col-lg-3></div>
                        <div class="col-lg-9">
                            <?php $check = get_single_field('user', array('user_id' => $com->sender_id, 'user_type' => 'admin'), 'user_type'); ?>

                            <?php if ($check): ?>
                                <div class="form-group">

                                    <label for="exampleFormControlTextarea1"><img style="margin-right: 0;margin-left: auto; width: 3%; border-radius: 50%;" src="<?php echo base_url('uploads/user/') . get_single_field('user', array('user_id' => $com->sender_id), 'user_image'); ?>" alt="dis-img" class="img-responsive"/></label>
                                    <div style="height: auto; min-height: 100px; width: 100%; border-radius: 10px; border:1px solid #cbcfcd; background-color: #f4f3f0;">
                                        <p><?php //echo $com->support_text; ?></p>
                                        <div class="">
                                            <p><?php echo $com->support_text; ?></p>
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
                                <span class="text-muted" style="float:right;"><?php echo date('H:i:', strtotime($com->support_date)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-9">
                            <?php if (!($check)): ?>
                                <div class="form-group">

                                    <label for="exampleFormControlTextarea1">
                                        <img style="width: 3%; border-radius: 50%;" src="<?php echo base_url('uploads/client/') . get_single_field('client', array('client_id' => $com->sender_id), 'client_image'); ?>" alt="dis-img" class="img-responsive"/></label>
                                    <div style="height: auto; width: 100%; min-height: 100px; border-radius: 10px; border:1px solid #cbcfcd; background-color: #fff; padding: 10px 15px;;">
                                        <p><?php //echo $com->support_text; ?></p>
                                        <div class="">
                                            <p><?php echo $com->support_text; ?></p>
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
                                <span class="text-muted" style="float:left;">  <span class="text-muted" style="float:right;"><?php echo date('H:i:', strtotime($com->support_date)); ?></span></span>
                            <?php endif; ?>
                        </div>
                        <div class=col-lg-3></div>

                    </div>

                    <!--========================================-->
                    <div class="row" style="display:none; border-radius: 10px; border:1px solid #cbcfcd;background-color: <?php echo ($com->sender_id != $this->session->userdata('user_id')) ? '#ffffff' : '#f4f3f0' ?>">
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
                                    <span><?php echo date('d-M-Y H:i:s', strtotime($com->support_date)); ?></span>
                                </div>
                                <div class="">
                                    <p><?php echo $com->support_text; ?></p>
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
                    </div>
                    <br>
                <?php endforeach; endif; ?>

            </div>
        </div>
    </div>
</div>
<!--book a call-->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form id="form1" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book A Call</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="client_name" class="form-control" required>
                        <input type="hidden" name="admin_id" value="<?php echo $this->uri->segment(4); ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="client_email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>phone</label>
                        <input type="text" name="client_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Admin Availablity :</label>
                        <?php if(!empty($admin_available->to_date)):?>
                        <span><?php echo "<b>To</b> " . date('d-M-Y', strtotime($admin_available->to_date)) . " ";
                            echo "<b>From </b>" . date('d-M-Y', strtotime($admin_available->from_date)) . " ";
                            ?></span>
                            <?php endif;?>
                            <br>
                        <label>Time :</label>
                        <span><?php echo "<b>To</b> " . date('H:i', strtotime(!empty($admin_available->to_time)?$admin_available->to_time:'')) . " ";
                            echo "<b>From </b>" . date('H:i', strtotime(!empty($admin_available->from_time)?$admin_available->from_time:'')) . " ";
                            ?></span>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="appoint_type_id" id="appoint_type_id">
                            <option>Select Department</option>
                            <?php if(!empty($appointments)): foreach ($appointments as $val):?>

                                <option data-id="<?php echo $val->appointment_type_id  ;?>" value="<?php echo $val->app_depart;?>"> <?php echo $this->admin_m->get_single_field('department',array('department_id'=>$val->app_depart),'department_name');?></option>
                            <?php endforeach; endif;?>
                        </select>
                    </div>
                    <div class="form-group" id="app_type_name">
                    </div>
                    <div class="form-group">
                        <label>Appointment Description (addtional)</label>
                        <textarea  name="app_desc" class="form-control" required> </textarea>
                    </div>

                </div>
                <div>
                    <center>
                        <span id="msg" style="color: green;text-align: center;"></span>
                        <span id="err" style="color: red;text-align: center;"></span>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" id="book_call" class="btn btn-default">Book A Call</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#book_call').on('click', function () {
            let frm = $('#form1');

            $.ajax({
                url: '<?php echo base_url("BookACall/index");?>',
                method: "post",
                data: frm.serialize(),
                dataType: 'json',
                success: function (data) {
                    console.log(data.success);
                    if (data == "success") {
                        $('#err').text('');
                        $('#msg').text('Appointment Successfully Done');
                        $('#form1')[0].reset();
                        setTimeout(function(){  $('#msg').text(''); }, 3000);
                    } else {
                        $('#msg').text('');
                        $('#err').text('Admin not Available This Day and Time');
                        $('#form1')[0].reset();
                        setTimeout(function(){  $('#msg').text(''); }, 3000);
                    }

                }
            })
        })

        $('#appoint_type_id').on('change',function (){
            let app_id=$(this).find(':selected').attr('data-id');
            let html='';
            $.ajax({
                url:"<?php echo base_url('BookACall/getAppType');?>",
                method: 'post',
                data:{app_id:app_id},
                dataType:'json',
                success:function(data){
                    html +='<label>Appointment Type </label>';
                    html +='<input type="text" name="app_type" class="form-control" readonly value="'+data.app_type+'"> ';

                    html+='<label> Description </label>';
                    html +='<input type="text"  name="app_description" class="form-control" readonly value="'+data.app_description+'"> ';

                    html+='<label> Time </label>';
                    html +='<input type="text"  name="app_time" class="form-control" readonly value="'+data.app_time+'"> ';

                    $('#app_type_name').html(html);



                }

            })
        })
    })
</script>
