
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('expire_report'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new_report'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('doctor'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                       

                        <?php foreach ($reports as $report) { ?>
                            <tr class="">
                                <td><?php echo explode('*', $report->patient)[0]; ?></td>
                                <td> <?php echo $report->description; ?></td>
                                <td><?php echo $report->doctor; ?></td>
                                <td class="center"><?php echo $report->date; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?><" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-edit"></i> /button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->








<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_new_report'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addReport" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="type" value=''>
                            <option value="birth" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'birth') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('birth'); ?></option>
                            <option value="operation" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'operation') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('operation'); ?></option>
                            <option value="expire" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'expire') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('expire'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &#42;</label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="" required="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="patient" value='' required=""> 
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->name . '*' . $patient->ion_user_id; ?>" <?php
                                if (!empty($report->patient)) {
                                    if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> &#42;</label>
                        <select class="form-control m-bot15" name="doctor" value='' required=""> 
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->name; ?>" <?php
                                if (!empty($report->doctor)) {
                                    if ($report->doctor == $doctor->name) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $doctor->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &#42;</label>
                        <input class="form-control form-control-inline input-medium default-date-picker readonly" required="" name="date"  size="16" type="text" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_expire_report'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addReport" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?></label>
                        <select class="form-control m-bot15" name="type" value=''>
                            <option value="birth" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'birth') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('birth'); ?></option>
                            <option value="operation" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'operation') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('operation'); ?></option>
                            <option value="expire" <?php
                            if (!empty($report->report_type)) {
                                if ($report->report_type == 'expire') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('expire'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description"  value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15" name="patient" value=''> 
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->name . '*' . $patient->ion_user_id; ?>" <?php
                                if (!empty($report->patient)) {
                                    if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15" name="doctor" value=''> 
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->name; ?>" <?php
                                if (!empty($report->doctor)) {
                                    if ($report->doctor == $doctor->name) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $doctor->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" readonly="" name="date"  size="16" type="text" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/report/expire_report.js"></script>