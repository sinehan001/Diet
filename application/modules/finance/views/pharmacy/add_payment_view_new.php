<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
         <link href="common/extranal/css/pharmacy/add_payment_view_new.css" rel="stylesheet">
        <section class="">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_payment');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('poss');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                      
                        <div class="">
                          
                            <section class="">
                              
                                <div class="">
                                 

                                    <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">     
                                            <?php if (!empty($payment->id)) { ?>
                                                <div class="col-md-8 payment pad_bot">
                                                    <div class="col-md-3 payment_label"> 
                                                        <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                                    </div>
                                                    <div class="col-md-6">                                                   
                                                        <?php echo '00' . $payment->id; ?>                                                                                                       
                                                    </div>                                              
                                                </div>                                           
                                            <?php } ?>
                                            <div class="col-md-8 payment">
                                                <div class="form-group last">
                                                    <div class="col-md-3 payment_label"> 
                                                        <label for="exampleInputEmail1"> <?php echo lang('select_item'); ?></label>
                                                    </div>
                                                    <div class="col-md-9 category_div">
                                                        <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
                                                           
                                                        </select>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 qfloww"><p><?php echo lang('selected_items'); ?></p></div>
                                        <div class="col-md-4 right-six">
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {

                                                        echo $payment->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="Discount">
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {

                                                        echo $payment->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('amount_received'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {

                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" ">
                                                </div>

                                            </div>

                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-12">
                                                    <div class="col-md-3"> 
                                                    </div>  
                                                    <div class="col-md-6"> 
                                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                                    </div>
                                                    <div class="col-md-3"> 
                                                    </div> 
                                                </div>
                                            </div>
                                           
                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($payment->id)) {
                                                echo $payment->id;
                                            }
                                            ?>'>
                                            <div class="row">
                                            </div>
                                            <div class="form-group">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var discount_type = "<?php echo $discount_type; ?>";</script>
<script type="text/javascript">var medicine = "<?php echo lang('medicine'); ?>";</script>
<script src="common/extranal/js/pharmacy/add_payment_view.js"></script>
