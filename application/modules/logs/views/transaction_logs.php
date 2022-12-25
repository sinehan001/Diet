
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('transaction_logs'); ?>
               
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('date-time'); ?></th>
                                <th><?php echo lang('invoice'); ?> <?php echo lang('id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('deposit_type'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th><?php echo lang('created_by'); ?></th>
                                <th><?php echo lang('action'); ?></th> 
                               
                              
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
<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/transaction.js"></script>
