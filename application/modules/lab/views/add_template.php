<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
          <link href="common/extranal/css/lab/add_template.css" rel="stylesheet">
        <section class="panel col-md-7">
            <header class="panel-heading no-print">
                <?php
                if (!empty($template->id))
                    echo lang('edit_lab_report') . ' ' . lang('template');
                else
                    echo lang('add_lab_report') . ' ' . lang('template');
                ?>
            </header>
            <div class="no-print row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        

                        <form role="form" id="editLabForm" class="clearfix" action="lab/addTemplate" method="post" enctype="multipart/form-data">
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3 lab_label"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?> <?php echo lang('name'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <input type="text" class="form-control pay_in" name="name" value='<?php
                                    if (!empty($template->name)) {
                                        echo $template->name;
                                    }
                                    ?>' placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?> </label>
                                </div>
                                <div class="col-md-9"> 
                                    <textarea class="ckeditor form-control" id="editor" name="template" value="" rows="10"><?php
                                        if (!empty($setval)) {
                                            echo set_value('template');
                                        }
                                        if (!empty($template->template)) {
                                            echo $template->template;
                                        }
                                        ?>
                                    </textarea>
                                </div>
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($template->id)) {
                                echo $template->id;
                            }
                            ?>'>


                            <div class="col-md-12"> 
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>


           
        </section>
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/lab/add_template_view.js"></script>

