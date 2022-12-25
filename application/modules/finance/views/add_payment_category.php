<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7">
            <header class="panel-heading">
                <?php
                if (!empty($category->id))
                    echo lang('edit_payment_category');
                else
                    echo lang('create_payment_procedure');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/addPaymentCategory" class="clearfix" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                                <label for="exampleInputEmail1"><?php echo lang('code'); ?> &ast;</label>
                                <input type="text" class="form-control" name="code"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('code');
                                }
                                if (!empty($category->code)) {
                                    echo $category->code;
                                }
                                ?>' placeholder="" required="">    
                            </div> 
                            <div class="form-group"> 
                                <label for="exampleInputEmail1"><?php echo lang('payment'); ?> <?php echo lang('item_name'); ?></label>
                                <input type="text" class="form-control" id="category_name" name="category"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('category');
                                }
                                if (!empty($category->category)) {
                                    echo $category->category;
                                }
                                ?>' placeholder="">    
                            </div> 
                            <span id="notification" class="text-danger"></span>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                <input type="text" class="form-control" name="description"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('description');
                                }
                                if (!empty($category->description)) {
                                    echo $category->description;
                                }
                                ?>' placeholder="">
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('category'); ?> <?php echo lang('price'); ?></label>
                                <input type="text" class="form-control" name="c_price"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('c_price');
                                }
                                if (!empty($category->c_price)) {
                                    echo $category->c_price;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('doctors_commission'); ?> <?php echo lang('rate'); ?> (%)</label>
                                <input type="text" class="form-control" name="d_commission"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('d_commission');
                                }
                                if (!empty($category->d_commission)) {
                                    echo $category->d_commission;
                                }
                                ?>' placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                                <select class="form-control m-bot15" name="type" value=''>    
                                    <option value="diagnostic" <?php
                                    if (!empty($setval)) {
                                        if (set_value('type') == 'diagnostic') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($category->type)) {
                                        if ($category->type == 'diagnostic') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > <?php echo lang('diagnostic_test'); ?> </option>  
                                    <option value="others" <?php
                                    if (!empty($setval)) {
                                        if (set_value('type') == 'others') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($category->type)) {
                                        if ($category->type == 'others') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > <?php echo lang('others'); ?> </option>  
                                </select>
                            </div>

                            <input type="hidden" name="id" id="id" value='<?php
                            if (!empty($category->id)) {
                                echo $category->id;
                            }
                            ?>'>

                            <div class="form-group col-md-12">
                                <button type="submit" name="submit" id="submit_form" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                            
                        </form>
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
<script src="common/extranal/js/finance/add_payment_category.js"></script>