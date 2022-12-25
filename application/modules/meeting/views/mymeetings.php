
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('my_meetings'); ?>
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
                        foreach ($meetings as $meeting) {
                            if ($user_id == $meeting->patient) {
                                ?>

                                <tr class="">
                                    <td><?php echo $meeting->id; ?></td>
                                    <td> <?php echo $this->db->get_where('doctor', array('id' => $meeting->doctor))->row()->name; ?></td>
                                    <td> <?php echo date('d-m-Y', $meeting->date); ?> => <?php echo $meeting->time_slot; ?></td>
                                    <td><?php echo $meeting->remarks; ?></td>

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
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/meeting/mymeetings.js"></script>
