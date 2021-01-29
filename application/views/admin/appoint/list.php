<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Calendar</title>


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/celender/vendors/styles/core.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/celender/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/celender/src/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/celender/vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>
<body>

<div class="mobile-menu-overlay"></div>

<div class="container">

    <div class="tab-wrap">

        <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
        <label for="tab1">My Calender</label>

        <input type="radio" id="tab2" name="tabGroup1" class="tab">
        <label for="tab2">Appointment Types</label>

        <input type="radio" id="tab3" name="tabGroup1" class="tab">
        <label for="tab3">Default Available</label>

        <input type="radio" id="tab4" name="tabGroup1" class="tab">
        <label for="tab4">Settings</label>


        <div class="tab__content mt-0">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-30">
                        <div class="calendar-wrap">
                            <div id='calendar'></div>
                        </div>
                        <!-- calendar modal -->
                        <div id="modal-view-event" class="modal modal-top fade calendar-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4 class="h4"><span class="event-icon weight-400 mr-3"></span><span class="event-title"></span></h4>
                                        <div class="event-body"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php
if($this->uri->segment(3)=='edit_form') {
    $action = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3).'/'.$this->uri->segment(4);

}

;?>
        <div class="tab__content mt-0">
            <form method="post" action="<?php echo !empty($action)?base_url('Appointment/add_appoint_type/'.$this->uri->segment(3).'/'.$this->uri->segment(4)):base_url('Appointment/add_appoint_type'); ?>">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="form-group">
                            <lable>select Department</lable>
                            <select class="form-control" name="app_depart" required>
                                <?php if(!empty($depart)):foreach($depart as $val):?>
                                    <option <?php echo !empty($records->app_depart)&& $records->app_depart==$val->department_id?'selected':'';?> value="<?php echo $val->department_id;?>"><?php echo $val->department_name;?></option>
                                <?php endforeach; endif;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Appointment Type</label>
                            <input type="text" name="app_type" class="form-control" value="<?php echo !empty($records->app_type)?$records->app_type:'';?>" required>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Description </label>
                            <textarea class="form-control" name="app_description"><?php echo !empty($records->app_description)?$records->app_description:'';?>
                            </textarea>

                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Time </label>
                            <input class="form-control" type="text" name="app_time" id="app_time" value="<?php echo !empty($records->app_time)?$records->app_time:'';?>" required/>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <button class="btn pull-right">Submit</button>
                        <a href="<?php echo base_url('Appointment/view_list');?>" class="btn btn-danger pull-right"> List</a>


                    </div>


                </div>
            </form>
        </div>
        <!--this blow div default avilablty-->

        <div class="tab__content mt-0">
            <form method="post" action="<?php echo base_url('Default_available/index/'.$this->session->userdata('user_id')); ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>To</label>
                            <input type="date" name="to_date" required class="form-control" value="<?php echo !empty($default_time->to_date)?$default_time->to_date:''?>"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>From</label>
                            <input type="date" name="from_date" required class="form-control" value="<?php echo !empty($default_time->from_date)?$default_time->from_date:''?>"/>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>To</label>
                            <input type="time" name="to_time" required class="form-control" value="<?php echo !empty($default_time->to_time)?$default_time->to_time:''?>"/>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>From</label>
                            <input type="time" name="from_time" required class="form-control"  value="<?php echo !empty($default_time->from_time)?$default_time->from_time:''?>"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>

