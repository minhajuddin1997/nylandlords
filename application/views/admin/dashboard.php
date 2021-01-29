<link rel="stylesheet" href="<?php echo base_url('assets/admin/fullcalendar/dist/fullcalendar.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/fullcalendar/dist/fullcalendar.print.min.css'); ?>">
<div class="content">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card ">
                        <div id="piechart" style="width: auto; height: 400px;"></div>
                    </div>
                    <script>
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                <?php if(!empty($chartdatastatuswise)): foreach($chartdatastatuswise as $pie):?>
                                ['<?php echo $pie->delivery_status; ?>', <?php echo $pie->count; ?>],
                                <?php endforeach; endif; ?>
                            ]);

                            var options = {
                                title: 'PROJECT STAGES'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    </script>
                </div>

                <div class="col-md-6">
                    <div class="card ">
                        <div id="donutchart" style="width: auto; height: 400px;"></div>

                        <script type="text/javascript">
                            google.charts.load("current", {packages: ["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'Hours per Day'],
                                    <?php foreach($uploadedservicewise as $statuswise):?>
                                    ['<?php echo $this->admin_m->get_single_field("department", array("department_id" => $statuswise->project_type), "department_name");?>',     <?php echo $statuswise->count?>],
                                    <?php endforeach; ?>
                                ]);

                                var options = {
                                    title: 'PROJECT UPLOADED SERVICE WISE',
                                    pieHole: 0.4,
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                chart.draw(data, options);
                            }
                        </script>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card ">
                        <div id="columnchart_material" style="width: 400px; height: 400px;"></div>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages': ['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Till Now', 'PAID', 'UNPAID'],
                                    <?php foreach($paidcompareunpaid as $chartdata):?>
                                    ['Till Now', <?php echo $chartdata->paid;?>, <?php echo $chartdata->balance;?>],
                                    <?php endforeach; ?>
                                ]);


                                var options = {
                                    chart: {
                                        title: 'PAID AND UNPAID AMOUNT',
                                        subtitle: 'PAID, UNPAID',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">PROJECTS PER MONTH</h4>
                        </div>
                        <div class="card-body ">
                            <div id="chart_div" style="width: auto; height: 400px;"></div>
                            <script type="text/javascript">
                                google.charts.load('current', {'packages': ['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Month', 'Project '],
                                        <?php foreach($uploadedmonthwise as $monthwise):if($monthwise->uploaded_year == '2019'):?>
                                        <?php $monthNum = $monthwise->uploaded_month; $dateObj = DateTime::createFromFormat('!m', $monthNum);$monthName = $dateObj->format('M'); ?>

                                        ['<?php echo $monthName . '|19' ?>',  <?php echo $monthwise->count?> ],
                                        <?php endif;?>
                                        <?php endforeach; ?>

                                        <?php foreach($uploadedmonthwise as $monthwise):if($monthwise->uploaded_year == '2020'):?>
                                        <?php $monthNum = $monthwise->uploaded_month; $dateObj = DateTime::createFromFormat('!m', $monthNum);$monthName = $dateObj->format('M'); ?>

                                        ['<?php echo $monthName . '|20' ?>',  <?php echo $monthwise->count?> ],
                                        <?php endif;?>
                                        <?php endforeach; ?>

                                    ]);

                                    var options = {
                                        title: 'PROJECTS UPLOADED MONTH WISE',
                                        hAxis: {title: 'Month', titleTextStyle: {color: '#000'}},
                                        vAxis: {minValue: 0}
                                    };

                                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                                    chart.draw(data, options);
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card ">

                        <div id="columnchart_material2" style="width: auto; height: 400px;"></div>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages': ['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Year', 'Sales'],
                                    <?php foreach($uploadedservicewise as $statuswise):?>
                                    ['<?php echo $this->admin_m->get_single_field("department", array("department_id" => $statuswise->project_type), "department_name");?>', <?php echo $statuswise->count?>],
                                    <?php endforeach; ?>
                                ]);

                                var options = {
                                    chart: {
                                        title: 'PROJECT UPLOADED SERVICE WISE',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div id="columnchart_values" style="width: auto; height: 400px;"></div>
                        <script type="text/javascript">
                            google.charts.load("current", {packages: ['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["Element", "Payment", {role: "style"}],


                                    <?php foreach($uploadedpaymentwise as $paymonthwise):$time = strtotime($paymonthwise->client_payments_date);$year = date("Y", $time);
                                    if($paymonthwise->year == '2019' ):?>
                                    <?php $monthNum = $paymonthwise->uploaded_month; $dateObj = DateTime::createFromFormat('!m', $monthNum);$monthName = $dateObj->format('M'); ?>
                                    ["<?php echo $monthName . '/19'; ?>", <?php echo $paymonthwise->count?>, "green"],

                                    <?php endif;?>

                                    <?php endforeach; ?>
                                    <?php foreach($uploadedpaymentwise as $paymonthwise):$time = strtotime($paymonthwise->client_payments_date);$year = date("Y", $time);
                                    if($paymonthwise->year == '2020' ):?>
                                    <?php $monthNum = $paymonthwise->uploaded_month; $dateObj = DateTime::createFromFormat('!m', $monthNum);$monthName = $dateObj->format('M'); ?>
                                    ["<?php echo $monthName . '/20'; ?>", <?php echo $paymonthwise->count?>, "#909"],

                                    <?php endif;?>

                                    <?php endforeach; ?>

                                ]);


                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                    {
                                        calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation"
                                    },
                                    2]);

                                var options = {
                                    title: "PAID AMOUNT MONTH WISE",
                                    height: 400,
                                    legend: {position: "none"},
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                chart.draw(view, options);
                            }
                        </script>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fullCalendar -->
<script src="<?php echo base_url('assets/admin/moment/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/fullcalendar/dist/fullcalendar.min.js'); ?>"></script>
<script>
    $(function () {
        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()

        $.ajax({
            type: "GET",
            url: "<?php echo base_url('admin/assignProjects') ?>",
            dataType: "json",
            success: function (data) {
                let events = [];
                Object.values(data).forEach(event => {
                    events.push({
                        title:event.development_status_name+' - '+event.project_name,
                        start:event.assign_project_delivery_date,
                        url: "<?php echo base_url('assign_project?id=') ?>"+event.assign_project_id,
                        allDay:true,
                        backgroundColor: ((event.assign_project_priority == 'low') ? '#3c8dbc' : (event.assign_project_priority == 'medium') ? 'green' : 'red'),
                        borderColor:((event.assign_project_priority == 'low') ? '#3c8dbc' : (event.assign_project_priority == 'medium') ? 'green' : 'red'),
                        textColor: '#ff0000',
                    });
                });
                $('#calendar').fullCalendar({
                    header    : {
                        left  : 'prev,next today',
                        center: 'title',
                        right : 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'today',
                        month: 'month',
                        week : 'week',
                        day  : 'day'
                    },
                    //Random default events
                    events,
                    editable  : true,
                    droppable : true, // this allows things to be dropped onto the calendar !!!
                    drop      : function (date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject')

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject)

                        // assign it the date that was reported
                        copiedEventObject.start           = date
                        copiedEventObject.allDay          = allDay
                        copiedEventObject.backgroundColor = $(this).css('background-color')
                        copiedEventObject.borderColor     = $(this).css('border-color')

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                    }
                })
            }
        })



    })
</script>