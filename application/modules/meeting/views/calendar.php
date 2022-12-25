f
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
     <link href="common/extranal/css/meeting/calendar.css" rel="stylesheet">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('meeting'); ?> <?php echo lang('calendar'); ?>
            </header>
            <div class="panel-body">
                <aside>
                    <section class="panel">
                        <div class="panel-body">
                            <div id="calendar" class="has-toolbar calendar_view"></div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<div class="modal fade" tabindex="-1" role="dialog" id="cmodal">
    <div class="modal-dialog modal-lg calendar_io" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo lang('patient') . " " . lang('history'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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