<!--        setting tabs -->

        <div class="tab__content mt-0">

            <div class="col-sm-12 ">
                <a href="<?php echo base_url('Appointment/email_setting');?>" class="btn btn-info pull-right" >Email Settings</a>
            </div>

            <table id="table_id" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Client Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <td>Department</td>

                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($email)):
                    $x = 1;
                    foreach($email as $value):
                        ?>
                        <tr>
                            <td><?php echo $x++;?></td>
                            <td><?php echo $value->client_name;?></td>
                            <td><?php echo $value->client_email;?></td>
                            <td><?php echo $value->client_phone;?></td>
                            <td><?php echo $value->date;?></td>
                            <td><?php echo $value->time;?></td>
                            <td><?php echo get_single_field('department',array('department_id'=>$value->appoint_type_id),'department_name');?></td>

                            <td>
                                <a href="#" class="view_email"   data-id="<?php echo !empty($value->book_a_call_id)?$value->book_a_call_id:'';?>"><span style="border-radius:5px;" class="view_icon"><i class="fa fa-eye"></i></span></a>

                                <a href="<?php echo site_url('Appointment/send_email_to_admin/'.$value->appoint_type_id.'/'.$value->book_a_call_id.'');?>"><span style="border-radius:5px;" class="Email"><i  class="fa fa-envelope" aria-hidden="true"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach; endif;?>
                </tbody>
            </table>
        </div>
        <!-- Tab panes -->
    </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Email Detail</h4>
            </div>
            <table class="table">
                <tr>
                    <th> Appointment Type </th>
                    <td id="app_type"></td>
                </tr>
                <tr>
                    <th> Department </th>
                    <td id="department"></td>
                </tr>
                <tr>
                    <th> Time</th>
                    <td id="time"></td>
                </tr>
                <tr>
                    <th> Description (Additional) </th>
                    <td id="additional_desc"></td>
                </tr>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- js -->
<script src="<?php echo base_url(); ?>assets/admin/celender/vendors/scripts/core.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/celender/vendors/scripts/script.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/celender/vendors/scripts/process.js"></script>
<!--<script src="--><?php //echo base_url();?><!--assets/admin/celender/vendors/scripts/layout-settings.js"></script>-->
<script src="<?php echo base_url(); ?>assets/admin/celender/src/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/celender/vendors/scripts/calendar-setting.js"></script>


<!--input masking-->

<!--<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>-->

</body>
</html>
<script>


    // $('#app_time').inputmask("99:min/hr");
</script>

<script>
    jQuery(document).ready(function () {
        jQuery("#add-event").submit(function () {
            alert("Submitted");
            var values = {};
            $.each($('#add-event').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            console.log(
                values
            );
        });
    });

    (function () {
        'use strict';
        // ------------------------------------------------------- //
        // Calendar
        // ------------------------------------------------------ //
        jQuery(function () {
            // page is ready
            jQuery('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                // emphasizes business hours
                businessHours: false,
                defaultView: 'month',
                // event dragging & resizing
                editable: true,
                // header
                header: {
                    left: 'title',
                    center: 'month,agendaWeek,agendaDay',
                    right: 'today prev,next'
                },
                events: [
                    <?php if(!empty($record)):foreach($record as $val):?>
                    {
                        title: '<?php echo $val->client_name;?>',
                        description: '<?php echo "Appointment Type : ". $val->app_type."<br>" . 'Department : ' .
                            $this->admin_m->get_single_field('department',array('department_id'=>$val->appoint_type_id),'department_name').
                                        '<br>'. 'Time : '. $val->app_time .'<br>' . 'Description : ' .$val->app_description
                        .'Description (Additonal) : '.$val->app_desc;?>',
                        start: '<?php echo $val->date;?>',
                        // end: '2020-09-14',
                        className: 'fc-bg-default',
                        // icon: "birthday-cake"
                    },
                    <?php endforeach;endif;?>

                ],
                dayClick: function () {
                    jQuery('#modal-view-event-add').modal();
                },
                eventClick: function (event, jsEvent, view) {
                    jQuery('.event-icon').html("<i class='fa fa-" + event.icon + "'></i>");
                    jQuery('.event-title').html(event.title);
                    jQuery('.event-body').html(event.description);
                    jQuery('.eventUrl').attr('href', event.url);
                    jQuery('#modal-view-event').modal();
                },
            })
        });

    })(jQuery);
</script>

<script>
    $(document).ready(function (){
    $('.view_email').on('click',function (){
        let id=$(this).attr('data-id');
        $.ajax({
            url:'<?php echo base_url("BookACall/getResultBook");?>',
            method:'post',
            data:{id:id},
            dataType:'json',
            success:function (data){
                console.log(data);

                $('#app_type').text(data.app_type);
                $('#department').text(data.department_name);
                $('#time').text(data.app_time);
                $('#additional_desc').text(data.app_desc);
                $('#myModal').modal('show');
            }
        })
    })

    })
</script>   