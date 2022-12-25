<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="common/js/google-loader.js"></script>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!--state overview start-->
        <link href="common/extranal/css/home.css" rel="stylesheet">
        <div class="modal fade" tabindex="-1" role="dialog" id="cmodal">
            <div class="modal-dialog modal-lg header_modal" role="document">
                <div class="modal-content"> 

                    <div id='medical_history'>
                        <div class="col-md-12">

                        </div> 
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
            <div class="state-overview col-md-5 state_overview_design">
                <header class="panel-heading">
                    <i class="fa fa-user"></i>  <?php echo lang('todays_appointments'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-samplee">
                            <thead>
                                <tr>
                                    <th> <?php echo lang('patient_id'); ?></th>
                                    <th> <?php echo lang('name'); ?></th>
                                    <th> <?php echo lang('date-time'); ?></th>
                                    <th> <?php echo lang('status'); ?></th>
                                    <th> <?php echo lang('options'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($appointments as $appointment) {
                                    if ($appointment->date == strtotime(date('Y-m-d'))) {
                                        ?>
                                        <tr class="">
                                            <td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->id; ?></td>
                                            <td> <?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name; ?></td>

                                            <td class="center"> <strong> <?php echo $appointment->s_time; ?> </strong></td>
                                            <td>
                                                <?php echo $appointment->status; ?>
                                            </td>
                                            <td>

                                                <a class="btn detailsbutton" title="<?php lang('history') ?>"  href="patient/medicalHistory?id=<?php echo $appointment->patient ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        <?php } ?>


        <?php if (!$this->ion_auth->in_group('Doctor')) { ?>

            <div class="state-overview col-md-12 state_overview_design" >
                <div class="clearfix">
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="doctor">
                            <?php } ?>
                            <section class="panel home_sec_green">
                                <div class="symbol green">
                                    <i class="fa fa-user-md"></i>
                                </div>
                                <div class="value"> 
                                    <h3 class="">
                                        <?php echo $this->db->count_all('doctor'); ?>
                                    </h3>
                                    <p><?php echo lang('doctor'); ?></p>
                                </div>
                            </section>
                            <?php if (!$this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="patient">
                            <?php } ?>
                            <section class="panel home_sec_blue">
                                <div class="symbol blue">
                                    <i class="fa fa-users-medical"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('patient'); ?>
                                    </h3>
                                    <p><?php echo lang('patient'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="appointment">
                            <?php } ?>
                            <section class="panel home_sec_yellow">
                                <div class="symbol yellow">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('appointment'); ?>
                                    </h3>
                                    <p><?php echo lang('appointment'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="prescription/all">
                            <?php } ?>
                            <section class="panel home_sec_green">
                                <div class="symbol blue">
                                    <i class="fa fa-file-medical"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('prescription'); ?>
                                    </h3>
                                    <p><?php echo lang('prescription'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="patient/caseList">
                            <?php } ?>
                            <section class="panel home_sec_blue">
                                <div class="symbol blue">
                                    <i class="fa fa-medkit"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('medical_history'); ?>
                                    </h3>
                                    <p><?php echo lang('case_history'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="lab">
                            <?php } ?>
                            <section class="panel home_sec_green">
                                <div class="symbol green">
                                    <i class="fa fa-flask"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('lab'); ?>
                                    </h3>
                                    <p><?php echo lang('lab_report'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>




                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="patient/documents">
                            <?php } ?>
                            <section class="panel home_sec_blue">
                                <div class="symbol blue">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('patient_material'); ?>
                                    </h3>
                                    <p><?php echo lang('documents'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="finance/payment">
                            <?php } ?>
                            <section class="panel home_sec_yellow">
                                <div class="symbol yellow">
                                    <i class="fa fa-money-check"></i>
                                </div>
                                <div class="value">
                                    <h3 class="">
                                        <?php echo $this->db->count_all('payment'); ?>
                                    </h3>
                                    <p><?php echo lang('payment'); ?> <?php echo lang('invoice'); ?></p>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>



                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>

                        <div class="col-lg-8 col-sm-12">
                            <div id="chart_div" class="panel"></div>

                        </div>

                        <div class="col-lg-4 col-sm-6">

                            <div id="piechart_3d" class="panel"></div>
                        </div>




                    <?php } ?>



                </div>





                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>


                    



                    <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                        <div class="col-md-8">
                            <aside class="calendar_ui panel calendar_ui">
                                <section class="">
                                    <div class="">
                                        <div id="calendar" class="has-toolbar calendar_view"></div>
                                    </div>
                                </section>
                            </aside>
                        </div>


                    <?php } else { ?>
                        <div class="state-overview col-md-7 panel row">
                            <aside class="calendar_ui">
                                <section class="">
                                    <div class="">
                                        <div id="calendar" class="has-toolbar calendar_view"></div>
                                    </div>
                                </section>
                            </aside>
                        </div>
                    <?php } ?>





                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('D d F, Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('income'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_day['payment'], 2, '.', ','); ?> <hr>
                                </div>                               
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_day['expense'], 2, '.', ','); ?>  <hr>
                                </div>
                                <div class="home_section">
                                    <?php echo lang('appointment'); ?> : <?php echo $this_day['appointment']; ?> <hr>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('F, Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('income'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_month['payment'], 2, '.', ','); ?> <hr>
                                </div>
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_month['expense'], 2, '.', ','); ?> <hr>
                                </div>
                                <div class="home_section">
                                    <?php echo lang('appointment'); ?> : <?php echo $this_month['appointment']; ?> <hr>
                                </div>
                            </div>
                        </section>


                        <section class="panel">
                            <header class="panel-heading">
                                <?php echo date('Y'); ?>
                            </header>
                            <div class="panel-body">
                                <div class="home_section">
                                    <?php echo lang('income'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_year['payment'], 2, '.', ','); ?> <hr>
                                </div>
                                <div class="home_section">
                                    <?php echo lang('expense'); ?> : <?php echo $settings->currency; ?><?php echo number_format($this_year['expense'], 2, '.', ','); ?> <hr>
                                </div>
                                <div class="home_section">
                                    <?php echo lang('appointment'); ?> : <?php echo $this_year['appointment']; ?> <hr>
                                </div>
                            </div>
                        </section>
                    </div>

                <?php } ?>


 
            </div>



        <?php } ?>





        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>
