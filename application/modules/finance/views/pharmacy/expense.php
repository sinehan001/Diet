<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('pharmacy'); ?> <?php echo lang('expenses'); ?>  
                <div class="col-md-4 no-print pull-right"> 
                    <a href="finance/pharmacy/addExpenseView">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?>
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
                                <th> <?php echo lang('category'); ?> </th>
                                <th> <?php echo lang('date'); ?> </th>
                                <th> <?php echo lang('amount'); ?> </th>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <th> <?php echo lang('options'); ?> </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                      

                        <?php foreach ($expenses as $expense) { ?>
                            <tr class="">
                                <td><?php echo $expense->category; ?></td>
                                <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>             
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <td>
                                        <a class="btn btn-info btn-xs editbutton width_auto" href="finance/pharmacy/editExpense?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></a>
                                        <a class="btn btn-info btn-xs delete_button width_auto" href="finance/pharmacy/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i>  <?php echo lang('delete'); ?></a>
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




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/pharmacy/expense.js"></script>
