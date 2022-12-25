<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('meeting'); ?> <?php echo lang('requests'); ?>
                <div class=" col-md-4 pull-right">
                    <div class="pull-right custom_buttons"></div>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('patient'); ?></th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                       



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




<!-- Add Meeting Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_meeting'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="meeting/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value='' required=""> 
                            <option value="">Select</option>
                            <option value="add_new"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-4">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> &#42;</label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?> &#42;</label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>
                                <option value="Others" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Others') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Others </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?> &#42;</label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="adoctors" name="doctor" value='' required="">  
                            <option value="">Select</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date"  value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('meeting'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Requested" <?php
                            ?> > <?php echo lang('requested'); ?> </option> 
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
                    <div class="col-md-8 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                    </div>
                   
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Add Meeting Modal-->







        <!-- Edit Event Modal-->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">  <?php echo lang('edit_meeting'); ?></h4>
                    </div>
                    <div class="modal-body row">
                        <form role="form" id="editMeetingForm" action="meeting/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="col-md-4 panel">
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                                <select class="form-control m-bot15 js-example-basic-single pos_select patient" id="pos_select" name="patient" value=''> 
                                    <option value="">Select</option>
                                    <option value="add_new" ><?php echo lang('add_new'); ?></option>
                                    <?php foreach ($patients as $patient) { ?>
                                        <option value="<?php echo $patient->id; ?>" <?php
                                        if (!empty($payment->patient)) {
                                            if ($payment->patient == $patient->id) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> ><?php echo $patient->name; ?> </option>
                                            <?php } ?>
                                </select>
                            </div>
                            <div class="pos_client clearfix col-md-4">
                                <div class="payment pad_bot pull-right">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                                    <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                                </div>
                                <div class="payment pad_bot pull-right">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                    <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                                </div>
                                <div class="payment pad_bot pull-right">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                    <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                                </div>
                                <div class="payment pad_bot pull-right">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                                    <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                                </div> 
                                <div class="payment pad_bot"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                    <select class="form-control" name="p_gender" value=''>

                                        <option value="Male" <?php
                                        if (!empty($patient->sex)) {
                                            if ($patient->sex == 'Male') {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > Male </option>   
                                        <option value="Female" <?php
                                        if (!empty($patient->sex)) {
                                            if ($patient->sex == 'Female') {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > Female </option>
                                        <option value="Others" <?php
                                        if (!empty($patient->sex)) {
                                            if ($patient->sex == 'Others') {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > Others </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 panel">
                                <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                                <select class="form-control m-bot15 js-example-basic-single doctor" id="adoctors1" name="doctor" value=''>  
                                    <option value="">Select</option>
                                    <?php foreach ($doctors as $doctor) { ?>
                                        <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 panel">
                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                <input type="text" class="form-control default-date-picker" id="date1" readonly="" name="date"  value='' placeholder="">
                            </div>
                            <div class="col-md-6 panel">
                                <label for="exampleInputEmail1">Available Slots</label>
                                <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''> 

                                </select>
                            </div>
                            <div class="col-md-6 panel">
                                <label for="exampleInputEmail1"> <?php echo lang('meeting'); ?> <?php echo lang('status'); ?></label> 
                                <select class="form-control m-bot15" name="status" value=''>
                                    <option value="Requested" <?php
                                    ?> > <?php echo lang('requested'); ?> </option> 
                                    <option value="Pending Confirmation" <?php
                                    ?> > <?php echo lang('pending_confirmation'); ?> </option>
                                    <option value="Confirmed" <?php
                                    ?> > <?php echo lang('confirmed'); ?> </option>
                                    <option value="Treated" <?php
                                    ?> > <?php echo lang('treated'); ?> </option>
                                    <option value="Cancelled" <?php
                                    ?> > <?php echo lang('cancelled'); ?> </option>
                                </select>
                            </div>

                            <div class="col-md-8 panel">
                                <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                                <input type="text" class="form-control" name="remarks"  value='' placeholder="">
                            </div>
                            <div class="col-md-6 panel">
                                <label> <?php echo lang('send_sms'); ?> ? </label> <br>
                                <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?>
                            </div>
                            <input type="hidden" name="redirect" value='meeting/request'>
                            <input type="hidden" name="id" id="meeting_id" value=''>
                            <div class="col-md-12 panel">
                                <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                            </div>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Edit Event Modal-->

        <script src="common/js/codearistos.min.js"></script>
        <script src="common/extranal/js/meeting/common.js"></script>
         <script src="common/extranal/js/meeting/meeting_request.js"></script>