<?php
if (!empty($this_month['payment'])) {
    $payment_this = $this_month['payment'];
} else {
    $payment_this = '0';
}
if (!empty($this_month['expense'])) {
    $expense_this = $this_month['expense'];
} else {
    $expense_this = '0';
}

if (!empty($this_month['appointment_treated'])) {
    $appointment_treated= $this_month['appointment_treated'];
} else {
    $appointment_treated= '0';
}

        if (!empty($this_month['appointment_cancelled'])) {
            $appointment_cancelled= $this_month['appointment_cancelled'];
        } else {
            $appointment_cancelled= '0';
        }
       
?>
<script type="text/javascript">var payment_this = <?php echo $payment_this ?>;</script>
<script type="text/javascript">var expense_this = <?php echo $expense_this ?>;</script>
<script type="text/javascript">var appointment_treated = <?php echo $appointment_treated ?>;</script>
<script type="text/javascript">var appointment_cancelled = <?php echo $appointment_cancelled ?>;</script>
<script type="text/javascript">var per_month_income_expense = "<?php echo lang('per_month_income_expense') ?>";</script>
<script type="text/javascript">var currency = "<?php echo $settings->currency ?>";</script>
<script type="text/javascript">var months_lang = "<?php echo lang('months') ?>";</script>
<script type="text/javascript">var this_year = <?php echo json_encode($this_year['payment_per_month']); ?>;</script>
<script type="text/javascript">var this_year_expenses = <?php echo json_encode($this_year['expense_per_month']); ?>;</script>
<script src="common/extranal/js/home.js"></script>





