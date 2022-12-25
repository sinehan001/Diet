<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/finance/financial_report.css" rel="stylesheet">
        <header class="panel-heading"> 
            <?php echo lang('medical_report'); ?> 
            <div class="col-md-1 pull-right">
                <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
            </div>
        </header>
        <div class="col-md-12">
            <div class="col-md-9 row">
                <section>
                    <form role="form" class="f_report" action="finance/medicalReport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                              
                        <div class="col-md-3 medical">
                                <select name="type" id="type" class="form-control js-example-basic-single">
                                    <option value="this_week" <?php if($type=='this_week'){echo'selected';}?>><?php echo lang('this_week');?></option>
                                    <option value="this_month" <?php if($type=='this_month'){echo'selected';}?>><?php echo lang('this_month');?></option>
                                    <option value="last_30_days" <?php if($type=='last_30_days'){echo'selected';}?>><?php echo lang('last_30_days');?></option>
                                    <option value="custom" <?php if($type=='custom'){echo'selected';}?>><?php echo lang('custom_days');?></option>
                                </select>
                            </div>  
                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control date_from" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-addon"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control date_to" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-3 no-print">
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        
        <div class="row col-md-12">
            <div class="col-lg-7">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('medical_report'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?></th>
                               
                                <th class="hidden-phone"> #</th>

                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                               <td><?php echo lang('patient_registration');?></td>
                               <td><?php echo $opd;?></td>
                        </tr>
                                    <tr>
                                        <td><?php echo lang('bed_allotment');?></td>
                                        <td><?php echo $ipd;?></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('number_of_appointment_treated');?></td>
                                        <td><?php echo $appointment;?></td>
                                    </tr>
                                    
                           
                           

                        </tbody>
                        
                    </table>
                </section>




                <section></section>


               

            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/medical_report.js"></script>
