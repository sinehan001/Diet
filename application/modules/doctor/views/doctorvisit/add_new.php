
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($accountant->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_doctor_visit');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_doctor_visit');
                ?>
            </header>
            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="doctor/doctorvisit/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                                            <select class="form-control m-bot15 doctor" id="adoctors" name="doctor" value='' required="">  

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></label>
                                            <input type="text" class="form-control" name="visit_description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('visit_description');
                                            }
                                            if (!empty($doctorvisit->visit_description)) {
                                                echo $doctorvisit->visit_description;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                                            <input type="text" class="form-control" name="visit_charges" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('visit_charges');
                                            }
                                            if (!empty($doctorvisit->visit_charges)) {
                                                echo $doctorvisit->visit_charges;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <select class="js-example-basic-single" name="status">
                                                <option value="active"><?php echo lang('active'); ?></option>
                                                <option value="disable"><?php echo lang('in_active'); ?></option>
                                            </select>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                    </form>
                                </div>
                            </section>
                        </div>  
                    </div> 
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>
