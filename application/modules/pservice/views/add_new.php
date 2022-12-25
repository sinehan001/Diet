<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/bed/patient_service.css" rel="stylesheet">
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($pservice->id))
                    echo lang('edit_pservice');
                else
                    echo lang('add_pservice');
                ?>
            </header>


         


            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="pservice/addNew" class="clearfix" method="post" enctype="multipart/form-data">

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
                        
                        <input type="checkbox" class="" name="active" id="exampleInputEmail1" value='' <?php
                         if (!empty($pservice->active)) {
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


                            <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                        </form>

                    </div>
                </div>

            </div>
        </section>
    </section>
    <!-- page end-->
</section>

<!--main content end-->
<!--footer start-->
