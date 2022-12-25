<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/patient/myInvoice.css" rel="stylesheet">
        <section class="col-md-6">


            <div class="panel panel-primary">
               
                <div class="panel-body settings_info">
                    <div class="row invoice-list">

                        <div class="col-md-12 invoice_head clearfix">

                            <div class="col-md-6 text-left invoice_head_left">
                                <h3>
                                    <?php echo $settings->title ?>
                                </h3>
                                <h4>
                                    <?php echo $settings->address ?>
                                </h4>
                                <h4>
                                    Tel: <?php echo $settings->phone ?>
                                </h4>
                            </div>
                            <div class="col-md-6 text-right invoice_head_right">
                                <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
                            </div>



                        </div>

                        <div class="col-md-12 hr_border">
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <h4 class="text-center lang_invoice">
                                <?php echo lang('payment') ?> <?php echo lang('invoice') ?>
                            </h4>
                        </div>

                        <div class="col-md-12 hr_border">
                            <hr>
                        </div>


                        <div class="col-md-12">
                            <div class="col-md-6 pull-left row patient_info">
                                <div class="col-md-12 row details">
                                    <p>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                        <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->name . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->id . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"> <?php echo lang('address'); ?> </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->address . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->phone . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                            </div>

                            <div class="col-md-6 pull-right patient_info">

                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('invoice'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($payment->id)) {
                                                echo $payment->id;
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('date'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($payment->date)) {
                                                echo date('d-m-Y', $payment->date) . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('doctor'); ?>  </label>
                                        <span class="patient_name"> : 
                                            <?php
                                            if (!empty($payment->doctor)) {
                                                $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
                                                if (!empty($doc_details)) {
                                                    echo $doc_details->name . ' <br>';
                                                } else {
                                                    echo $payment->doctor_name . ' <br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>



                            </div>

                        </div>






                    </div> 

                    <div class="col-md-12 hr_border">
                        <hr>
                    </div>




                    <table class="table table-striped table-hover">

                        <thead class="theadd">
                                     <?php if ($payment->payment_from == 'appointment') { ?>
                                            <th>#</th>
                                            <th><?php echo lang('description'); ?></th>
                                            <th><?php echo lang('date_time'); ?></th>
                                            <th><?php echo lang('doctor'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php }  elseif ($payment->payment_from == 'admitted_patient_bed_service') { ?>
                                            <th>#</th>
                                            <th><?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                                            <th><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                            <th><?php echo lang('quantity'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                       <?php } elseif ($payment->payment_from == 'admitted_patient_bed_medicine' ) { ?>
                                            <th>#</th>
                                            <th><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                                            <th><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                                            <th><?php echo lang('quantity'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php }  else { ?>
                                            <th>#</th>
                                            <th><?php echo lang('code'); ?></th>
                                            <th><?php echo lang('description'); ?></th>
                                            <th><?php echo lang('unit_price'); ?></th>
                                            <th><?php echo lang('qty'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        <?php } ?>
                        </thead>

                        <tbody>
                        <?php
                                          if ($payment->payment_from == 'appointment') {
                                            if (!empty($payment->category_name)) {
                                                $appointment_details = $this->db->get_where('appointment', array('id' => $payment->appointment_id))->row();
                                                ?>
                                                <tr>
                                                    <td><?php echo '1'; ?> </td>
                                                    <td><?php echo $payment->category_name; ?> </td>
                                                    <td class=""><?php echo date('d-m-Y', $appointment_details->date); ?> <br ><?php echo $appointment_details->time_slot; ?> </td>
                                                    <td class=""> <?php echo $appointment_details->doctorname; ?> </td>
                                                    <td class=""><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?> </td>
                                                </tr> 
                                                <?php
                                            }
                                        } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td><?php echo $cat_new[1]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[2]; ?> </td>
                                                        <td class=""> <?php echo $cat_new[3]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[4]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                                            if (!empty($payment->category_name)) {
                                                // $case_setails = $this->db->get_where('medical_history', array('id' => $payment->case_id))->row();
                                                $category = explode('#', $payment->category_name);
                                                //  print_r($category);
                                                //die();
                                                $i = 0;
                                                foreach ($category as $cat) {
                                                    $i = $i + 1;
                                                    $cat_new = array();
                                                    $cat_new = explode('*', $cat);
                                                    $service = $this->db->get_where('pservice', array('id' => $cat_new[0]))->row();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td>  <?php echo $service->name; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                        <td class=""> <?php echo '1'; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        } else{
                                        if (!empty($payment->category_name)) {
                                            $category_name = $payment->category_name;
                                            $category_name1 = explode(',', $category_name);
                                            $i = 0;
                                            // $length = count($category_name1);

                                            foreach ($category_name1 as $category_name2) {
                                                $i = $i + 1;
                                                $category_name3 = explode('*', $category_name2);
                                                //$count=count+1;
                                                if ($category_name3[3] > 0) {
                                                    ?>  

                                                    <tr>
                                                        <td><?php echo $i; ?> </td>
                                                        <td><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->code; ?> </td>
                                                        <td><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->category; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                        <td class=""> <?php echo $category_name3[3]; ?> </td>
                                                        <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[3]; ?> </td>
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                        ?>

                        </tbody>
                    </table>

                    <div class="col-md-12 hr_border">
                        <hr>
                    </div>

                    <div class="">
                        <div class="col-lg-4 invoice-block pull-left">
                            <h4></h4>
                        </div>
                    </div>

                    <div class="">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong><?php echo lang('sub_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></li>
                                <?php if (!empty($payment->discount)) { ?>
                                    <li><strong><?php echo lang('discount'); ?></strong> <?php
                                        if ($discount_type == 'percentage') {
                                            echo '(%) : ';
                                        } else {
                                            echo ': ' . $settings->currency;
                                        }
                                        ?> <?php
                                        $discount = explode('*', $payment->discount);
                                        if (!empty($discount[1])) {
                                            echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                        } else {
                                            echo $discount[0];
                                        }
                                        ?></li>
                                    <?php } ?>
                                    <?php if (!empty($payment->vat)) { ?>
                                    <li><strong>VAT :</strong>   <?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        } else {
                                            echo '0';
                                        }
                                        ?> % = <?php echo $settings->currency . ' ' . $payment->flat_vat; ?></li>
                                <?php } ?>
                                <li><strong><?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $g = $payment->gross_total; ?></li>
                                <li><strong><?php echo lang('amount_received'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $r = $this->finance_model->getDepositAmountByPaymentId($payment->id); ?></li>
                                <li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $g - $r; ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12 hr_border">
                        <hr>
                    </div>



                    <div class="col-md-12 invoice_footer">
                        <div class="col-md-4 row pull-left">
                            
                                <?php echo lang('user'); ?> : <?php echo $this->ion_auth->user($payment->user)->row()->username; ?>
                            
                        <div class="col-md-4 row pull-right">
                           
                               
                            
                        </div>
                    </div>

                </div>


            </div>




        </section>


        <section class="col-md-6">




            <div class="col-md-5 no-print option">

                <div class="text-center invoice-btn col-md-12 row">
                    <a class="btn btn-info btn-lg invoice_button pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                        <a href="finance/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-info btn-lg invoice_button pull-left"><i class="fa fa-edit"></i> Edit Invoice </a>
                    <?php } ?>

                </div>

            

            </div>

        </section>


    </section>
    <!-- invoice end-->
</section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/patient/myInvoice.js"></script>

