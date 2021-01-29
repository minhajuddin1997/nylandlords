<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content">
    <div class="container-fluid">
        <div>
            <h2 style="display:inline-block;">
                Logs
            </h2>
            <h3 class="box-title" style="display:inline-block;">List</h3>
        </div>

        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table_id">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event</th>
                            <th>Created at</th>
                            <th>IP Address</th>
                            <th>Os</th>
                            <th>Browser</th>

<!--                            <th width="20%">Actions</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($records)):
                            $x = 1;
                            foreach($records as $record):
                                ?>



                                <tr>
                                    <td><?php echo $x++;?></td>
                                    <td><?php echo $record->name;?></td>
                                    <td><?php echo $record->email;?></td>

                                    <td><?php echo $record->view_page;?></td>
                                    <td><?php echo $record->created_at;?></td>


                                    <td><?php echo $record->ip_address;?></td>
                                    <td><?php echo $record->os;?></td>
                                    <td><?php echo $record->browser;?></td>

<!---->
<!--                                <td>-->
<!---->
<!--                                        <a href="--><?php //echo site_url('edit/client_projects/'.$record->client_projects_id.'');?><!--"><span style="border-radius:5px;" class="edit_icon"><i class="fa fa-edit" aria-hidden="true"></i></span></a>-->
<!--                                        <a href="--><?php //echo site_url('delete/client_projects/'.$record->client_projects_id.'');?><!--"><span style="border-radius:5px;" class="delete_icon"><i class="fa fa-trash" aria-hidden="true"></i></span></a>-->
<!--                                    </td>-->
                                </tr>
                            <?php endforeach; endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
