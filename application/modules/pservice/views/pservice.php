<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/bed/patient_service.css" rel="stylesheet">
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('pservice'); ?>
                <?php if ($this->ion_auth->in_group(array('admin')) ) { ?>
                    <div class="col-md-4 no-print pull-right"> 
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group pull-right">
                                <button id="" class="btn green btn-xs">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_pservice'); ?>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </header>

          


            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> <?php echo lang('no'); ?></th>
                                <th> <?php echo lang('service'); ?>  <?php echo lang('code'); ?></th>
                                <th> <?php echo lang('alpha_code'); ?>  </th>
                                <th> <?php echo lang('service'); ?>  <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('price'); ?></th>
                               
                                <th> <?php echo lang('active'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>
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




<!-- Add Pservice Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add_pservice'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pservice/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->name)) {
                            echo $pservice->name;
                        }
                        ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->code)) {
                            echo $pservice->code;
                        }
                        ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control" name="alpha_code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->alpha_code)) {
                            echo $pservice->alpha_code;
                        }
                        ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control" min="0" name="price" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->price)) {
                            echo $pservice->price;
                        }
                        ?>' placeholder="" required="">
                    </div>

                   
                    <div class="form-group col-md-6">

                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                         if (!empty($pservice->id)) {
                         if ($pservice->active == "1") {
                            echo "checked";
                         }
                         }
                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Pservice Modal-->







<!-- Edit Pservice Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('edit_pservice'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPserviceForm" class="clearfix row" action="pservice/addNew" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->name)) {
                            echo $pservice->name;
                        }
                        ?>' placeholder="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('service'); ?> <?php echo lang('code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->code)) {
                            echo $pservice->code;
                        }
                        ?>' placeholder="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('alpha_code'); ?></label>
                        <input type="text" class="form-control" name="alpha_code" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->alpha_code)) {
                            echo $pservice->alpha_code;
                        }
                        ?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                        <input type="text" class="form-control" min="0" name="price" id="exampleInputEmail1" value='<?php
                        if (!empty($pservice->price)) {
                            echo $pservice->price;
                        }
                        ?>' placeholder="" required="">
                    </div>

                   
                    <div class="form-group col-md-6">
                        
                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='1' <?php
                         if (!empty($pservice->id)) {
                        if ($pservice->active=="1") {
                            echo "checked";
                        }
                         }
                        ?>>
                        <label for="exampleInputEmail1"> <?php echo lang('active'); ?></label>
                    </div>



                    <input type="hidden" name="id" value='<?php
                    if (!empty($pservice->id)) {
                        echo $pservice->id;
                    }
                    ?>'>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>


<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/bed/patient_service.js"></script>