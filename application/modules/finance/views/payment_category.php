Payment<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('payment_procedures'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a href="finance/addPaymentCategoryView">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('create_payment_procedure'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table "> 
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                            <th><?php echo lang('code'); ?></th>
                                <th><?php echo lang('payment'); ?> <?php echo lang('item_name'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('category'); ?> <?php echo lang('price'); ?> ( <?php echo $settings->currency; ?> )</th>
                                <th><?php echo lang('doctors_commission'); ?></th>
                                <th><?php echo lang('type'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                        </style>

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                            <td><?php echo $category->code; ?></td>   
                                <td><?php echo $category->category; ?></td>   
                                <td> <?php echo $category->description; ?></td>
                                <td> <?php echo $category->c_price; ?></td>
                                <td> <?php echo $category->d_commission; ?> %</td>
                                <td> <?php
                                    if ($category->type == 'diagnostic') {
                                        echo lang('diagnostic_test');
                                    } else {
                                        echo lang('others');
                                    }
                                    ?>
                                </td>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <td class="no-print">
                                        <a class="btn btn-info btn-xs editbutton" title="<?php echo lang('edit'); ?>" href="finance/editPaymentCategory?id=<?php echo $category->id; ?>"><i class="fa fa-edit"> </i></a>
                                        <a class="btn btn-info btn-xs delete_button" title="<?php echo lang('delete'); ?>" href="finance/deletePaymentCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
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


<style>
    .wrapper {
        margin-top: 40px;
    }
</style>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/add_payment_category.js"></script>
