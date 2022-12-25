
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
          <link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('my_appointments'); ?>
                <div class="col-md-4 pull-right">
                    <div class="pull-right custom_buttons"></div>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        foreach ($appointments as $appointment) {
                            if ($user_id == $appointment->patient) {
                                ?>

                                <tr class="">
                                    <td><?php echo $appointment->id; ?></td>
                                    <td> <?php echo $this->db->get_where('doctor', array('id' => $appointment->doctor))->row()->name; ?></td>
                                    <td> <?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                    <td><?php echo $appointment->remarks; ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>


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



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var select_doctor = "<?php echo lang('select_doctor'); ?>";</script>
<script type="text/javascript">var select_patient = "<?php echo lang('select_patient'); ?>";</script>
<script type="text/javascript">var language = <?php echo $this->language; ?>;</script>

<script src="common/extranal/js/appointment/appointment.js"></script>